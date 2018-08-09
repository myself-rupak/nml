<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MediaCenter extends Model
{
    protected $fillable = [
        'title',
    	'image_1',
    	'image_2',
    	'image_3',
    	'image_4',
    	'content',
        'is_active',
    	'created_by',
    	'updated_by'
   	];
   	protected $table = "media_center";
}
