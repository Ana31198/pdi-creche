namespace App\Http\Controllers;

use App\Models\Rotina;
use App\Models\Crianca;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RotinaController extends Controller
{
    public function index(Request $request)
    {
        $user = auth()->user();
        $rotinas = Rotina::query();
        $criancas = collect(); // Inicializamos a coleção vazia
    
        // Se for responsável, filtrar apenas as rotinas das crianças associadas
        if ($user->isResponsavel()) {
            // Obtemos as crianças associadas ao responsável logado
            $criancas = Crianca::whereRaw('LOWER(nomeresponsavel) = ?', [strtolower($user->name)])->get();
    
            // Filtramos as rotinas das crianças associadas
            $rotinas->whereIn('crianca_id', $criancas->pluck('id'));
        } else {
            // Para outros usuários (admin, educador), mostramos todas as crianças
            $criancas = Crianca::all();
    
            // Se não for responsável, permitir filtro por criança
            if ($request->has('crianca_id') && $request->crianca_id != '') {
                $rotinas->where('crianca_id', $request->crianca_id);
            }
        }
    
        // Filtro por data
        if ($request->has('data') && $request->data != '') {
            $rotinas->whereDate('data', $request->data);
        }
    
        $rotinas = $rotinas->get();
    
        return view('rotinas.index', compact('rotinas', 'criancas'));
    }
    
    
    public function create()
    {
        $criancas = Crianca::all();
        return view('rotinas.create', compact('criancas'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'crianca_id' => 'required|exists:criancas,id',
            'data' => 'required|date',
            'atividade' => 'required|string|max:255',
            'descricao' => 'nullable|string',
        ]);

        Rotina::create($request->all());

        return redirect()->route('rotinas.index')->with('success', 'Rotina adicionada com sucesso!');
    }

    public function show($id)
    {
        $rotina = Rotina::with('crianca')->findOrFail($id);
        return view('rotinas.show', compact('rotina'));
    }

    public function historico($crianca_id)
    {
        $crianca = Crianca::with('rotinas')->findOrFail($crianca_id);
        
        // Agora você tem a criança e as rotinas associadas a ela
        $rotinas = $crianca->rotinas; // Aqui você acessa as rotinas da criança
    
        return view('criancas.historico', compact('crianca', 'rotinas'));
    }
    
}
