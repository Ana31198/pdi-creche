<?php

namespace App\Http\Controllers;

use App\Models\Pagamento;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Notifications\PagamentoPendenteNotification;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Str;

class PagamentoController extends Controller
{
    use AuthorizesRequests;

    public function index()
    {
        $user = auth()->user();

        $pagamentos = Pagamento::with('crianca')
            ->when($user->role === 'responsavel', function ($query) use ($user) {
                $query->whereHas('crianca', function ($q) use ($user) {
                    $q->whereRaw('LOWER(TRIM(nomeresponsavel)) = ?', [Str::lower(trim($user->name))]);
                });
            })
            ->get();

        return view('pagamentos.index', compact('pagamentos'));
    }

    public function create()
    {
        $criancas = \App\Models\Crianca::all();
        return view('pagamentos.create', compact('criancas'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'crianca_id' => 'required|exists:criancas,id',
            'valor' => 'required|numeric',
            'data_pagamento' => 'required|date',
            'descricao' => 'nullable|string',
            'estado' => 'required|in:pago,pendente',
        ]);

        $pagamento = Pagamento::create($request->all());

        if ($pagamento->estado === 'pendente') {
            $responsavel = \App\Models\User::whereRaw('LOWER(TRIM(name)) = ?', [
                Str::lower(trim($pagamento->crianca->nomeresponsavel))
            ])->first();

            if ($responsavel) {
                $responsavel->notify(new PagamentoPendenteNotification($pagamento));
            }
        }

        return redirect()->back()->with('success', 'Pagamento registado com sucesso.');
    }

    public function gerarRecibo(Pagamento $pagamento)
    {
        $user = auth()->user();

        if (
            $user->role !== 'admin' &&
            $user->role !== 'educador' &&
            (
                $user->role !== 'responsavel' ||
                !$pagamento->crianca ||
                Str::lower(trim($pagamento->crianca->nomeresponsavel)) !== Str::lower(trim($user->name))
            )
        ) {
            abort(403, 'Acesso negado.');
        }

        return Pdf::loadView('pagamentos.recibos', compact('pagamento'))
                  ->download('recibo_pagamento_' . $pagamento->id . '.pdf');
    }

    public function pagar($id)
    {
        $pagamento = Pagamento::with('crianca')->findOrFail($id);
        $user = auth()->user();

        if (
            $user->role !== 'responsavel' ||
            !$pagamento->crianca ||
            Str::lower(trim($pagamento->crianca->nomeresponsavel)) !== Str::lower(trim($user->name)) ||
            $pagamento->estado !== 'pendente'
        ) {
            abort(403);
        }

        return view('pagamentos.pagar', compact('pagamento'));
    }

    public function confirmarPagamento(Request $request, $id)
    {
        $pagamento = Pagamento::with('crianca')->findOrFail($id);
        $user = auth()->user();

        if (
            $user->role !== 'responsavel' ||
            !$pagamento->crianca ||
            Str::lower(trim($pagamento->crianca->nomeresponsavel)) !== Str::lower(trim($user->name)) ||
            $pagamento->estado !== 'pendente'
        ) {
            abort(403);
        }

        $pagamento->update(['estado' => 'pago']);

        // Apaga notificações pendentes deste pagamento
        $user->unreadNotifications()
            ->where('data->url', route('pagamentos.pagar', $pagamento->id))
            ->delete();

        return redirect()->route('pagamentos.index')->with('success', 'Pagamento realizado com sucesso.');
    }

    public function marcarComoPago($id)
    {
        $pagamento = Pagamento::findOrFail($id);

        if (auth()->user()->role !== 'admin' && auth()->user()->role !== 'educador') {
            abort(403, 'Sem permissão para marcar como pago.');
        }

        $pagamento->update(['estado' => 'pago']);
        return back()->with('success', 'Pagamento marcado como pago.');
    }
}