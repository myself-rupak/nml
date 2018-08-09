<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WebsiteMenu extends Model
{
    //
    protected $fillable = ['menu_name', 'order', 'is_active','image', 'url', 'is_parent','created_by', 'updated_by'];
    protected $table = "website_menu";
}
