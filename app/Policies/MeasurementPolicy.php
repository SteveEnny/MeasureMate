<?php

namespace App\Policies;

use App\Models\Customer;
use App\Models\Measurement;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class MeasurementPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user, Customer $customer)
    {
        // return true;
        // return $user->id === $customer->user_id;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(?User $user, Measurement $measurement): bool
    {
        // $customer = Customer::findOrFail($measurement->customer_id);

        return true;
        // return $customer->id === $measurement->customer_id;
        // return $user->id === $customer->user_id;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(?User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Measurement $measurement): bool
    {
        return true;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Measurement $measurement): bool
    {
        return true;
    }

    /**
     * Determine whether the user can restore the model.
     */
    // public function restore(User $user, Measurement $measurement): bool
    // {
    //     //
    // }

    // /**
    //  * Determine whether the user can permanently delete the model.
    //  */
    // public function forceDelete(User $user, Measurement $measurement): bool
    // {
    //     //
    // }
}