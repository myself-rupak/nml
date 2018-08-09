<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TouchPoint extends Model
{
    protected $fillable = [
    	'district_id',
    	'thana_id',
        'name',
        'address',
        'contact_person',
        'contact_phone',
        'email',
        'latitude',
        'longitude',
        'point_type',
    	'created_by',
    	'updated_by'
   	];
    protected $table = "touch_points";
    protected $hidden = ['created_by', 'created_at', 'updated_by', 'updated_at'];

    public function district()
    {
        return $this->belongsTo(District::class, 'district_id', 'id');
    }

    public function thana()
    {
        return $this->belongsTo(Thana::class, 'thana_id', 'id');
    }
}
