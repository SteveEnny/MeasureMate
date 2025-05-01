<?php

namespace App\Http\Resources;

use Illuminate\Database\Eloquent\Factories\Relationship;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MeasurementResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'type' => 'measurement',
            'id' => $this->id,
            'attributes' => [
                'name' => $this->name,
                "body_type"=> $this->type,
                'measured_values' => $this->measured_values,
                "created_at" => $this->created_at,
                "updated_at" => $this->updated_at,
            ],
            'relationships' =>[
                'customer' => [
                    'data' =>   [
                        'type' => 'customer',
                        'id' => $this->customer_id,
                    ]
                ]
                    ]
        ];        
    }
}

                // "bust" => $this->bust,
                // "neck" => $this->neck,
                // "rise" => $this->rise,
                // "chest" => $this->chest,
                // "waist" => $this->waist,
                // "hips" => $this->hips,
                // "shoulder_width" => $this->shoulder_width,
                // "sleeve_length" => $this->sleeve_length,
                // "sleeve_opening" => $this->sleeve_opening,
                // "arm_length" => $this->arm_length,
                // "inseam" => $this->inseam,
                // "outseam" => $this->outseam,
                // "length" => $this->length,