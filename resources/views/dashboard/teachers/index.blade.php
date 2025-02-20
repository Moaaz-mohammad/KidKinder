@extends('layouts.dashboard')
@section('page-title', 'Teachers')

@section('content')
    {{-- @include('alert') --}}
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h3>Teachers</h3>
                    </div>
                    <div class="card-body text-center">
                        <table id="categories-table" class="table">
                            <thead>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Subject</th>
                                <th>Subject</th>
                                <th>Subject</th>
                                <th>Actions</th>
                                {{-- <th>Actions</th> --}}
                            </thead>
                            <tbody>
                                @foreach ($teachers as $teacher)
                                <tr>
                                    <td>{{$teacher->id}}</td>
                                    <td>{{$teacher->name}}</td>
                                        @for ($i = 1; $i <=3 ; $i++)
                                            <td>{{ $teacher->teachingContents->first()->{'subject_'.$i} ?? 'No Subject' }}</td>
                                        @endfor
                                    <td>
                                    <a href="{{route('teacher.edit', $teacher->id )}}" class="btn btn-primary">Edit</a>
                                        <form action="{{route('teacher.destroy', $teacher->id)}}" method="post" class="d-inline-block mx-2">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-danger" type="submit">DELETE</button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Subject</th>
                                <th>Subject</th>
                                <th>Subject</th>
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
        $('#categories-table').dataTable();
    })
    </script>
@endsection