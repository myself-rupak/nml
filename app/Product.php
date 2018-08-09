<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'product_condition',
    	'title',
    	'url',
        'background_image',
        'banner_image',
    	'overview_image', 
    	'home_thumb_image',
    	'list_thumb_image', 
    	'overview',
    	'home_page_description',
    	'product_list_page_description',
        'is_active',
        'featured_product',
    	'created_by',
    	'updated_by'
   	];
    protected $table = "product";

    public function productType()
    {
        return $this->belongsTo(ProductTypes::class, 'product_types_id', 'id');
    }

    public function productWiseSpecifications()
    {
        return $this->hasMany(ProductWiseSpecification::class);
    }

    public function productGalleryImages()
    {
        return $this->hasMany(ProductImageGallery::class);
    }

    public function Productpecifications()
    {
        return $this->belongsToMany(ProductSpecification::class);
    }
}
