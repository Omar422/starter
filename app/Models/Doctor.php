<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Hospital;

class Doctor extends Model
{
    protected $fillable = ['name', 'title', 'gender', 'hospital_id', 'created_at', 'updated_at'];
    protected $hidden = ['created_at', 'updated_at'];

    public function hospital() {
        return $this->belongsTo(Hospital::class, 'hospital_id', 'id');
    }
}
