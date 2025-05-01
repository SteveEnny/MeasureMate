<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\MeasurementResource;
use App\Http\Traits\ResponseTrait;
use App\Models\Customer;
use App\Models\Measurement;
use App\Policies\CustomerMeasurementPolicy;
use App\Policies\MeasurementPolicy;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class MeasurementController extends Controller
{
    use ResponseTrait;
    /**
     * Display a listing of the resource.
     */
    public function __construct() {
        // $this->authorizeResource(Measurement::class, 'measurement');
    }
     
    public function index(string $customer_id)
    {
        // A user should be able to check a customer measurement
    //    try {
            $customer = Customer::findOrFail($customer_id);
            Gate::authorize('viewAll', $customer);


           $measurement = Measurement::where('customer_id', $customer->id)->get();
           return MeasurementResource::collection($measurement);
    //    } 
       
    //    catch(AuthorizationException $exception) {
    //         return $this->errorResponse('You are not authorized to update that resource');
    //    }
        //todo add type of cloth name in the database

        // return $this->successResponseWithResource('Success', $measurement);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'customer_id' => 'required',
        ]);
            $measurement = Measurement::create($request->all());
            return $this->successResponse('Measurement created successfully', [$measurement]);
    
    }

    /**
     * Display the specified resource.
     */
    public function show(Customer $customer, Measurement $measurement)
    {
        // $this->authorize('view', [$customer, MeasurementPolicy::class]);
        // $this->authorize('view', $customer);
        return $this->successResponseWithResource('Success', $measurement);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $measurement_id)
    {
        try {
            $ticket = Measurement::findOrFail($measurement_id);
            $ticket->update($request->all());
        }catch(ModelNotFoundException $exception) {
            return $this->errorResponse('User not found');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Measurement $measurement)
    {
        $measurement->delete();
        return $this->successResponse('Measurement deleted successfully');
    }
}