<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Offer extends Model
{
    protected $table = 'offers'; // if name not with laravel standard
    // only fields to use in CRUD operation
    protected $fillable = ['name_en','name_ar', 'price', 'details_ar','details_en', 'created_at', 'updated_at'];
    // won't return with SQL request(select * for Example...)
    protected $hidden = ['created_at', 'updated_at'];
    // if I don't won't timestamps
    // public $timestamps = false;
}
