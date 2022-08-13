<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class SecondController extends Controller
{
    // this function will request auth to access any methods
    public function __construct(){
        $this -> middleware('auth')->except(['showString1','showString2']);
    }

    public function showString(){
        return 'Show String';
    }

    public function showString1(){
        return 'Show String1';
    }

    public function showString2(){
        return 'Show String2';
    }

    public function showString3(){
        return 'Show String3';
    }

    public function showString4(){
        return 'Show String4';
    }
}
