    <form action="{{$action}}" enctype="multipart/form-data" method="POST" class="card-body">
        @csrf

        @if ($method == 'PUT')
            @method('PUT')
        @endif
        {{-- <input type="hidden" name="_token" value="JgHpILrtp5tJtg5W7GtyPKPPNW5lf0UHZwjOispz" autocomplete="off"><div class="card-body"> --}}
        <div class="form-group">
            <label for="StudentFirstName">First Name</label>
            <input type="text" class="form-control" id="StudentFirstName" placeholder="Enter student first name" value="{{old('first_name', $student->first_name ?? '')}}" name="first_name" required>
        </div>
        <div class="form-group">
            <label for="StudenLastName">Last Name</label>
            <input type="text" class="form-control" id="StudenLastName" placeholder="Enter student last name" name="last_name" value="{{old('last_name', $student->last_name ?? '')}}" required>
        </div>
        <div class="form-group">
            <label for="StudentID">ID Number</label>
            <input type="text" class="form-control" id="StudentID" placeholder="Enter ID" name="student_forign_id" value="{{old('student_forign_id', $student->student_forign_id ?? '')}}" required>
        </div>
        <div class="form-group">
            <label for="StudentID">Student Age</label>
            <input type="number" class="form-control" id="StudentID" placeholder="Enter age of student" name="age" value="{{old('age', $student->age ?? '')}}" required>
        </div>
        <div class="form-group">
            <label for="Description">Description</label>
            <textarea class="form-control" name="description" id="Description" rows="3" placeholder="">{{old('description', $student->description ?? '')}}</textarea>
        </div>

        <div class="form-group">
            <div class="custom-file">
                <input type="text">
                <input type="file" name="image" class="" id="image" @if ($method != 'PUT') required @endif >
                <label class="custom-file-label" for="image">{{$method == 'PUT' ? 'Chose New Photo' : 'Choose Photo'}}</label>
            </div>
        </div>


            {{$slot}}

        
        <!-- /.card-body -->
        <div class="card-footer ">
        <button type="submit" class="btn btn-{{$method == 'PUT' ? 'info' : 'success'}}">{{$method == 'PUT' ? 'Edit' : 'Submit'}}</button>
        </div>
    </form>