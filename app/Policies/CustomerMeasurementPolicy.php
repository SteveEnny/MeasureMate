<?php

namespace App\Policies;

use App\Models\Customer;
use App\Models\User;

class CustomerMeasurementPolicy
{
    /**
     * Create a new policy instance.
     */
    // public function __construct()
    // {
    //     //
    // }

    public function viewAny(Customer $customer) {
        return false;
    }

    public function index() {
        return false;
    }
}