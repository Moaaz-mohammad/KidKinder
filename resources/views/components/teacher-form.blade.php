<form action="{{ $action }}" enctype="multipart/form-data" method="POST" class="card-body">
    <input type="hidden" name="_token" value="eigbcIVZkXKmkIC6DGMOCDvOWo7pdm7cNI5kR3AM" autocomplete="off">            
    <div class="form-group">
        <label for="teacherName">Teacher Name</label>
        <input type="text" class="form-control" id="teacherName" placeholder="Enter teacher name" name="name" required="">
    </div>
    <div class="form-group">
        <div class="custom-file">
            <input type="file" class="custom-file-input" id="TeacherPhoto" name="TeacherPhoto" required="">
            <label class="custom-file-label" for="TeacherPhoto">Choose Photo</label>
        </div>
    </div>
    <div class="form-group">
        <label for="teachingContent">Teaching content</label>
        
        <div class="card-body">
        <div class="row">
            <div class="col-4">
            <input type="text" name="subject_1" class="form-control" placeholder="Content" required="">
            </div>
            <div class="col-4">
            <input type="text" name="subject_2" class="form-control" placeholder="Content">
            </div>
            <div class="col-4">
            <input type="text" name="subject_3" class="form-control" placeholder="Content">
            </div>
        </div>
        </div>
    </div>
    <div class="form-group">
        <label for="ClassContentName">Social media</label>
        <input type="url" class="form-control mb-1" name="url_1" placeholder="Instagram">
        <input type="url" class="form-control mb-1" name="url_2" placeholder="Facebook">
        <input type="url" class="form-control" name="url_3" placeholder="X">
    </div>
    
    
    <div class="form-group">
        <label for="Description">Description</label>
        <textarea class="form-control" name="description" id="Description" rows="3" placeholder=""></textarea>
    </div>


    {{$slot}}

    <!-- /.card-body -->
    <div class="card-footer ">
    <button type="submit" class="btn btn-primary">{{ $buttonText }}</button>
    </div>
</form>
