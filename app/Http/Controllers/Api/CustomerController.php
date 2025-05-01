<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\StoreCustomerRequest;
use App\Http\Resources\CustomerResource;
use App\Http\Traits\ResponseTrait;
use App\Models\Customer;
use Illuminate\Console\Scheduling\Event;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    use ResponseTrait;
    public function __construct() {
        $this->authorizeResource(Customer::class, 'customer');
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $name = $request->query('customer_name');
        $customers = Customer::where('user_id', $request->user()->id)->filter($name)->paginate();
        // return $this->successResponseWithResource('Success', $customers);
        return CustomerResource::collection($customers);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCustomerRequest $request)
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
            'address' => 'sometimes | string | max:500',
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