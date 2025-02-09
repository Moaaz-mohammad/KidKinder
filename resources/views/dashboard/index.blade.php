@extends('layouts.dashboard')
@section('page-title', 'Dashboard')

@section('content')
    <h1>Welcome</h1>
    <div class="card">
      <div class="card-header ui-sortable-handle" style="cursor: movee;">
        <h3 class="card-title">
          <i class="fas fa-th mr-2"></i>
          Control
        </h3>
        <div class="card-tools">
          <ul class="nav nav-pills ml-auto">
            <li class="nav-item">
              <a class="nav-link " href="#sales-chart" data-toggle="tab">Students</a>
            </li>
            <li class="nav-item">
              <a class="nav-link active" href="#revenue-chart" data-toggle="tab">Team</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#classes" data-toggle="tab">Classes</a>
            </li>
          </ul>
        </div>
      </div><!-- /.card-header -->
      <div class="card-body">
        <div class="tab-content p-0">
          <!-- Morris chart - Sales -->
          <div class="chart tab-pane active" id="revenue-chart" style="position: relative;">
            H1
          </div>
          <div class="chart tab-pane " id="sales-chart" style="position: relative;">
            <div class="col-12 col-sm-6 col-md-2">
              <div class="info-box mb-3">
                <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-users"></i></span>
                <div class="info-box-content">
                  <span class="info-box-text">Students Count</span>
                  <span class="info-box-number">{{$studentsCount}}</span>
                </div>
                <!-- /.info-box-content -->
              </div>
              <!-- /.info-box -->
            </div>
            <div class="card mx-2">
              <div class="card-header">
                <h3 class="card-title">Students</h3>
              <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body p-2">
                <div class="row">
                  @foreach ($students as $student)
                  <div class="col-md-4">
                    <!-- Widget: user widget style 1 -->
                    <div class="card card-widget widget-user">
                      <!-- Add the bg color to the header using any of the bg-* classes -->
                      <div class="widget-user-header bg-info" style="background: url( {{asset('dashboard/dist/img/Student_home_background.jpg')}} ) no-repeat center center; background-size: cover;">
                        {{-- <h3 class="widget-user-username">{{$student->first_name}}</h3> --}}
                        {{-- <h5 class="widget-user-desc">{{$student->student_forign_id}}</h5> --}}
                      </div>
                      <div class="widget-user-image"> {{-- no-repeat center center--}}
                        @if ($student->images()->count() > 0)
                        <img class="img-circle elevation-2" src="{{asset($student->images()->first()->file_path)}}" alt="User Avatar">
                        @else
                          <img src="" alt="No Photo">
                        @endif
                      </div>
                      <div class="card-footer">
                        <div class="row">
                          <div class="col-sm-4 border-right">
                            <div class="description-block">
                              <h5 class="description-header">{{$student->student_forign_id}}</h5>
                              <span class="description-text">Student Number</span>
                            </div>
                            <!-- /.description-block -->
                          </div>
                          <!-- /.col -->
                          <div class="col-sm-4 border-right">
                            <div class="description-block mt-4">
                              <h5 class="description-header">{{$student->first_name}}</h5>
                              <span class="description-text">Student Name</span>
                            </div>
                            <!-- /.description-block -->
                          </div>
                          <!-- /.col -->
                          <div class="col-sm-4">
                            <div class="description-block">
                              <h5 class="description-header">35</h5>
                              <span class="description-text">Student Age</span>
                            </div>
                            <!-- /.description-block -->
                          </div>
                          <!-- /.col -->
                        </div>
                        <!-- /.row -->
                      </div>
                    </div>
                    <!-- /.widget-user -->
                  </div>
                  @endforeach
                </div>
                <!-- /.users-list -->
              </div>
              <!-- /.card-body -->
            </div>
          </div>
          <div class="chart tab-pane" id="classes" style="position: relative;">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Class Name</h3>
              <div class="card-tools">
                <span class="badge badge-danger">Main Teacher: <span>Khaled </span></span>
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body p-0">
                <ul class="users-list clearfix">
                  <li>
                    <img src="dist/img/user1-128x128.jpg" alt="User Image">
                    <a class="users-list-name" href="#">Alexander Pierce</a>
                    <span class="users-list-date">Today</span>
                </ul>
                <!-- /.users-list -->
              </div>
              <!-- /.card-body -->
            </div>
          </div>
        </div>
      </div><!-- /.card-body -->
    </div>
@endsection