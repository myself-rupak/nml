<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductTypes extends Model
{
    protected $fillable = [
    	'title', 
    	'order', 
    	'is_active',
    	'image', 
    	'url',
        'banner_image',
    	'hover_image',
    	'menu_image',
    	'created_by',
    	'updated_by'
   	];
    protected $table = "product_types";

    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
