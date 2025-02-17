<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'slug',
        'features',
        'is_popular',
        'is_default',
        'metadata',
    ];

    protected $casts = [
        'features' => 'array',
        'metadata' => 'array',
    ];

    public function plans()
    {
        return $this->hasMany(Plan::class);
    }
}
