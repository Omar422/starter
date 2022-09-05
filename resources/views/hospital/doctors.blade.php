@extends('layouts.app')

@section('content')
    
    <div class="container">
        <table class="table">
            
            <p>Doctors in Hospital 
                <span style="color: aqua; font-weight: bold">{{$hospital->name}}</span>
            </p>
            
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">name</th>
                <th scope="col">title</th>
              </tr>
            </thead>
            <tbody>
                @if (isset($doctors) && $doctors->count() > 0)
                    
                @foreach ($doctors as $doctor)
                <tr>
                    <th scope="row">{{$doctor->id}}</th>
                    <td>{{$doctor->name}}</td>
                    <td>{{$doctor->title}}</td>
                </tr>
                
                @endforeach
                @endif
            </tbody>
          </table>
        
    </div>

@stop