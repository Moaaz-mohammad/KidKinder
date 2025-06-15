@extends('layouts.theme')

@section('page-title', 'Join')

@section('css')
    
@endsection

@section('content')
@php
    $user = Auth::user();
@endphp
  <div class="container-fluid p-5">
    <div class="container">
      <div class="card card-primary">
        <div class="card-header">
          <h3 class="card-title">Join Form</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form action="{{route('class.request.store')}}" method="POST">
          @csrf
          <input type="hidden" name="class_id" value="{{$class->id}}" readonly>
          <input type="hidden" name="student_id" value="{{$user->id}}" readonly>
          <div class="card-body">
            <div class="form-group">
              <label for="name">First Name</label>
              <input type="text" value="{{$user->name}}" class="form-control" name="name" readonly>
            </div>
            <div class="form-group">
              <label for="last_name">Last Name</label>
              <input type="text" value="{{$user->last_name}}" class="form-control" name="last_name" readonly>
            </div>
            <div class="form-group">
              <label for="email">Email</label>
              <input type="email" class="form-control" value="{{$user->email}}" name="email" readonly>
            </div>
            <div class="row">
              <div class="col-sm-6">
                <div class="form-group">
                  <!-- select -->
                  <label>Select</label>
                  <select name="age" class="form-control">
                    @for ($i = $class->from_age; $i <= $class->to_age; $i++)
                      <option value="{{$i}}">{{$i}}</option>
                    @endfor
                  </select>
                </div>
                
              </div>
              <div class="col-sm-6">
                <div class="form-group">
                  <label for="additional_info">Aditional info</label>
                  <textarea class="form-control" name="additional_info"></textarea>
                </div>
              </div>
            </div>
            
          </div>
          <!-- /.card-body -->
          
          <div class="card-footer">
            <button type="submit" class="btn btn-primary">Submit</button>
          </div>
        </form>
      </div>
    </div>
  </div>

  
@endsection