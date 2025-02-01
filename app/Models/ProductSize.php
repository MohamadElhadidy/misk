<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductSize extends Model
{
    protected $fillable = ['product_id', 'size', 'price'];

    public function product()
    {
        $this->belongsTo(Product::class);
    }
}
