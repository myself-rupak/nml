<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Thana extends Model
{
    protected $fillable = [
    	'district_id',
        'name',
    	'created_by',
    	'updated_by'
   	];
    protected $table = "thana";

    public function district()
    {
        return $this->belongsTo(District::class, 'district_id', 'id');
    }

    public function touchPoints()
    {
        return $this->hasMany(TouchPoint::class);
    }
}
