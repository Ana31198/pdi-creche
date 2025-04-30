<?php 
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Message;
use App\Models\Crianca; 
class Chat extends Model
{
    use HasFactory;

    protected $fillable = ['educador_id', 'responsavel_id'];

    // Relacionamento com o educador
    public function educador()
    {
        return $this->belongsTo(User::class, 'educador_id');
    }

    // Relacionamento com o responsável
    public function responsavel()
    {
        return $this->belongsTo(User::class, 'responsavel_id');
    }


    // Relacionamento com o modelo Message
    public function messages()
    {
        return $this->hasMany(Message::class);
    }

}