@extends('layouts.dashboard')

@section('pagr-title', 'Show')

@section('content')
    <div class="row">
        <div class="col-lg-3">
            <ul class="list-group">
                <li class="list-group-item active" aria-current="true">Class {{$class->class_content_name}} details</li>
                {{-- <li class="list-group-item"></li> --}}
                <li class="list-group-item">Class Number: {{$class->class_number}}</li>
                <li class="list-group-item fs-5">For age :{{$class->from_age}} to {{$class->to_age}}</li>
            </ul>
        </div>
        <div class="col-lg-4">
            <div class="small-box bg-info">
                <div class="inner">
                    <p>Class studnts number</p>
                    <h3>{{$class->students->count()}}</h3>
                </div>
                <div class="icon">
                    <i class="fas fa-user-plus"></i>
                </div>
                </div>
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Class Students</h3>
                        <div class="card-tools">
                        <span class="badge badge-info">Created At: <span>{{'Year: '.$class->created_at->year .' '. 'Month: ' .$class->created_at->month }}</span></span>
                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                            <i class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body p-0" style="display: block;">
                        <ul class="users-list clearfix">
                            @if ($class->Students)
                                @foreach($class->students as $student)
                                <li>
                                    @if ($student->images()->exists())
                                        <img src="{{asset('storage/images/' . $student->images->first()->file_name)}}" style="width: 100px; height: 100px;  object-fit: cover;"  alt="User Image">
                                    @else
                                        <img src="{{asset('dashboard/dist/img/NoPhoto.jpg')}}" class="card-img-top" alt="Student Image">
                                    @endif
                                    <a class="users-list-name" href="#">{{$student->first_name}}</a>
                                    <span class="users-list-date">{{$student->age}}</span>
                                </li>
                                @endforeach
                            @endif
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
