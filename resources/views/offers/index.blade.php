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
                    <th>photo</th>
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
                        <img src="{{asset('images/offers/'.$offer->photo)}}" style="width:100px;height:100px">
                    </td>
                    <td>
                        <a class="btn btn-primary" href="{{url('offers/edit/'.$offer->id)}}">
                            {{trans('messages.edit')}}
                        </a>
                        <a class="btn btn-danger" href="{{route('offer_delete',$offer->id)}}">
                            {{trans('messages.delete')}}
                        </a>
                    </td>
                </tr>
                @endforeach
                </tbody>
                <tfoot>
                <tr>
                   <td colspan="6">
                       <a href="{{url('offers/create')}}" class="btn btn-success">
                           @lang('messages.offer create')
                       </a>
                   </td>
                </tr>
                </tfoot>
            </table>


        </div>
    </div>
@stop
