<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HeroSlider extends Model
{
	protected $fillable = [
    	'template',
    	'is_active',
    	'slider_image',
    	'mobile_slider_image',
    	'description',
        'mobile_description',
    	'created_by',
    	'updated_by'
   	];
    protected $table = 'hero_slider';
}
