@extends('layouts.dashboard')

@section('page-title', 'Add')

@section('content')
    <div class="col-lg-6">
        <div class="card card-success">
            <div class="card-header">
                <h3 class="card-title">Add Student</h3>
            </div>
            <x-student-form :action="route('student.store')">
                
            </x-student-form>
        </div>
    </div>
@endsection
