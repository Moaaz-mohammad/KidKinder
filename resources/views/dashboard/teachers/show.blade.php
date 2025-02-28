@extends('layouts.dashboard')

@section('page-title', $teacher->name)

@section('content')
    <div class="row">
      <div class="col-lg-4">
        <div class="card" style="width: 30rem;">
          <div class="card-body">
            <h5 class="card-title text-primary" style="font-size: 2rem;">Student Details: </h5>
            {{-- <h6 class="card-subtitle mb-2 text-body-secondary">Card subtitle</h6>
            <p class="card-text"></p> --}}
          </div>
          <ul class="list-group list-group-flush" >
            <li class="list-group-item font-weight-bolder"><span class="font-weight-bold">Name: </span>{{$teacher->name}}</li>
            {{-- <li class="list-group-item font-weight-bolder"><span class="font-weight-bold">Last Name: </span>{{$student->last_name}}</li>
            <li class="list-group-item font-weight-bolder"><span class="font-weight-bold">Student ID: </span>{{$student->student_forign_id}}</li> --}}
          </ul>
          <div class="card-footer">
            <p class="text-center font-weight-bold">Teaching Content</p>
            <table class="table">
              <thead>
                <tr>
                  <th scope="col">NO:</th>
                  <th scope="col">Subjects:</th>
                </tr>
              </thead>
              <tbody class="table-group-divider">
                @for ($i = 1; $i <= 3; $i++)
                  <tr>
                    <th scope="row">{{$i}} =></th>
                    <td>{{ optional($teacher->teachingContents->first())->{'subject_'.$i} ?? 'N/A'}}</td>
                  </tr>
                @endfor
                {{-- @foreach ($student->classses as $class)
                  <tr>
                    <th scope="row">{{$class->id}}</th>
                    <td>{{$class->class_content_name}}</td>
                    <td>{{$class->from_time . '-' . $class->to}}</td>
                    <td>$ {{$class->tution_fee}}</td>
                  </tr>
                @endforeach --}}
              </tbody>
            </table>
          </div>
        </div>
      </div>
      <div class="col-lg-4">
        <div class="card" style="width: 24rem;">
          @if ($teacher->images()->exists())
            <img src="{{asset('storage/images/' . $teacher->images->first()->file_name)}}" class="card-img-top" alt="...">
          @else
          <img src="{{asset('dashboard/dist/img/NoPhoto.jpg')}}" class="card-img-top" alt="...">
          @endif
          <div class="card-body">
            <p class="card-text">{{$teacher->description}}</p>
          </div>
        </div>
      </div>
    </div>
@endsection