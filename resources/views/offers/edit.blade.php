@extends('layouts.master')

@section('content')
    <div class="flex-center position-ref full-height">

        <div class="content">
            <div class="title m-b-md">
                {{__('messages.laravel')}}
            </div>
            <form method="POST" action="{{route('offer_update', $offer->id)}}">
{{--                @csrf--}}
                <input name="_token" hidden value="{{csrf_token()}}">

                <div class="form-group">
                    <input type="text" class="form-control" name="name_en" value="{{$offer->name_en}}" placeholder="{{trans('messages.offer name en')}}">
                </div>
                @error('name_en')
                <span style="color: #761b18">{{$message}}</span>
                @enderror

                <div class="form-group">
                    <input type="text" class="form-control" name="name_ar" value="{{$offer->name_ar}}" placeholder="{{__('messages.offer name ar')}}">
                </div>
                @error('name_ar')
                <span style="color: #761b18">{{$message}}</span>
                @enderror

                <div class="form-group">
                    <input type="text" class="form-control" name="price" value="{{$offer->price}}" placeholder="{{__('messages.offer price')}}">
                </div>
                @error('price')
                <span style="color: #761b18">{{$message}}</span>
                @enderror

                <div class="form-group">
                    <input type="text" class="form-control" name="details_en" value="{{$offer->details_en}}" placeholder="{{__('messages.offer details en')}}">
                </div>
                @error('details_en')
                <span style="color: #761b18">{{$message}}</span>
                @enderror
                <div class="form-group">
                    <input type="text" class="form-control" name="details_ar" value="{{$offer->details_ar}}" placeholder="@lang('messages.offer details ar')">
                </div>
                @error('details_ar')
                <span style="color: #761b18">{{$message}}</span>
                @enderror

                <div class="form-group">
                    <button type="submit">
                        {{trans('messages.update')}}
                    </button>
                </div>
            </form>


        </div>
    </div>
@stop
