@extends('layouts.dashboard')

@section('page-title', 'Edit')

@section('content')
  <div class="row">
    <div class="col-lg-6">
      <div class="card card-info">
        <div class="card-header">
            <h3 class="card-title">Edit {{$student->first_name}}</h3>
        </div>
        <x-student-form :method="'PUT'" :action="route('student.update', $student->id)" :student="$student">
      
        </x-student-form>
      </div>
    </div>
    <div class="col-lg-4">
      <div class="text-center">
        <div class="card card-info p-4">
          <div class="card-header">
            <h3 class="card-title fs-">
              {{$student->first_name}} Photo
            </h3>
          </div>
          <div class="image mt-2">
            @if ($student->images()->count() > 0)
              <img src="{{asset($student->images()->first()->file_path)}}" style="width: 300px; height: 300px;  object-fit: cover;" class="img-circle elevation-2" alt="Student Image">
            @endif
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection