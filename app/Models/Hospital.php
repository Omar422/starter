<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Doctor;

class Hospital extends Model
{
    protected $fillable = ['name', 'address', 'created_at', 'updated_at'];
    protected $hidden = ['created_at', 'updated_at'];

    // one hospital has many doctor
    public function doctors() {
        // return $this->hasMany('App\Models\Doctor');
        // hasMany('model', 'foreignkey', 'primarykey')
        return $this->hasMany(Doctor::class, 'hospital_id', 'id');
    }
}
