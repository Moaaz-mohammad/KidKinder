    <div class="col-lg-6">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Class</h3>
            </div>
            <form action="{{$action}}" id="infoForm" method="POST">
                @csrf
                @if ($method == 'PUT')
                    @method('PUT')
                @endif
                <div class="card-body">
                <div class="form-group">
                    <label for="ClassContentName">Class <span class="text-danger">Content</span> Name</label>
                    <input type="text" class="form-control" id="ClassContentName" placeholder="Class Content Name" name="class_content_name" required value="{{old('class_content_name', $class->class_content_name ?? '')}}">
                </div>
                <div class="form-group">
                    <label for="ClassNumber">Number Of Class</label>
                    <input type="number" class="form-control" id="ClassNumber" placeholder="Enter Class Number" name="class_number" required value="{{old('class_number', $class->class_number ?? '')}}">
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
                        <input type="number" class="form-control" id="Students_Age" placeholder="Enter Tution Fee" name="from_age" value="{{old('from_age', $class->from_age ?? '')}}">
                    </div>
                    <div class="col-lg-4">
                        <span class="text-bold">To</span>
                        <input type="number" class="form-control" id="Students_Age" placeholder="Enter Tution Fee" name="to_age" value="{{old('to_age', $class->to_age ?? '')}}">
                    </div>
                    </div>
                </div>
                @if ($method != 'PUT')
                    <div class="form-group">
                        <label for="Total_Seats">Total Seats</label>
                        <input type="number" class="form-control" id="Total_Seats" placeholder="Seats Number" name="total_seats" value="{{old('total_seats', $class->total_seats ?? '')}}">
                    </div>
                @endif
                <div class="form-group">
                    <label for="Tution_Fee">Tution Fee</label>
                    <input type="number" class="form-control" id="Tution_Fee" placeholder="Enter Tution Fee" name="tution_fee" value="{{old('tution_fee', $class->tution_fee ?? '')}}">
                </div>
                <div class="form-group">
                    <label for="Class_Time">Class Times</label>
                    <div class="d-flex">
                    <div class="col-lg-4">
                        <span class="text-bold">From</span>
                        <input type="time" class="form-control" id="Class_Time" placeholder="Enter Tution Fee" name="from_time" value="{{old('from_time', $class->from_time ?? '')}}">
                    </div>
                    <div class="col-lg-4">
                        <span class="text-bold">To</span>
                        <input type="time" class="form-control" id="Class_Time" placeholder="Enter Tution Fee" name="to" value="{{old('to', $class->to ?? '')}}">
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
                <div class="form-group">
                    <label>Main Teacher</label>
                    <select name="teacher_id" class="custom-select">
                        <option>Select Teacher</option>
                        @foreach ($teachers as $teacher)
                            <option value="{{$teacher->id}}" {{ $method == 'PUT' && in_array($teacher->id, $selectedTeacher) ? 'selected' : '' }}>{{$teacher->name}}</option>
                        @endforeach
                    </select>
                </div>
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
                    <textarea class="form-control" id="Description" rows="3" placeholder="" name="description">{{old('description', $class->description ?? '')}}</textarea>
                </div>
                </div>


                {{$slot}}


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
            </div>
            <div class="card-body">
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#staticBackdrop">
                    List of Students
                </button>
            </div>
        </div>
    </div>
    {{-- <button type="submit" onclick="submitForms()" class="btn btn-block btn-outline-success btn-lg text-bold mt-2 mx-5">Add Everything</button> --}}
