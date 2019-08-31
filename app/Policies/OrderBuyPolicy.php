<?php

namespace App\Policies;

use App\User;
use App\OrderBuy;
use Illuminate\Auth\Access\HandlesAuthorization;

class OrderBuyPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the orderBuy.
     *
     * @param  \App\User $user
     * @param  \App\OrderBuy $orderBuy
     * @return mixed
     */
    public function view(User $user, OrderBuy $orderBuy)
    {
        //
    }

    /**
     * Determine whether the user can create orderBuys.
     *
     * @param  \App\User $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the orderBuy.
     *
     * @param  \App\User $user
     * @param  \App\OrderBuy $orderBuy
     * @return mixed
     */
    public function update(User $user, OrderBuy $orderBuy)
    {
        return $orderBuy->user_id == $user->id;
    }

    /**
     * Determine whether the user can delete the orderBuy.
     *
     * @param  \App\User $user
     * @param  \App\OrderBuy $orderBuy
     * @return mixed
     */
    public function delete(User $user, OrderBuy $orderBuy)
    {
        //
    }
}
