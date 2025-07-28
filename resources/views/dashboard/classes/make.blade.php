@extends('layouts.dashboard')

@section('page-title', 'Create')

@section('content')
  <div class="row">
    <x-class-form :action="route('class.store')" :teachers="$teachers" :students="$students">

    </x-class-form>
    <div id="errorMessages" class="alert alert-danger d-none"></div>
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
          <form action="{{route('class.store')}}" id="studentForm" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">
              @foreach ($students as $student)
                <div class="col-lg-4 col-md-6 col-sm-12 mb-4">
                  <div class="callout callout-success">
                    <div class="row">
                      <div class="col-lg-6">
                        <h5>{{$student->first_name . ' ' . $student->last_name}}</h5>
                        <p>Student No :<span>{{$student->student_forign_id}}</span></p>
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
                </div>
              @endforeach
            </div>
          </form>
        </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
    <button type="submit" onclick="submitForms()" class="btn btn-block btn-outline-primary btn-lg text-bold mt-2">Submit</button>
  </div>
@endsection


@section('js')

    <script>

      function submitForms() {

        let formData1 = new FormData(document.getElementById("infoForm"));
        let formData2 = new FormData(document.getElementById("studentForm"));

        // Test 
        formData1.forEach((value, key) => {
          console.log(key, value);
        });

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

        console.log(mergedData);
        fetch("{{ route('class.store') }}", {
          method : "POST",
          headers : { 
            "Content-Type" :"application/json",
            "X-CSRF-TOKEN": '{{ csrf_token() }}'
            },
          
          body : JSON.stringify(mergedData)
        })
        .then(response => {
          if (!response.ok) {
            return response.json().then(data => {
              displayValidationErrors(data.errors)
            });
          }else {
            return response.json().then(data => {
            localStorage.setItem('success', data.message)
            window.location.href = "{{route('class.index')}}";
          })
          }
        })
        .then(data => {
          return response.json().then(data => {
            localStorage.setItem('success', data.message)
            window.location.href = "{{route('class.index')}}";
          })
        })
        .catch(error => {
          console.log('error', error)
        })
      } 
  
      function displayValidationErrors(errors) {
        const errorDiv = document.getElementById('errorMessages');
        errorDiv.innerHTML = '';
        errorDiv.classList.remove('d-none');

        for (const key in errors) {
          if(errors.hasOwnProperty(key)){
            const messages = errors[key];
            messages.forEach(msg => {
              errorDiv.innerHTML += `<p>${msg}</p>`;
            });
          }
        }
      }
    </script>

@endsection