<?php

namespace App\Http\Controllers;

use App\Models\Offer;
use App\Traits\OfferTrait;
use App\Http\Requests\OfferRequest;
use Illuminate\Http\Request;
use LaravelLocalization;

class OffersController extends Controller
{
    use OfferTrait;

    public function create() {
        return view('ajaxoffers.create');
    }

    public function store(OfferRequest $request) {
        $file_name = $this -> saveImage($request->photo, 'images/offers');
        
        // insert the data
        $offer = Offer::create([
            'name_ar'          => $request->name_ar,
            'name_en'          => $request->name_en,
            'price'            => $request->price,
            'details_ar'       => $request->details_ar,
            'details_en'       => $request->details_en,
            'photo'            => $file_name
        ]);

        if($offer)
            return response()->json([
                'status'        => true,
                'msg'           => 'تم الحفظ بنجاح'
            ]);
            
        else
            return response()->json([
                'status'        => false,
                'msg'           => 'لم يتم الحفظ، حاول مرة أخرى'
            ]);
    }

    public function all() {
        $offers = Offer::select(
            'id', 'price', 'photo',
            'name_'.LaravelLocalization::getCurrentLocale().' as name',
            'details_'.LaravelLocalization::getCurrentLocale().' as details')->get(); //->limit(10)
        return view('ajaxoffers.index', compact('offers'));
    }

    public function delete(Request $request) {
        $offer = Offer::find($request->id);
        if(!$offer) {
            return redirect()->back()->with(['error'=>'There\'s no offer with this id']);
        }

        $offer -> delete();
        if($offer)
            return response()->json([
                'status'        => true,
                // 'msg'           => 'تم الحذف بنجاح'
                'id'            => $request->id
            ]);
    }

    public function edit(Request $request, $offer_id){
        $offer = Offer::find($offer_id);
        if(!$offer)
            return redirect('offers')->with(['fails'=>'No ']);

        $offer = Offer::select('id','name_ar', 'name_en', 'details_ar', 'details_en', 'price')->find($offer_id);
        return view('ajaxoffers.edit', compact('offer'));
    }
    public function update(Request $request){
        $offer = Offer::find($request->offer_id);
        if (!$offer){
            // return redirect()->back();
            return response()->json([
                'status'    => false,
                'msg'       => 'لم يتم العثور على العرض',
            ]);
        }
        $offer->update($request->all());
        return response()->json([
            'status'    => true,
            // 'msg'       => 'تم تحديث العرض بنجاح',
        ]);
    }
}
