@extends('layouts.dashboard')
@section('page-title', 'Dashboard')

@section('css')
  <style>
        .teacher-card {
            width: 160px;
            margin: 0 auto;
            text-align: center;
            padding: 15px 10px;
            border-radius: 8px;
            transition: all 0.2s;
        }
        .teacher-card:hover {
            background-color: #f8f9fa;
            transform: translateY(-3px);
        }
        .teacher-img {
            width: 80px;
            height: 80px;
            object-fit: cover;
            margin-bottom: 10px;
            border: 3px solid white;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        .teacher-name {
            font-size: 0.9rem;
            font-weight: 600;
            margin-bottom: 2px;
        }
        .teacher-subject {
            font-size: 0.75rem;
            color: #6c757d;
            margin-bottom: 5px;
        }
        .teacher-contact {
            font-size: 0.7rem;
        }

        /* Classes Section */
        .class-card {
            width: 160px;
            margin: 0 auto;
            text-align: center;
            padding: 15px 10px;
            border-radius: 8px;
            transition: all 0.2s;
            border: 1px solid #dee2e6;
        }
        .class-card:hover {
            background-color: #f8f9fa;
            transform: translateY(-3px);
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }
        .class-icon {
            width: 60px;
            height: 60px;
            margin-bottom: 10px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            background-color: #e9ecef;
            border-radius: 50%;
            font-size: 24px;
        }
        .class-name {
            font-size: 0.9rem;
            font-weight: 600;
            margin-bottom: 2px;
        }
        .class-teacher {
            font-size: 0.75rem;
            color: #6c757d;
            margin-bottom: 5px;
        }
        .class-time {
            font-size: 0.7rem;
            background-color: #e9ecef;
            border-radius: 4px;
            padding: 2px 5px;
            display: inline-block;
        }

          .pagination {
            display: flex;
            justify-content: center;
            margin-top: 25px;
            gap: 5px;
        }
    </style>
@endsection

@section('content')
    <h1>Overview</h1>
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
              <a class="nav-link" href="#revenue-chart" data-toggle="tab">Team</a>
            </li>
            <li class="nav-item">
              <a class="nav-link active" href="#classes" data-toggle="tab">Classes</a>
            </li>
          </ul>
        </div>
      </div><!-- /.card-header -->
      <div class="card-body">
        <div class="tab-content p-0">
          <!-- Morris chart - Sales -->
          <div class="chart tab-pane" id="revenue-chart" style="position: relative;">
            <div class="container py-4">
              <h4 class="text-center mb-4">Teaching Staff</h4>
              
              <!-- Teacher Grid -->
              <div class="row justify-content-center g-3">
                  <!-- Teacher 1 -->
                  @foreach ($teachers as $teacher)
                    <div class="col-6 col-sm-4 col-md-3 col-lg-2">
                      <div class="teacher-card">
                          @if ($teacher->images()->exists())
                            <img src="{{asset('storage/images/' . $teacher->images()->first()->file_name)}}" class="rounded-circle teacher-img" alt="No Photo">
                          @else
                            <img src="{{asset('dashboard/dist/img/NoPhoto.jpg')}}" class="card-img-top" alt="No photo">
                          @endif
                          <div class="teacher-name">{{$teacher->name}}</div>
                          <div class="teacher-subject">{{$teacher->teachingContents->first()->subject_1 ?? 'No Subject'}}</div>
                          <a href="mailto:sjohnson@school.edu" class="teacher-contact">{{$teacher->email ?? ''}}</a>
                      </div>
                    </div>
                  @endforeach
              </div>
            </div>
          </div>

          <div class="chart tab-pane " id="sales-chart" style="position: relative;">
            <div class="col-12 col-sm-6 col-md-2">
              <div class="info-box mb-3">
                <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-users"></i></span>
                <div class="info-box-content">
                  <span class="info-box-text">Students Count</span>
                  <span class="info-box-number">{{$studentsCount > 0 ? $studentsCount : 0}}</span>
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
              @if (count($students) > 0)
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
                              <img class="img-circle elevation-2"  style="width: 100px; height: 100px;  object-fit: cover;" src="{{asset($student->images()->first()->file_path)}}" alt="User Avatar">
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
              @endif
              
              <!-- /.card-body -->
            </div>
          </div>

          <div class="chart tab-pane active" id="classes" style="position: relative;">
            <div class="container py-4">
                <h4 class="text-center mb-4">School Classes</h4>
                
                <!-- Classes Grid -->
                <div class="row justify-content-center g-3">
                  
                  @foreach ($classes as $class)
                  @php
                    $fromTime = \Carbon\Carbon::parse($class->from_time)->format('h:i A');
                    $toTime = \Carbon\Carbon::parse($class->to)->format('h:i A');
                  @endphp
                    <div class="col-6 col-sm-4 col-md-3 col-lg-2">
                        <div class="class-card">
                            <div class="class-icon text-success">
                                <i class="bi bi-book"></i>
                            </div>
                            <div class="class-name fs-5">{{$class->class_content_name}}</div>
                            <div class="class-teacher text-danger fs-4">${{$class->tution_fee}}</div>
                            <div class="class-time fs-6">{{$fromTime .'/'. $toTime}}</div>
                        </div>
                    </div>
                  @endforeach

                  <div class="pagination">
                    {{$classes->links()}}
                  </div>
                </div>
            </div>
          </div>
        </div>
      </div><!-- /.card-body -->
    </div>
@endsection