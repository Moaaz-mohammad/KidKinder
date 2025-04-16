@extends('layouts.dashboard')

@section('page-title', 'Students')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h3>All Students</h3>
                </div>
                <div class="card-body">
                    <table id="categories-table" class="table">
                        <thead>
                            <th>ID</th>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>The Age</th>
                            <th>Action</th>
                        </thead>
                        <tbody>
                            @if (count($students) > 0)
                                @foreach ($students as $student)
                                    <tr>
                                        <td>{{$student->id}}</td>
                                        <td>{{$student->first_name}}</td>
                                        <td>{{$student->last_name}}</td>
                                        <td>{{$student->age}}</td>
                                        <td>
                                            <a href="{{route('student.edit', $student->id )}}" class="btn btn-primary">Edit</a>
                                            <form action="{{route('student.destroy', $student->id)}}" method="POST" style="display: inline-block">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger mx-2">Delete</button>
                                            </form>
                                            <a href="{{route('student.show', $student->id)}}" class="btn btn-info">Show {{$student->first_name}} Details</a>
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                        </tbody>
                        <tfoot>
                            <th>ID</th>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>The Age</th>
                            <th>Action</th>
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
            $('#categories-table').dataTable();
        })

        setTimeout(function() {
            $(".alert").fadeOut("slow");
        }, 3000); // 3 seconds
    </script>
@endsection