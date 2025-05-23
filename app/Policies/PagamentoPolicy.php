<?php

namespace App\Policies;

use App\Models\Pagamento;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class PagamentoPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return false;
    }

    /**
     * Determine whether the user can view the model.
     */
  // App\Policies\PagamentoPolicy.php



  public function view(User $user, Pagamento $pagamento)
    {
        return $user->role === 'admin' ||
               $user->role === 'educador' ||
               ($user->role === 'responsavel' && $pagamento->crianca->user_id === $user->id);
    }


    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return false;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Pagamento $pagamento): bool
    {
        return false;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Pagamento $pagamento): bool
    {
        return false;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Pagamento $pagamento): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Pagamento $pagamento): bool
    {
        return false;
    }
}
