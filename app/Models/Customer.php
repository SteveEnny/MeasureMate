<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder as EloquentBuilder;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Query\Builder;

class Customer extends Model
{
    use HasFactory, HasUuids;
   protected $fillable = ['name', 'phone', 'address', 'user_id']; // fillable fields

    public function user() : BelongsTo {
        return $this->belongsTo(User::class);
    }

    public function measurement() : HasMany {
        return $this->hasMany(Measurement::class);
    }

    public function scopeFilter(Builder | EloquentBuilder $query, string | null $name) :Builder | EloquentBuilder {
        return $query->when($name ?? null, fn($query, $name) => $query->where('name', 'like', '%' . $name . '%')); 
        // filter by name
    }
    
}