<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CustomerResource;
use App\Models\Customer;
use Illuminate\Console\Scheduling\Event;
use Illuminate\Http\Request;

class CustomerController extends Controller
{

    public function __construct() {
        // $this->middleware('auth:api');
        $this->authorizeResource(Customer::class, 'customer');
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // return CustomerResource::collection(Customer::with('user', 'measurement')->get());
        return CustomerResource::collection(Customer::where('user_id' ,$request->user()->id)->get());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $customer_details = $request->validate([
            'name' => 'required | max:255 | string',
            'address' => 'sometimes | string',
            'phone' => 'required | string | max:25',
        ]);

        $customer = Customer::create([
            ...$customer_details,
            'user_id' => $request->user()->id,
        ]);

        return  CustomerResource::make($customer);
    }

    /**
     * Display the specified resource.
     */
    public function show(Customer $customer)
    {
        return CustomerResource::make($customer);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Customer $customer)
    {
        $customer_details = $request->validate([
            'name' => 'sometimes | string',
            'mac_address' => 'sometimes | string | max:500',
            'phone' => 'sometimes | max:15 | numeric',
        ]);

        $customer->update($customer_details);

        CustomerResource::make($customer);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Customer $customer)
    {
        $customer->delete();
        return response(status: 204); //No content
    }
}