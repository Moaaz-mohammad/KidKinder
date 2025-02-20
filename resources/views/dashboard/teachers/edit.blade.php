@extends('layouts.dashboard')

@section('page-title', 'Edit')


@section('content')
  <div class="row">
    <div class="col-lg-6">
      <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Edit: {{$teacher->name}}</h3>
        </div>
        <x-teacher-form :teacher="$teacher" buttonText="Update" action="{{route('teacher.update', $teacher->id)}}" method='PUT'>
          
        </x-teacher-form>
      </div>
    </div>
    <div class="col-lg-4">
      <div class="card card-primary p-3">
        <div class="card-header">
          <h3 class="card-title">{{$teacher->name}} - Photo</h3>
        </div>
        <div class="text-center">
          <div class="image mt-2">
            @if ($teacher->images()->count() > 0)
              <img class="img-circle elevation-2" style="width: 300px; height: 300px;  object-fit: cover;" src="{{asset($teacher->images()->first()->file_path)}}">
            @endif
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection