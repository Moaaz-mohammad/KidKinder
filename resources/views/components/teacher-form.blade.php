<form action="{{ $action }}" enctype="multipart/form-data" method="POST" class="card-body">
    {{-- <input type="hidden" name="_token" value="eigbcIVZkXKmkIC6DGMOCDvOWo7pdm7cNI5kR3AM" autocomplete="off"> --}}
    @csrf
    {{-- @if ($method != '') --}}
    {{-- @endif --}}
    @if ($method == 'PUT')
        @method('PUT')
    @endif

        <div class="form-group">
            <label for="teacherName">Teacher Name</label>
            <input type="text" class="form-control" id="teacherName" value="{{old('name', $teacher->name ?? '')}}" placeholder="Enter teacher name" name="name" required>
        </div>
        <div class="form-group">
            <label for="teacherEmail">Teacher Email</label>
            <input type="email" class="form-control" id="teacherEmail" value="{{old('email', $teacher->email ?? '')}}" placeholder="Enter teacher name" name="email" required>
        </div>
        <div class="form-group">
            <div class="custom-file">
                <input type="file" class="custom-file-input" id="TeacherPhoto" name="TeacherPhoto" @if ($method != 'PUT') required @endif>
                <label class="custom-file-label" for="TeacherPhoto">{{$method != "PUT" ? 'Choose Photo' : 'Choose New Photo'}}</label>
            </div>
        </div>
        <div class="form-group">
            <label for="teachingContent">Teaching content</label>
            
            <div class="card-body">
                <div class="row">
                    @for ($i = 1; $i <= 3; $i++)
                        <div class="col-4">
                            <input type="text" name="subject_{{$i}}" class="form-control" placeholder="Content" required=""
                            value="{{ old('subject_'.$i, optional($teacher?->teachingContents->first())->{'subject_'.$i} ?? '') }}"
                            >
                        </div>
                    @endfor
                </div>
            </div>
        </div>
        <div class="form-group">
            {{-- New Code After Edit the Old One --}}
            <label for="ClassContentName">Social media</label>
            @foreach (['Insagram', 'Facebook', 'X'] as $index => $platform)
                <input type="url" class="form-control mb-1" name="url_{{$index + 1}}" placeholder="{{$platform}}" value="{{old('url_'.($index + 1), $teacher->{'url_'.($index + 1)} ?? '')}}">
            @endforeach

            {{-- Old Code  --}}
            {{-- <input type="url" class="form-control mb-1" name="url_1" placeholder="Instagram">
            <input type="url" class="form-control mb-1" name="url_2" placeholder="Facebook">
            <input type="url" class="form-control" name="url_3" placeholder="X"> --}}
        </div>
        
        
        <div class="form-group">
            <label for="Description">Description</label>
            <textarea class="form-control" name="description" id="Description" rows="3" placeholder="">{{old('description', $teacher->description ?? '')}}</textarea>
        </div>


        {{$slot}}

        <!-- /.card-body -->
        <div class="card-footer ">
        <button type="submit" class="btn btn-primary">{{ $buttonText }}</button>
        </div>
</form>
