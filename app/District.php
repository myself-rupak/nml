<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class District extends Model
{
    protected $fillable = ['name', 'created_by', 'updated_by'];
    protected $table = "district";

    public function thanas()
    {
        return $this->hasMany(Thana::class);
    }
}
