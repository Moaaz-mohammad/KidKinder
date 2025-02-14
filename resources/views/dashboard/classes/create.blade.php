@extends('layouts.dashboard')
@section('page-title', 'Create')

@section('content')
<div class="row">
  <div class="col-lg-6">
    <div class="card card-primary">
      <div class="card-header">
        <h3 class="card-title">Make Class</h3>
      </div>
      <!-- /.card-header -->
      <!-- form start -->
      
      <form action="{{route('class.store')}}" id="infoForm" method="POST">
        @csrf
        <div class="card-body">
          <div class="form-group">
            <label for="ClassContentName">Class <span class="text-danger">Content</span> Name</label>
            <input type="text" class="form-control" id="ClassContentName" placeholder="Class Content Name" name="class_content_name" required>
          </div>
          <div class="form-group">
            <label for="ClassNumber">Number Of Class</label>
            <input type="number" class="form-control" id="ClassNumber" placeholder="Enter Class Number" name="class_number" required>
          </div>
          {{-- <div class="form-group">
            <label for="ClassName">Class Name</label>
            <input type="text" class="form-control" id="ClassName" placeholder="Enter Class Name">
          </div> --}}
          {{-- <div class="form-group">
            <label for="exampleInputEmail1">Number of Students</label>
            <input type="number" class="form-control" id="exampleInputEmail1" max="30" placeholder="Enter Class Number">
          </div> --}}
          <div class="form-group">
            <label for="Students_Age">Age of Students</label>
            <div class="d-flex">
              <div class="col-lg-4">
                <span class="text-bold">From</span>
                <input type="number" class="form-control" id="Students_Age" placeholder="Enter Tution Fee" name="from_age" required>
              </div>
              <div class="col-lg-4">
                <span class="text-bold">To</span>
                <input type="number" class="form-control" id="Students_Age" placeholder="Enter Tution Fee" name="to_age" required>
              </div>
            </div>
          </div>
          <div class="form-group">
            <label for="Total_Seats">Total Seats</label>
            <input type="number" class="form-control" id="Total_Seats" placeholder="Seats Number" name="total_seats" required>
          </div>
          <div class="form-group">
            <label for="Tution_Fee">Tution Fee</label>
            <input type="number" class="form-control" id="Tution_Fee" placeholder="Enter Tution Fee" name="tution_fee" required>
          </div>
          <div class="form-group">
            <label for="Class_Time">Class Times</label>
            <div class="d-flex">
              <div class="col-lg-4">
                <span class="text-bold">From</span>
                <input type="time" class="form-control" id="Class_Time" placeholder="Enter Tution Fee" name="from_time" required>
              </div>
              <div class="col-lg-4">
                <span class="text-bold">To</span>
                <input type="time" class="form-control" id="Class_Time" placeholder="Enter Tution Fee" name="to" required>
              </div>
            </div>
          </div>
          {{-- <div class="form-group">
            <label>Class Typle</label>
            <select class="custom-select">
              <option>option 1</option>
              <option>option 2</option>
              <option>option 3</option>
              <option>option 4</option>
              <option>option 5</option>
            </select>
          </div> --}}
          {{-- <div class="form-group">
            <label>Main Teacher</label>
            <select class="custom-select">
              <option>Teacher 1</option>
              <option>Teacher 2</option>
              <option>Teacher 3</option>
              <option>Teacher 4</option>
              <option>Teacher 5</option>
            </select>
          </div> --}}
          {{-- <div class="form-group">
            <label for="exampleInputFile">File input</label>
            <div class="input-group">
              <div class="custom-file">
                <input type="file" class="custom-file-input" id="exampleInputFile">
                <label class="custom-file-label" for="exampleInputFile">Choose file</label>
              </div>
              <div class="input-group-append">
                <span class="input-group-text">Upload</span>
              </div>
            </div>
          </div> --}}
          <div class="form-group">
            <label>Description</label>
            <textarea class="form-control" id="Description" rows="3" placeholder="" name="description" required></textarea>
          </div>
        </div>
        <!-- /.card-body -->
        {{-- <div class="card-footer">
          <button type="submit" class="btn btn-primary">Submit</button>
        </div> --}}
      </form>
      
    </div>
  </div>
  <div class="col-lg-6">
    <div class="card">
      <div class="card-header d-flex p-0">
        <h3 class="card-title p-3">Students</h3>
        <ul class="nav nav-pills ml-auto p-2">
          {{-- <li class="nav-item"><a class="nav-link active" href="#tab_1" data-toggle="tab">Class Student</a></li> --}}
          <li class="nav-item"><a class="nav-link" href="#tab_2" data-toggle="tab">Show All Students</a></li>
          {{-- <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#">
              Dropdown <span class="caret"></span>
            </a>
            <div class="dropdown-menu">
              <a class="dropdown-item" tabindex="-1" href="#">Action</a>
              <a class="dropdown-item" tabindex="-1" href="#">Another action</a>
              <a class="dropdown-item" tabindex="-1" href="#">Something else here</a>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item" tabindex="-1" href="#">Separated link</a>
            </div>
          </li> --}}
        </ul>
      </div>
      <!-- /.card-header -->
        <div class="card-body">
          <div class="tab-content">
            {{-- <div class="tab-pane active" id="tab_1"> --}}
              {{-- <form action="">
                @foreach ($students as $student)
                  <div class="callout callout-success">
                    <div class="row">
                      <div class="col-lg-6">
                        <h5>{{$student->first_name . ' ' . $student->last_name}}</h5>
                        <p>Status : <span>No Class</span></p>
                      </div>
                      <div class="col-lg-3">
                        <div class="custom-control custom-switch">
                          <input type="checkbox" class="custom-control-input" id="customSwitch{{$student->id}}">
                          <label class="custom-control-label" for="customSwitch{{$student->id}}">Add</label>
                        </div>
                        <button type="button" class="btn btn-block btn-outline-success btn-flat text-bold" disabled>Add</button>
                      </div>
                      <div class="col-lg-3">
                        <button type="button" class="btn btn-block btn-outline-danger btn-flat text-bold">Drop</button>
                      </div>
                    </div>
                  </div>
                @endforeach
              </form> --}}
            {{-- </div> --}}
            <!-- /.tab-pane -->
            <div class="tab-pane" id="tab_2">
              <div class="card card-primary card-outline card-outline-tabs">
                <div class="card-header p-0 border-bottom-0">
                  {{-- <ul class="nav nav-tabs" id="custom-tabs-four-tab" role="tablist">
                    <li class="nav-item">
                      <a class="nav-link active" id="custom-tabs-four-home-tab" data-toggle="pill" href="#custom-tabs-four-home" role="tab" aria-controls="custom-tabs-four-home" aria-selected="true">3 - 5</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" id="custom-tabs-four-profile-tab" data-toggle="pill" href="#custom-tabs-four-profile" role="tab" aria-controls="custom-tabs-four-profile" aria-selected="false">5 - 7</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" id="custom-tabs-four-messages-tab" data-toggle="pill" href="#custom-tabs-four-messages" role="tab" aria-controls="custom-tabs-four-messages" aria-selected="false">7 - 9</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" id="custom-tabs-four-settings-tab" data-toggle="pill" href="#custom-tabs-four-settings" role="tab" aria-controls="custom-tabs-four-settings" aria-selected="false">9 - 5</a>
                    </li>
                  </ul> --}}
                </div>
                <div class="card-body">
                  <div class="tab-content" id="custom-tabs-four-tabContent">
                    <div class="tab-pane fade active show" id="custom-tabs-four-home" role="tabpanel" aria-labelledby="custom-tabs-four-home-tab">
                      <form action="{{route('class.store')}}" id="studentForm" method="POST" enctype="multipart/form-data">
                        @csrf
                        @foreach ($students as $student)
                          <div class="callout callout-success">
                            <div class="row">
                              <div class="col-lg-6">
                                <h5>{{$student->first_name . ' ' . $student->last_name}}</h5>
                                <p>Student No : <span>{{$student->student_forign_id}}</span></p>
                              </div>
                              <div class="col-lg-3">
                                <p>Age : <span>{{$student->age}} Year</span></p>

                                {{-- <button type="button" class="btn btn-block btn-outline-success btn-flat text-bold" disabled>Add</button> --}}
                              </div>
                              <div class="col-lg-3">
                                {{-- <button type="button" class="btn btn-block btn-outline-danger btn-flat text-bold">Drop</button> --}}
                                <div class="custom-control custom-switch custom-switch-off-danger custom-switch-on-success">
                                  <input type="checkbox" name="Check[]" value="{{$student->id}}" class="custom-control-input" id="customSwitch{{$student->id}}">
                                  <label class="custom-control-label" for="customSwitch{{$student->id}}">Add</label>
                                </div>
                              </div>
                            </div>
                          </div>
                        @endforeach
                      </form>
                    </div>
                    <div class="tab-pane fade" id="custom-tabs-four-profile" role="tabpanel" aria-labelledby="custom-tabs-four-profile-tab">
                      
                    </div>
                    <div class="tab-pane fade" id="custom-tabs-four-messages" role="tabpanel" aria-labelledby="custom-tabs-four-messages-tab">

                    </div>
                    <div class="tab-pane fade" id="custom-tabs-four-settings" role="tabpanel" aria-labelledby="custom-tabs-four-settings-tab">

                    </div>
                  </div>
                </div>
                <!-- /.card -->
              </div>
            </div>
            <!-- /.tab-pane -->
            <div class="tab-pane" id="tab_3">
              
            </div>
            <!-- /.tab-pane -->
          </div>
          <!-- /.tab-content -->
        </div>
      <!-- /.card-body -->
      
    </div>
    
  </div>
  <button type="submit" onclick="submitForms()" class="btn btn-block btn-outline-success btn-lg text-bold mt-2 mx-5">Add Every Thing</button>
</div>
@endsection

@section('js')
    <script>

      function submitForms() {

        let formData1 = new FormData(document.getElementById("infoForm"));
        let formData2 = new FormData(document.getElementById("studentForm"));

        // Test 
        // formData1.forEach((value, key) => {
        //   console.log(key, value);
        // });

        let mergedData = {};
        formData1.forEach((value, key) => mergedData[key] = value);
        // formData2.forEach((value, key) => mergedData[key] = value);

        formData2.forEach((value, key) => {
        if (key.endsWith("[]")) {
            key = key.replace("[]", "");
            if (!mergedData[key]) {
                mergedData[key] = [];
            }
            mergedData[key].push(value);
        } else {
            mergedData[key] = value;
        }
    });

        // console.log(mergedData);
        fetch("{{ route('class.store') }}", {
          method : "POST",
          headers : { 
            "Content-Type" :"application/json",
            "X-CSRF-TOKEN": '{{ csrf_token() }}'
            },
          
          body : JSON.stringify(mergedData)
        })
        .then(response => response.json())
        .then(data => {
          console.log(data);
          window.location.href = "{{route('class.index')}}";
        })
        .catch(error => console.log(error))
      } 
    </script>
@endsection