@extends('layouts.dashboard')
@section('page-title', 'Add Teacher')

@section('content')
    <div class="col-lg-6">
        <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">New Teacher</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form action="{{route('teacher.index')}}" enctype="multipart/form-data" method="POST" class="card-body">
            @csrf
            {{-- <input type="hidden" name="_token" value="JgHpILrtp5tJtg5W7GtyPKPPNW5lf0UHZwjOispz" autocomplete="off"><div class="card-body"> --}}
            <div class="form-group">
                <label for="teacherName">Teacher Name</label>
                <input type="text" class="form-control" id="teacherName" placeholder="Enter teacher name" name="name" required>
            </div>
            {{-- <div class="form-group">
                <div class="custom-file">
                    <input type="file" class="custom-file-input" id="customFile">
                    <label class="custom-file-label" for="customFile">Choose Photo</label>
                </div>
            </div> --}}
            <div class="form-group">
                <label for="teachingContent">Teaching content</label>
                {{-- <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Enter Class Number"> --}}
                <div class="card-body">
                <div class="row">
                    <div class="col-4">
                    <input type="text" name="subject_1" class="form-control" placeholder="Content"required>
                    </div>
                    <div class="col-4">
                    <input type="text" name="subject_2" class="form-control" placeholder="Content">
                    </div>
                    <div class="col-4">
                    <input type="text" name="subject_3" class="form-control" placeholder="Content">
                    </div>
                </div>
                </div>
            </div>
            <div class="form-group">
                <label for="ClassContentName">Social media</label>
                <input type="url" class="form-control mb-1" name="url_1" placeholder="Instagram">
                <input type="url" class="form-control mb-1" name="url_2" placeholder="Facebook">
                <input type="url" class="form-control" name="url_3" placeholder="X">
            </div>
            {{-- <div class="form-group">
                <label for="Tution_Fee">Class Times</label>
                <div class="d-flex">
                <div class="col-lg-4">
                    <span class="text-bold">From</span>
                    <input type="time" class="form-control" id="Tution_Fee" placeholder="Enter Tution Fee">
                </div>
                <div class="col-lg-4">
                    <span class="text-bold">To</span>
                    <input type="time" class="form-control" id="Tution_Fee" placeholder="Enter Tution Fee">
                </div>
                </div>
            </div> --}}
            {{-- <div class="form-group">
                <label>Class</label>
                <div class="custom-control custom-checkbox">
                    <div class="row">
                        <div class="col-3">
                            <input class="custom-control-input" type="checkbox" id="customCheckbox1" value="option1">
                            <label for="customCheckbox1" class="custom-control-label">Class Name</label>
                        </div>
                        <div class="col-3">
                            <input class="custom-control-input" type="checkbox" id="customCheckbox1-1" value="option1">
                            <label for="customCheckbox1-1" class="custom-control-label">Class Name</label>
                        </div>
                    </div>
                </div>
            </div> --}}
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