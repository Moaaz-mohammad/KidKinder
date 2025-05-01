@extends('layouts.dashboard')

@section('page-title', 'Profile')

@section('content')
<div class="row">
  <div class="col-lg-3 col-md-6">
    @php
      $image = $user->images()->first();
    @endphp
    <!-- Profile Image -->
    <div class="card card-primary card-outline">
      <div class="card-body box-profile">
        <div class="text-center">
        @if (!$image)
          <img src="{{asset('dashboard/dist/img/NoPhoto.jpg')}}" class="card-img-top" alt="Photo">
        @else
          <img src="{{asset($image->file_path)}}" class="img-thumbnail"  style="width: 200px; height: 200px;  object-fit: cover;" alt="Photo">
        @endif
        </div>
  
        <h3 class="profile-username text-center ">{{$user->name}}</h3>
  
        <p class="text-muted text-center">{{$user->email}}</p>
  
        <ul class="list-group list-group-unbordered mb-3">
          <li class="list-group-item">
            <b>Joined Date</b> <a class="float-right">{{$user->created_at->format('Y/m/d')}}</a>
          </li>
        </ul>
  
        {{-- <a href="#" class="btn btn-primary btn-block"><b>Edit</b></a> --}}
        <!-- Button trigger modal -->
        <button type="button" class="btn btn-primary btn-block" data-toggle="modal" data-target="#ProfileModal">
          Edit
        </button>
        <button type="button" class="btn btn-primary btn-block" data-toggle="modal" data-target="#PasswordModal">
          Change Your Password
        </button>
        @if ($image)
          <button onclick="removePhoto({{$user->id}})" name="userId" id="RemovePhoto" class="btn btn-danger mt-4 w-100">Remove Photo</button>
        @endif
      </div>
      <!-- /.card-body -->
    </div>
    <!-- /.card -->
  
    <!-- About Me Box -->
    {{-- <div class="card card-primary">
      <div class="card-header">
        <h3 class="card-title">About Me</h3>
      </div>
      <!-- /.card-header -->
      <div class="card-body">
        <strong><i class="fas fa-book mr-1"></i> Education</strong>
  
        <p class="text-muted">
          B.S. in Computer Science from the University of Tennessee at Knoxville
        </p>
  
        <hr>
  
        <strong><i class="fas fa-map-marker-alt mr-1"></i> Location</strong>
  
        <p class="text-muted">Malibu, California</p>
  
        <hr>
  
        <strong><i class="fas fa-pencil-alt mr-1"></i> Skills</strong>
  
        <p class="text-muted">
          <span class="tag tag-danger">UI Design</span>
          <span class="tag tag-success">Coding</span>
          <span class="tag tag-info">Javascript</span>
          <span class="tag tag-warning">PHP</span>
          <span class="tag tag-primary">Node.js</span>
        </p>
  
        <hr>
  
        <strong><i class="far fa-file-alt mr-1"></i> Notes</strong>
  
        <p class="text-muted">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam fermentum enim neque.</p>
      </div>
      <!-- /.card-body -->
    </div> --}}
    <!-- /.card -->
  </div>
</div>
{{-- Profile Modal --}}
<div class="modal fade" id="ProfileModal" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="ProfileModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="ProfileModalLabel">Profile</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
        <div class="modal-body">
        <form action="{{route('user.edit', $user->id)}}" method="post" enctype="multipart/form-data">
            @csrf
            @method('PUT')
          <div class="row">
            <div class="col-lg-6">
              <input type="hidden" name="userId" value="{{Auth::user() ? Auth::user()->id : ""}}">
              <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input class="form-control" id="name" name="userName" type="text" value="{{old('name', $user->name ?? '')}}" placeholder="Enter your new name">
              </div>
              <div class="mb-3">
                <label for="EmailAddress" class="form-label">Email address</label>
                <input type="email" class="form-control" name="userEmail" id="EmailAddress" value="{{old('email', $user->email ?? '')}}" placeholder="name@example.com">
              </div>
            </div>
            <div class="col-lg-6">
                                          {{--  The New Code --}}
              <h2 class="text-bold text-center">
                {{$image ? 'New profile photo' : 'Add profile photo'}}
              </h2>
              <div class="text-center">
                <img src="{{$image ? asset($image->file_path) : asset('dashboard/dist/img/NoPhoto.jpg')}}" id="previewImage" style="width: 200px; height: 200px; object-fit: cover;" class="img-circle elevation-2 m-4" alt="profle photo">
                <div class="custom-file">
                  <input type="file" name="image" class="custom-file-input imageInput" id="choosePhotoProfile">
                  <label class="custom-file-label" for="choosePhotoProfile">Choose profile photo</label>
                </div>
              </div>
                                      {{-- The past code --}}
            {{-- @if ($image)
              <h2 class="text-bold text-center">New profile photo</h2>
                <div class="text-center">
                    <img src="{{asset($image->file_path)}}" id="previewImage" style="width: 200px; height: 200px;  object-fit: cover;" class="img-circle elevation-2 m-4" alt="No Photo">
                  <div class="custom-file">
                    <input type="file" name="image" class="custom-file-input" id="imageInput" accept="image/*">
                    <label class="custom-file-label" for="imageInput">Choose photo</label>
                  </div>
                </div>
                @else
                <h2 class="text-bold text-center">Add profile photo</h2>
                <img src="{{asset('dashboard/dist/img/NoPhoto.jpg')}}" class="card-img-top m-4" alt="No Photo">
                <div class="custom-file">
                  <input type="file" name="image" class="custom-file-input" id="choosePhoto">
                  <label class="custom-file-label" for="choosePhoto">Choose profile photo</label>
                </div>
              @endif --}}
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
          <button type="submit" class="btn btn-primary">Save</button>
        </div>
      </form>
    </div>
  </div>
</div>

{{-- Password Moadal --}}
<div class="modal fade" id="PasswordModal" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="PasswordModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content"> 
      <div class="modal-header">
        <h5 class="modal-title" id="PasswordModalLabel">Change Password</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="{{route('user.password.edit', $user->id)}}" method="post" enctype="multipart/form-data">
          @csrf
            <input type="hidden" name="userId" value="{{Auth::user() ? Auth::user()->id : ""}}">
          <div class="mb-3">
            <label for="currenPass" class="form-label">Current Password</label>
            <input class="form-control" id="currenPass" name="current_password" required type="password">
          </div>
          <div class="mb-3">
            <label for="newPassword" class="form-label">New Paswword</label>
            <input type="password" class="form-control" minlength="8" id="newPassword" required name="new_password">
          </div>
          <div class="mb-3">
            <label for="conPassword" class="form-label">Confirm New Paswword</label>
            <input type="password" class="form-control" id="conPassword" minlength="8" required name="new_password_confirmation">
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
            <button type="submit" class="btn btn-primary">Save</button>
          </div>
        </form>
      </div>
  
    </div>
  </div>
</div>
@endsection

@section('js')
  <script>
    document.querySelector('.imageInput').addEventListener('change', function (event) {
      const file = event.target.files[0];
      if (file) {
        const imageUrl = URL.createObjectURL(file);
        document.getElementById('previewImage').src = imageUrl;
      }
    })

    function removePhoto(userId) {

      if (!userId) return console.error('Invalid user ID');

      let alert = document.getElementById('success-alert');

      fetch(`/dashboard/user/photo/${userId}/remove`, {
      method: 'DELETE',
      headers: {
        'X-CSRF-TOKEN' : '{{csrf_token()}}',
        'Accept' : 'application/json',
      }, 
      }).then(response => {
        if (!response.ok) throw new Error("Failed to delete photo.")
        return response.json()

        }).then(data => {
          localStorage.setItem('success', data.message);
          window.location.href = "{{route('UserProfile')}}"
        }).catch(error => {
        console.error(error);
        })
    }
  </script>
@endsection