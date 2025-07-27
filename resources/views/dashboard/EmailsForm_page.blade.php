@extends('layouts.dashboard');

@section('page-title', 'Send-Email')

@section('css')

@endsection

@section('content')
  <div class="container">
    <form method="POST" action="{{route('admin.send.mail')}}" enctype="multipart/form-data">
    @csrf
    
    <div class="mb-3">
        <label for="subject" class="form-label">Subject</label>
        <input type="text" name="subject" id="subject" class="form-control" placeholder="Email Subject" required>
    </div>
    
    <div class="mb-3">
        <label for="message" class="form-label">Message</label>
        <textarea name="message" id="message" class="form-control" rows="5" placeholder="Your message here..." required></textarea>
    </div>
    
    <div class="mb-3">
        <label for="attachment" class="form-label">Attachments (optional)</label>
        <input type="file" name="attachment" id="attachment" class="form-control">
        <div class="form-text">Max 5MB per file</div>
    </div>
    
    <div class="d-flex justify-content-between align-items-center">
        <div id="file-list" class="small text-muted">No files selected</div>
        <button type="submit" class="btn btn-primary">Send to All Users</button>
    </div>
</form>
  </div>
@endsection

@section('js')
  <script>
    // Show selected file names
    // document.getElementById('attachments').addEventListener('change', function(e) {
    //     const files = e.target.files;
    //     const fileList = document.getElementById('file-list');
        
    //     if (files.length === 0) {
    //         fileList.textContent = 'No files selected';
    //         return;
    //     }
        
    //     let fileNames = [];
    //     for (let i = 0; i < files.length; i++) {
    //         fileNames.push(files[i].name);
    //     }
        
    //     fileList.textContent = `${files.length} file(s) selected: ${fileNames.join(', ')}`;
    // });
</script>
@endsection