@extends('layouts.master')

@section('content')
    <div class="flex-center position-ref full-height">

        <div class="content">
            <div class="title m-b-md">
                {{__('messages.laravel')}}
            </div>

            <div class="alert alert-success" id="success-msg" style="display: none">
                تم الحفظ بنجاح
            </div>

            <form id="OfferForm">
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
                    <button class="btn btn-success" id="save">
                        {{trans('messages.save')}}
                    </button>
                </div>
            </form>


        </div>
    </div>
@stop

@section('script')
    <script>
        $(document).on('click', '#save', function(e){
            /*
                data        : {

                    '_token'        : "{{csrf_token()}}",
                    'name_ar'       : $("input[name='name_ar']").val() ,
                    'name_en'       : $("input[name='name_en']").val() ,
                    'price'         : $("input[name='price']").val() ,
                    'details_ar'    : $("input[name='details_ar']").val() ,
                    'details_en'    : $("input[name='details_en']").val() ,
                    'photo'         : $("input[name='photo']").val() ,
                },
            */
            e.preventDefault();
            var formData = new FormData($('#OfferForm')[0]); // save the form in var
            
            $.ajax({
                type        : "post",
                enctype     : "multipart/form-data",
                url         : "{{route('ajax-store')}}",
                data        : formData,
                processData : false,
                contentType : false,
                cache       : false,
                
                success     : function(data) {

                    if(data.status == true)
                        // alert(data.msg)
                        $('#success-msg').show();

                },
                error       : function(reject) {

                }

            });
        });
    </script>
@stop