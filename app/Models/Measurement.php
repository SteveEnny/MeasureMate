<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Measurement extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = ['customer_id', 'type', 'measured_values'];
    protected $casts = [
        'measured_values' => 'json', // Cast measured_values as JSON
    ];
    // protected $guarded = [];



    public function user() : BelongsTo {
        return $this->belongsTo(User::class);
    }

    public function customer() : BelongsTo {
        return $this->belongsTo(Customer::class);
    }
}