<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductImageGallery extends Model
{
    protected $fillable = [
    	'product_id',
    	'image',
        'is_active',
    	'created_by',
    	'updated_by'
   	];
   	protected $table = "product_image_gallery";

   	public function product()
    {
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }
}
