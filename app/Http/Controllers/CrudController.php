<?php

namespace App\Http\Controllers;

use App\Models\Offer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CrudController extends Controller
{
    public function getOffers(){
//        return Offer::get();
        return Offer::select('name', 'price')->get();
    }

    public function index(){
        $offers = Offer::get();
        return view('offers.index', ['offers'=>$offers]);
    }

    public function create(){
        return view('offers.create');
    }

//    public function store(){
//        Offer::create([
//            'name'      =>  'Offer 3',
//            'price'     =>  '450',
//            'details'   =>  'This Is Offer 3 details.',
//        ]);
//    }

    public function store(Request $request){
        //return $request;
        // validate first then save
        $data       = $this->getDate($request);
        $rules      = $this->getRules();
        $messages   = $this->getMessages();
        $validator = Validator::make($data, $rules, $messages);

        if($validator->fails()){
//            return $validator->errors();
            return redirect()
                ->to('offers/create')
                ->withErrors($validator)
                ->withInput($data);
        }

        // insert the data
        Offer::create([
            'name'          => $request->name,
            'price'         => $request->price,
            'details'       => $request->details
        ]);
//        return redirect('offers');
        return redirect('offers')->with(['success'=>'Offer Added']);
    }

    protected function getDate($req){
        return $req->all();
    }

    protected function getRules(){
        return [
            // 'name' => 'rule1|rule2',
            'name'      => 'required|max:100|unique:offers,name',
            'price'     => 'required|numeric',
            'details'   => 'required'
        ];
    }
    protected function getMessages(){
        return [
            'name.unique'   => __('messages.offer name unique'),
            'price.numeric' => trans('messages.offer price numeric'),
        ];
    }
}
