@extends('layouts.dashboard')

@section('page-title', 'Create')

@section('content')
<div class="col-lg-6">
    <div class="card card-primary">
    <div class="card-header">
        <h3 class="card-title">New Student</h3>
    </div>
    <!-- /.card-header -->
    <!-- form start -->
    <form action="{{route('student.store')}}" enctype="multipart/form-data" method="POST" class="card-body">
        @csrf
        {{-- <input type="hidden" name="_token" value="JgHpILrtp5tJtg5W7GtyPKPPNW5lf0UHZwjOispz" autocomplete="off"><div class="card-body"> --}}
        <div class="form-group">
            <label for="StudentFirstName">First Name</label>
            <input type="text" class="form-control" id="StudentFirstName" placeholder="Enter student first name" name="first_name" required>
        </div>
        <div class="form-group">
            <label for="StudenLastName">Last Name</label>
            <input type="text" class="form-control" id="StudenLastName" placeholder="Enter student last name" name="last_name" required>
        </div>
        <div class="form-group">
            <label for="StudentID">ID Number</label>
            <input type="text" class="form-control" id="StudentID" placeholder="Enter ID" name="student_forign_id" required>
        </div>
        <div class="form-group">
            <label for="StudentID">Student Age</label>
            <input type="number" class="form-control" id="StudentID" placeholder="Enter age of student" name="age" required>
        </div>
        <div class="form-group">
            <div class="custom-file">
                <input type="file" name="image" class="" id="image">
                {{-- <label class="custom-file-label" for="image">Choose Photo</label> --}}
            </div>
        </div>
        <div class="form-group">
            <label for="Description">Description</label>
            <textarea class="form-control" name="description" id="Description" rows="3" placeholder=""></textarea>
        </div>
        <!-- /.card-body -->
        <div class="card-footer ">
        <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    </form>
    
    </div>
</div>
@endsection
