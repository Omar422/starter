<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\VerifiesEmails;

class UserController extends Controller
{
    public function showUserName(){
        return 'hello there';
    }

    public function showindex(){

//        return view('welcome')->with('name','omar');
//        return view('welcome')->with(['name'=>'omar', 'age'=>26]);

//        $data = [];
//        $data['name'] = 'omar';
//        $data['age'] = 26;
//        return view('welcome', $data);

        $obj = new \stdClass();
        $obj->name = 'omar';
        $obj->age = 26;
        $empty = [] ;
        return view('welcome', compact('obj', 'empty'));

    }
}
