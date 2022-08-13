@extends('layouts.master')

@section('content')
    <div class="flex-center position-ref full-height">
        @if (Route::has('login'))
            <div class="top-right links">
                @auth
                    <a href="{{ url('/home') }}">Home</a>
                @else
                    <a href="{{ route('login') }}">Login</a>

                    @if (Route::has('register'))
                        <a href="{{ route('register') }}">Register</a>
                    @endif
                @endauth
            </div>
        @endif

        <div class="content">
            <div class="title m-b-md">
                {{__('messages.laravel')}}
            </div>
            <h1>{{__('messages.greeting')}}</h1>
            {{--                <p>{{$name}}.. {{$age}} years old.</p>--}}
            {{--                <p>{{$name}}.. {{$age}} years old.</p>--}}
{{--            <p>{{$obj->name}}.. {{$obj->age}} years old.</p>--}}

{{--            @if($obj->name == 'omar')--}}
{{--                <p>Hello Mr.Omar</p>--}}
{{--            @endif--}}

{{--            <ul>--}}
{{--                @foreach($obj as $i)--}}
{{--                    <li>{{$i}}</li>--}}
{{--                @endforeach--}}
{{--            </ul>--}}

{{--            <ul>--}}
{{--                @forelse($empty as $i)--}}
{{--                    <li>{{$i}}</li>--}}
{{--                @empty--}}
{{--                    <b>Nothing To Show...!</b>--}}
{{--                @endforelse--}}
{{--            </ul>--}}

        </div>
    </div>
@stop
