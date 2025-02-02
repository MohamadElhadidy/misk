<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use SoftDeletes;

    protected $fillable = ['name', 'category_id', 'description'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function sizes(){
        return $this->hasMany(ProductSize::class);
    }


    public function images()
    {
        return $this->hasMany(ProductImage::class);
    }

}
