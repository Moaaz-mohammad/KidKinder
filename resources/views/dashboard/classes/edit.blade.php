@extends('layouts.dashboard')
@section('page-title', 'Class')

@section('content')
<div class="row">
    <x-class-form :students="$students" :class="$class" :method="'PUT'" :action="route('class.update', $class->id)">
      
      <input type="hidden" name="classId" value="{{$class->id}}">
    </x-class-form>
    <div id="errorMessages" class="alert alert-danger d-none"></div>

    <span id="classId" value="{{$class->id}}"></span>
    <!-- Modal -->
    <div class="modal fade" id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
      <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="staticBackdropLabel">All Students</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <form action="{{route('class.update', $class->id)}}" id="studentForm" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="row">
                  @if (count($students) > 0)
                    @foreach ($students as $student)
                      <div class="col-lg-4 col-md-6 col-sm-12 mb-4">  <!-- 3 columns on large screens, 2 on medium, and 1 on small screens -->
                        <div class="callout callout-success">
                          <div class="row">
                            <div class="col-6">
                              <h5>{{ $student->first_name . ' ' . $student->last_name }}</h5>
                              <p>Student No: <span>{{ $student->student_forign_id }}</span></p>
                            </div>
                            <div class="col-3">
                              <p>Age: <span>{{ $student->age }} Year</span></p>
                            </div>
                            <div class="col-3">
                              <div class="custom-control custom-switch custom-switch-off-danger custom-switch-on-success">
                                  <input type="checkbox" name="Check[]" value="{{ $student->id }}" class="custom-control-input" id="customSwitch{{ $student->id }}" 
                                        @if(in_array($student->id, $classStudents)) checked @endif>
                                  <label class="custom-control-label" for="customSwitch{{ $student->id }}">Add</label>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    @endforeach
                  @endif
                </div>
              </form>
            </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div>
    <button type="submit" onclick="submitForms()" class="btn btn-block btn-outline-success btn-lg text-bold mt-2 mx-5">Edit</button>
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

        let classId = document.getElementById('classId').value;

        let updateUrl = `{{ route('class.update', ':id') }}`.replace(':id', classId);

        console.log(mergedData);
        fetch(updateUrl, {
            method : "PUT",
            headers : { 
            "Content-Type" :"application/json",
            "X-CSRF-TOKEN": '{{ csrf_token() }}'
            },
            body : JSON.stringify(mergedData)
        })
        .then(response => {
            if (!response.ok) {
              return response.json().then(data => {
                if (data.errors) {
                  displayValidationErrors(data.errors); 
                }
              });
            }else {
              return response.json().then(data => {
                localStorage.setItem('success', data.message);
                window.location.href = "{{route('class.index')}}";
              });
            }
          return response.json();
        })
        .then(data => {
          // console.log("Message", data.message);
            // window.location.href = "{{route('class.index')}}";
        })
        .catch(error => {
          console.error('error', error)
    });
}

function displayValidationErrors(errors) {
    const errorDiv = document.getElementById('errorMessages');
    errorDiv.innerHTML = '';
    errorDiv.classList.remove('d-none');
  
    for (const key in errors) {
        if (errors.hasOwnProperty(key)) {
          const messages = errors[key];
          messages.forEach(msg => {
            errorDiv.innerHTML += `<p>${msg}</p>`;
          });
        }
    }
}

</script>
@endsection