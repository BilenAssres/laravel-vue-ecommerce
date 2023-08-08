<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_name',
        'product_price',
        'product_seller',
        'product_status',
        'product_detail',
    ];

    public function images()
    {
        return $this->hasMany(Image::class);
    }
}
