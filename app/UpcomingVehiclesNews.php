<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UpcomingVehiclesNews extends Model
{
    protected $fillable = [
        'content',
        'is_active',
    	'created_by',
    	'updated_by'
   	];
   	protected $table = "upcoming_vehicles_news";
}
