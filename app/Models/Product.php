<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ['name', 'category_id', 'description'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function sizes(){
        $this->hasMany(ProductSize::class);
    }


    public function images()
    {
        $this->hasMany(ProductImage::class);
    }

}
