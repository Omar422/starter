<?php

namespace App\Http\Controllers;

use App\Http\Requests\OfferRequest;
use App\Models\Offer;
use LaravelLocalization;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CrudController extends Controller
{
    public function getOffers(){
//        return Offer::get();
        return Offer::select('name', 'price')->get();
    }

    public function index(){
//        $offers = Offer::get();
//        return view('offers.index', ['offers'=>$offers]);
        $offers = Offer::select(
            'id', 'price',
            'name_'.LaravelLocalization::getCurrentLocale().' as name',
            'details_'.LaravelLocalization::getCurrentLocale().' as details')->get();
//        print(LaravelLocalization::getCurrentLocale());
        return view('offers.index', compact('offers'));
    }

    public function create(){
        return view('offers.create');
    }

    public function store(OfferRequest $request){
/*
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
*/

        // save img in folder that i added in config/filesystem
        $file_extension = $request -> photo -> getClientOriginalExtension();
        $file_name = time().'.'.$file_extension;
        $path = 'images/offers';
        // from form to folder
        $request->photo->move($path, $file_name);
        return 'okay';
        // insert the data
        Offer::create([
            'photo'            => $file_name,
            'name_ar'          => $request->name_ar,
            'name_en'          => $request->name_en,
            'price'            => $request->price,
            'details_ar'       => $request->details_ar,
            'details_en'       => $request->details_en
        ]);
        return redirect('offers')->with(['success'=>'Offer Added']);
    }
/*
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
    }*/

    public function edit($offer_id){
//        Offer::findOrFail($offer_id);
        $offer = Offer::find($offer_id);
        if(!$offer)
            return redirect('offers')->with(['fails'=>'No ']);

        $offer = Offer::select('id','name_ar', 'name_en', 'details_ar', 'details_en', 'price')->find($offer_id);
        return view('offers.edit', compact('offer'));

    }

    public function update(OfferRequest $request, $offer_id){
        $offer = Offer::find($offer_id);
        if (!$offer){
            return redirect()->back();
        }
//
//        $offer->update([
//            'name_ar' => $request->name_ar,
//            'name_en' => $request->name_en,
//            'price' => $request->price,
//            'details_ar' => $request->details_ar,
//            'details_en' => $request->details_en,
//            'details_en' => $file_name,
//        ]);
        $offer->update($request->all());
        return redirect('offers')->with(['success'=>'Updated']);
    }
}
