@extends('layouts.dashboard')

@section('page-title', 'Profile')

@section('content')
<div class="col-md-3">

  <!-- Profile Image -->
  <div class="card card-primary card-outline">
    <div class="card-body box-profile">
      <div class="text-center">
        {{-- @if ($user->images()->first()->file_path > 0) --}}
          <img class="profile-user-img img-fluid img-circle" src="{{asset('dashboard/dist/img/user4-128x128.jpg')}}" alt="User profile picture">
        {{-- @endif --}}
      </div>

      <h3 class="profile-username text-center">{{$user->name}}</h3>

      <p class="text-muted text-center">{{$user->email}}</p>

      <ul class="list-group list-group-unbordered mb-3">
        <li class="list-group-item">
          <b>Joined Date</b> <a class="float-right">{{$user->created_at->format('Y/m/d')}}</a>
        </li>
        {{-- <li class="list-group-item">
          <b>Following</b> <a class="float-right">{{}}</a>
        </li>
        <li class="list-group-item">
          <b>Friends</b> <a class="float-right">13,287</a>
        </li> --}}
      </ul>

      <a href="#" class="btn btn-primary btn-block"><b>Edit</b></a>
    </div>
    <!-- /.card-body -->
  </div>
  <!-- /.card -->

  <!-- About Me Box -->
  {{-- <div class="card card-primary">
    <div class="card-header">
      <h3 class="card-title">About Me</h3>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
      <strong><i class="fas fa-book mr-1"></i> Education</strong>

      <p class="text-muted">
        B.S. in Computer Science from the University of Tennessee at Knoxville
      </p>

      <hr>

      <strong><i class="fas fa-map-marker-alt mr-1"></i> Location</strong>

      <p class="text-muted">Malibu, California</p>

      <hr>

      <strong><i class="fas fa-pencil-alt mr-1"></i> Skills</strong>

      <p class="text-muted">
        <span class="tag tag-danger">UI Design</span>
        <span class="tag tag-success">Coding</span>
        <span class="tag tag-info">Javascript</span>
        <span class="tag tag-warning">PHP</span>
        <span class="tag tag-primary">Node.js</span>
      </p>

      <hr>

      <strong><i class="far fa-file-alt mr-1"></i> Notes</strong>

      <p class="text-muted">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam fermentum enim neque.</p>
    </div>
    <!-- /.card-body -->
  </div> --}}
  <!-- /.card -->
</div>
@endsection