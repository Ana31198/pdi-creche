<?php
namespace App\Notifications;

use App\Models\Pagamento;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class PagamentoPendenteNotification extends Notification
{
    use Queueable;

    public $pagamento;

    public function __construct(Pagamento $pagamento)
    {
        $this->pagamento = $pagamento;
    }

    public function via($notifiable)
    {
        return ['database']; // só no painel
    }

  
    public function toDatabase($notifiable)
{
    return [
        'message' => 'Pagamento pendente para a criança ' . $this->pagamento->crianca->nome,
        'url' => route('pagamentos.pagar', $this->pagamento->id),
    ];
}
}