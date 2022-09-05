<?php

namespace App\Http\Controllers\relations;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\Models\Phone;
use App\Models\Hospital;
use App\Models\Doctor;

class RelationsController extends Controller
{
    public function hasOne() {
        // \App\User::where('id', 3)->first();
        // $user = \App\User::find(3);
        // return $user->phone; // phone is the function name in User Model
        
        // $user = \App\User::with('relation function name')->find(3);
        // $user = User::with('phone')->find(3);

        $user = User::with(['phone'=>function($query) {
            $query->select('code', 'phone', 'user_id');
        }])->find(3);
        // return $user->phone->code.$user->phone->phone;
        
        return response() -> json($user);

    }

    public function hasOneReverse() {
        // $phone = Phone::with('user')->find(1);
        
        // get both tables using with('relation function name') || with(['', function() {}])
        $phone = Phone::with(['user'=> function($query){
            $query->select('id', 'name', 'email');
        }])->find(1);
        
        // any thing hidden that i want to use in the method
        // $phone->makeVisible(['user_id']); // make the hidden field visible
        // $phone->makeHidden(['id']); // hidden field
        
        return $phone;
        // return $phone->user; // only the related table

    }

    public function getUserHasPhone() {
        return $users = User::whereHas('phone')->get();
    }

    public function getUserHasNoPhone() {
        return User::whereDoesntHave('phone')->get();
    }

    public function getUserHasPhoneWithCondition() {
        return User::whereHas('phone', function($q){
            $q->where('code','966');
        })->get();
    }

    // One To Mant Relation
    public function hasMany() {
        // return Hospital::where('id',1)->get();
        
        $hospital = Hospital::find(1);
        // return $hospital->doctors;
        
        $doctors = $hospital->doctors;
        // foreach($doctors as $d) {
        //     echo '<p>'.$d->name.' ('.$d->title.')</p>';
        // }

        // return \App\Models\Doctor::find(1);
        // return Doctor::where('hospital_id', 1)->get();
        
        // $doctor = Doctor::find(1);
        // return $doctor->name .' <u>works in</u> '. $doctor -> hospital ->name;
        
        $doctors = Doctor::all();

        foreach($doctors as $doctor) {
            echo '<p>'.$doctor->name .' ('.$doctor->title.') <u>works in</u> '. $doctor -> hospital ->name.'</p>';
        }

    }

    public function hospitals() {
        $hospitals = Hospital::select('id', 'name', 'address')->get();
        return view('hospital.hospital', compact('hospitals'));
    }

    public function doctors($hospital_id) {
        // $doctors = Doctor::where('hospital_id', $hospital_id)->get();
        $hospital = Hospital::find($hospital_id);
        $doctors = $hospital -> doctors;
        return view('hospital.doctors', compact(['doctors', 'hospital']));
    }

    public function hasDoctors() {
        return Hospital::whereHas('doctors')->get();
    }
    
    public function hasMaleDoctors() {
        return Hospital::whereHas('doctors')->with(['doctors'=> function($q) {
            $q->where('gender', 1);
        }])->get();
    }
    
    public function hasNoDoctors() {
        return Hospital::whereDoesntHave('doctors')->get();
    }

    public function deleteHospital($id) {
        $hospital = Hospital::find($id);
        
        if(!$hospital)
            return abort('404');

        $hospital->doctors()->delete(); // delete child
        $hospital->delete(); // delete parent

        return redirect()->route('hospitals');
    }
}
