@extends('layouts.dashboard')
@section('page-title', 'All Classes')

@section('content')
<div class="container-fluid">
  <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-header">
          <h3>Classes</h3>
          </div>
          <div class="card-body">
            <table id="Class-table" class="table">
              <thead>
                <th>ID</th>
                <th>Class Content Name</th>
                <th>Class Number</th>
                <th>From Age</th>
                <th>To Age</th>
                <th>Total Seats</th>
                <th>Student Count</th>
                <th>Actions</th>
                {{-- <th>Actions</th> --}}
              </thead>
              <tbody>
                  @foreach ($classes as $class)
                  <tr>
                    {{-- @dd($teacher->teachingContents->subject_1) --}}
                    <td>{{$class->id}}</td>
                    <td>{{$class->class_content_name}}</td>
                    <td>{{$class->class_number}}</td>
                    <td>{{$class->from_age}}</td>
                    <td>{{$class->to_age}}</td>
                    <td>{{$class->total_seats}}</td>
                    <td>{{$class->students->count()}}</td>
                    <td>
                      {{-- <a class="btn btn-primary" href="{{route('class.edit', $class->id)}}">Edit</a> --}} {{--There is a problem here does not access the class in controller--}}

                      <form action="{{route('class.edit', $class->id)}}" method="GET" style="display: inline-block">
                          @csrf
                          <input type="hidden" name="class_id" value="{{$class->id}}">
                            <button type="submit" class="btn btn-primary" >Edit</button>
                      </form>

                      <form action="{{route('class.destroy', $class->id)}}" method="post" style="display: inline-block">
                        @csrf
                        @method('DELETE')
                        <input type="hidden" name="class_id" value="{{$class->id}}">
                        <button type="submit" class="btn btn-danger">Delete</button>
                      </form>

                      <form action="{{route('class.show', $class->id)}}" method="get" style="display: inline-block">
                        <input type="hidden" name="class" value="{{$class->id}}">
                        <button class="btn btn-info" type="submit">Show</button>
                      </form>

                      {{-- <a href="{{route('class.show', $class)}}" class="btn btn-info">Show</a> --}}
                    </td>
                  </tr>
                  @endforeach
                </tbody>
              <tfoot>
                <th>ID</th>
                <th>Class Content Name</th>
                <th>Class Number</th>
                <th>From Age</th>
                <th>To Age</th>
                <th>Total Seats</th>
                <th>Student Count</th>
                <th>Actions</th>
              </tfoot>
          </table>
        </div>
      </div>
    </div>
  </div> 
</div>
@endsection

@section('js')
    <script>
      $(document).ready(function () {
        $('#Class-table').dataTable();
      })
    </script>
@endsection