@extends('layouts.app')

@section('content')
    
    <div class="container">
        <table class="table">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">name</th>
                <th scope="col">address</th>
                <th scope="col">doctors</th>
              </tr>
            </thead>
            <tbody>
                @if (isset($hospitals) && $hospitals->count() > 0)
                    
                @foreach ($hospitals as $hospital)
                <tr>
                    <th scope="row">{{$hospital->id}}</th>
                    <td>{{$hospital->name}}</td>
                    <td>{{$hospital->address}}</td>
                    <td>
                        <a href="{{route('hospital.doctors', $hospital->id)}}" class="btn btn-primary">
                            Doctors
                        </a>
                        <a href="{{route('hospital.delere', $hospital->id)}}" class="btn btn-danger">Delete</a>
                    </td>
                </tr>
                
                @endforeach
                @endif
            </tbody>
          </table>
        
    </div>

@stop