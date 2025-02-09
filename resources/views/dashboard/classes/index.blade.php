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
                          {{-- <td> --}}
                      {{-- <a href="{{route('categories.edit', $category->id )}}" class="btn btn-primary">Edit</a>
                      <form action="{{route('categories.destroy', $category->id)}}" method="POST" style="display: inline-block">
                          @csrf
                          @method('DELETE')
                          <button type="submit" class="btn btn-danger">Delete</button>
                      </form>
                      <form action="{{route('category.status.update', $category->id )}}" class="d-inline" method="POST">
                          @method('PUT')
                          @csrf
                          <button type="submit" class="btn btn-primary">Change to {{$category->category_status  == 'disabled' ? 'active' : 'Disabild' }}</button>
                      </form>
                      </td> --}}
                  </tr>
                  @endforeach
              </tbody>
              <tfoot>
                  <th>ID</th>
                  <th>Name</th>
                  <th>Subject</th>
                  <th>Subject</th>
                  <th>Subject</th>
                  {{-- <th>Actions</th> --}}
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