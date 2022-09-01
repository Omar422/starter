@extends('layouts.master')

@section('content')
    <div class="flex-center position-ref full-height">

        <div class="content">
            <div class="title m-b-md">
{{--                {{__('messages.laravel')}}--}}
                @lang('messages.laravel')
            </div>
            <div class="alert alert-success" id="success-msg" style="display: none">
                تم الحذف بنجاح
            </div>
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
                <tr class="offerNo{{$offer->id}}">
                    <td>{{$offer->id}}</td>
                    <td>{{$offer->name}}</td>
                    <td>{{$offer->price}}</td>
                    <td>{{$offer->details}}</td>
                    <td>
                        <img src="{{asset('images/offers/'.$offer->photo)}}" style="width: 100px;height:100px" class="src">
                    </td>
                    <td>
                        <a href="{{url('offers/edit/'.$offer->id)}}" class="btn btn-primary">
                            {{trans('messages.edit')}}
                        </a>
                        <a href="{{route('offer_delete',$offer->id)}}" class="btn btn-danger">
                            {{trans('messages.delete')}}
                        </a>
                        <a href="{{route('ajax-delete')}}" class="btn-ajax-delete btn btn-info" offer_id = "{{$offer->id}}">
                            {{trans('messages.delete')}} Ajax
                        </a>
                        <a href="{{route('ajax-edit', $offer->id)}}" class="btn btn-info">
                            {{trans('messages.edit')}} Ajax
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

@section('script')
    <script>
        $(document).on('click', '.btn-ajax-delete', function(e){
            e.preventDefault();
            var offer_id = $(this).attr('offer_id');
            
            $.ajax({
                type        : "post",
                url         : "{{route('ajax-delete')}}",
                data        : {
                    '_token'    : "{{csrf_token()}}",
                    'id'        : offer_id
                },
                
                success     : function(data) {

                    if(data.status == true)
                        // alert(data.msg)
                        $('#success-msg').show();
                        $('.offerNo'+data.id).remove();

                },
                error       : function(reject) {

                }

            });
        });
    </script>
@stop
