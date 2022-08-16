@extends('layouts.master')

@section('content')
    <div class="flex-center position-ref full-height">

        <div class="content">
            <div class="title m-b-md">
                {{__('messages.laravel')}}
            </div>
            <form method="POST" action="{{route('offer_store')}}">
{{--                @csrf--}}
                <input name="_token" hidden value="{{csrf_token()}}">
                <div class="form-group">
                    <input type="text" class="form-control" name="name" placeholder="Enter Offer Name">
                </div>
                @error('name')
                <span style="color: #761b18">{{$message}}</span>
                @enderror
                <div class="form-group">
                    <input type="text" class="form-control" name="price" placeholder="Enter Offer Price">
                </div>
                @error('price')
                <span style="color: #761b18">{{$message}}</span>
                @enderror
                <div class="form-group">
                    <input type="text" class="form-control" name="details" placeholder="Enter Offer Details">
                </div>
                @error('details')
                <span style="color: #761b18">{{$message}}</span>
                @enderror
                <div class="form-group">
                    <button type="submit">Store Offer</button>
                </div>
            </form>


        </div>
    </div>
@stop
