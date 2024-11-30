<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductSize extends Model
{
    public function product()
    {
        $this->belongsTo(Product::class);
    }
}
