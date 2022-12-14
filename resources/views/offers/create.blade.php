@extends('layouts.master')

@section('content')
    <div class="flex-center position-ref full-height">

        <div class="content">
            <div class="title m-b-md">
                {{__('messages.laravel')}}
            </div>
            <form method="POST" action="{{route('offer_store')}}" enctype="multipart/form-data">
{{--                @csrf--}}
                <input name="_token" hidden value="{{csrf_token()}}">

                <div class="form-group">
                    <input type="file" class="form-control" name="photo">
                </div>
                @error('photo')
                <span style="color: #761b18">{{$message}}</span>
                @enderror


                <div class="form-group">
                    <input type="text" class="form-control" name="name_en" placeholder="{{trans('messages.offer name en')}}">
                </div>
                @error('name_en')
                <span style="color: #761b18">{{$message}}</span>
                @enderror

                <div class="form-group">
                    <input type="text" class="form-control" name="name_ar" placeholder="{{__('messages.offer name ar')}}">
                </div>
                @error('name_ar')
                <span style="color: #761b18">{{$message}}</span>
                @enderror

                <div class="form-group">
                    <input type="text" class="form-control" name="price" placeholder="{{__('messages.offer price')}}">
                </div>
                @error('price')
                <span style="color: #761b18">{{$message}}</span>
                @enderror

                <div class="form-group">
                    <input type="text" class="form-control" name="details_en" placeholder="{{__('messages.offer details en')}}">
                </div>
                @error('details_en')
                <span style="color: #761b18">{{$message}}</span>
                @enderror
                <div class="form-group">
                    <input type="text" class="form-control" name="details_ar" placeholder="@lang('messages.offer details ar')">
                </div>
                @error('details_ar')
                <span style="color: #761b18">{{$message}}</span>
                @enderror

                <div class="form-group">
                    <button type="submit">
                        {{trans('messages.save')}}
                    </button>
                </div>
            </form>


        </div>
    </div>
@stop
