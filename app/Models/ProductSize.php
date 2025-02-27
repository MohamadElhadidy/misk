<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductSize extends Model
{
    use SoftDeletes;

    protected $fillable = ['product_id', 'size', 'price'];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
