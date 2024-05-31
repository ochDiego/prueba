<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

class Product extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'price'];

    public function orders(): BelongsToMany
    {
        return $this->belongsToMany(Order::class);
    }

    public function user(): HasManyThrough
    {
        return $this->hasManyThrough(User::class, Order::class);
    }
}
