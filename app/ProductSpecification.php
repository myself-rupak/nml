<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductSpecification extends Model
{
    protected $fillable = [
    	'title',
    	'created_by',
    	'updated_by'
   	];
    protected $table = 'product_specification';

    public function specificationOfProduct() {
	    return  $this->hasOne(ProductWiseSpecification::class);
	}

	public function products()
	{
		return $this->belongsToMany(Product::class);
	}
}
