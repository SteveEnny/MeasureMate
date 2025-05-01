<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CustomerResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'type' => 'customer',
            'id' => $this->id,
            'attributes' => [
                'name' => $this->name,
                'phone' => $this->phone,
                'address' => $this->address,
                'createdAt' => $this->created_at,
                'updatedAt' => $this->updated_at,
                'userId' => $this->user_id,
            ],
            'relationships' =>$this->when($request->routeIs('customers.show') ,[
                'user' => [
                    'data' =>   [
                        'type' => 'user',
                        'id' => $this->user_id,
                    ]
                ]
                    ],)
                    // 'include' => 
        ];
    }
}