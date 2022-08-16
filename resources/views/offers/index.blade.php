@extends('layouts.master')

@section('content')
    <div class="flex-center position-ref full-height">

        <div class="content">
            <div class="title m-b-md">
{{--                {{__('messages.laravel')}}--}}
                @lang('messages.laravel')
            </div>
            @if(Session::has('success'))
            <span style="background-color: #c7eed8; color:#2a9055; padding:1rem;">
                {{Session::get('success')}}
            </span>
            @endif
            <table>
                <thead>
                <tr>
                    <th>Name</th>
                    <th>Price</th>
                    <th>Details</th>
                </tr>
                </thead>
                <tbody>
                @foreach($offers as $offer)
                <tr>
                    <td>{{$offer->name}}</td>
                    <td>{{$offer->price}}</td>
                    <td>{{$offer->details}}</td>
                </tr>
                @endforeach
                </tbody>
                <tfoot>
                <tr>
                   <td colspan="3">
                       <a href="{{url('offers/create')}}">
                           Create A New Offer
                       </a>
                   </td>
                </tr>
                </tfoot>
            </table>


        </div>
    </div>
@stop
