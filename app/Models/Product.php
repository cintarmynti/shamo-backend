<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = ['id','name', 'price', 'description', 'tags', 'categories_id'];

    public function category(){
        return $this->belongsTo(ProductCategory::class, 'categories_id', 'id'); //foregn key dari product kategori soalnya belongsto, local key
    }

    public function gallery(){
        return $this->hasMany(ProductGallery::class, 'products_id', 'id'); //foregn key, local key
    }
}
