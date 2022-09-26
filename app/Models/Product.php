<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    /**
     * @var string[]
     */
    protected $fillable = [
        'slug',
        'image',
        'name',
        'description',
        'price',
        'sku',
        'quantity',
        'is_published'
    ];
}
