<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Customer extends Model
{
    use HasFactory;
   protected $fillable = ['name', 'phone', 'address', 'user_id']; // fillable fields

    public function user() : BelongsTo {
        return $this->belongsTo(User::class);
    }

    public function measurement() : HasMany {
        return $this->hasMany(Measurement::class);
    }
}