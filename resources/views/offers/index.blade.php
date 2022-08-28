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
                    <th>#</th>
                    <th>{{trans('messages.offer name')}}</th>
                    <th>{{__('messages.offer price')}}</th>
                    <th>@lang('messages.offer details')</th>
                    <th>{{__('messages.Operation')}}</th>
                </tr>
                </thead>
                <tbody>
                @foreach($offers as $offer)
                <tr>
                    <td>{{$offer->id}}</td>
                    <td>{{$offer->name}}</td>
                    <td>{{$offer->price}}</td>
                    <td>{{$offer->details}}</td>
                    <td>
                        <a href="{{url('offers/edit/'.$offer->id)}}">
                            {{trans('messages.edit')}}
                        </a>
                    </td>
                </tr>
                @endforeach
                </tbody>
                <tfoot>
                <tr>
                   <td colspan="5">
                       <a href="{{url('offers/create')}}">
                           @lang('messages.offer create')
                       </a>
                   </td>
                </tr>
                </tfoot>
            </table>


        </div>
    </div>
@stop
