<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Measurement extends Model
{
    use HasFactory;

    public function user() : BelongsTo {
        return $this->belongsTo(User::class);
    }

    public function customer() : BelongsTo {
        return $this->belongsTo(Customer::class);
    }
}