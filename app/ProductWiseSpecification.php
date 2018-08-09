<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductWiseSpecification extends Model
{
	protected $fillable = [
		'product_specification_id',
		'product_id',
    	'specification_detail',
    	'created_by',
    	'updated_by'
   	];
    protected $table = "product_wise_specification";

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }

    public function productSpecification() {
	    return  $this->belongsTo(ProductSpecification::class, 'product_specification_id', 'id');
	}
}
