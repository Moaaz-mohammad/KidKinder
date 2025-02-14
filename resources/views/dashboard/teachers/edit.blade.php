@extends('layouts.dashboard')

@section('page-title', 'Edit')


@section('content')
  <x-teacher-form buttonText="Edit" action="{{route('teacher.update', $teacher->id)}}">

  </x-teacher-form>
@endsection