@extends('layouts.theme')

@section('page-title', 'Profile')

@section('css')
    <style>
       /* <!-- Minimal custom CSS --> */
        .profile-avatar {
            width: 150px;
            height: 150px;
            object-fit: cover;
        }
        .stat-card {
            transition: all 0.3s ease;
        }
        .stat-card:hover {
            transform: translateY(-5px);
        }
        .nav-tabs .nav-link.active {
            font-weight: 600;
            border-bottom: 3px solid #0d6efd;
        }

        .notification-item {
            transition: background-color 0.2s;
            cursor: pointer;
        }

        .notification-item:hover {
            background-color: #f8f9fa;
        }

        .notification-item.unread {
            background-color: #f0f7ff;
        }

        .notification-item .btn-close {
            opacity: 0;
            transition: opacity 0.2s;
        }

        .notification-item:hover .btn-close {
            opacity: 0.5;
        }

        .notification-item:hover .btn-close:hover {
            opacity: 1;
        }
    </style>
@endsection

@section('content')
    <div class="container py-5">
        <div class="row">

            <div class="col-lg-4">
                <div class="card shadow-sm mb-4 profile">
                    <div class="card-body text-center">
                        <img src="{{asset('dashboard/dist/img/NoPhoto.jpg')}}" alt="Profile" class="rounded-circle profile-avatar mb-3 img-thumbnail">
                        <h4 class="mb-1">{{$user->name . ' '. $user->last_name}}</h4>
                        <p class="text-muted mb-3">{{$user->email}}</p>
                        <div class="d-flex justify-content-center mb-3">
                            <a class="btn btn-danger m-2" href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">Logout</a>
                            <a href="{{route('notifications.index')}}" class="btn btn-light m-2 text-warning"><i class="bi bi-bell-fill"></i> {{auth()->user()->unreadNotifications->count() > 0 ? auth()->user()->unreadNotifications->count() : ''}} </a>
                            {{-- <a class="btn btn-secondary m-2 text-warning"><i class="bi bi-bell-fill"></i> </a> --}}
                        </div>
                        <div class="d-flex justify-content-around text-center">
                            <div>
                                <p class="h5 mb-1">{{$totalRequests}}</p>
                                <p class="small text-muted mb-0">Requests</p>
                            </div>
                            <div>
                                <p class="h5 mb-1">{{$approvedRequests}}</p>
                                <p class="small text-muted mb-0">Approved</p>
                            </div>
                            <div>
                                <p class="h5 mb-1">{{$rejectedRequests}}</p>
                                <p class="small text-muted mb-0">Rejected</p>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="card shadow-sm mb-4">
                    <div class="card-body">
                        <h5 class="card-title">Requests</h5>
                        <ul class="list-unstyled">
                            <li class="mb-2">
                                @if (count($requests) > 0)
                                    <a href="{{route('requests.index')}}" class="btn btn-sm btn-outline-secondary">
                                        <i class="bi bi-list-ul"></i> View All Requests
                                    </a>
                                @else
                                    <div class="text-center">
                                        <p>No Requests</p>
                                    </div>
                                @endif
                            </li>
                        </ul>
                    </div>
                </div>

            </div>
            
            <div class="col-lg-8">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <ul class="nav nav-tabs mb-4">
                            <li class="nav-item">
                                <a class="nav-link active" href="#activity" data-bs-toggle="tab">Activity</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#requests" data-bs-toggle="tab">Requests</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#settings" data-bs-toggle="tab">Settings</a>
                            </li>
                        </ul>
                        
                        <div class="tab-content">
                            <div class="tab-pane fade show active" id="activity">
                                @if ($requests->isEmpty())
                                    <div class="alert alert-info">
                                    No recent activity here
                                    </div>
                                @else
                                    @foreach($requests->take(5) as $request)
                                    <div class="list-group">
                                        <div class="list-group-item d-flex justify-content-between align-items-center">
                                        <div>
                                            <h6 class="mb-1">#REQ-{{$request->created_at->format('Y')}}-{{$request->id}}</h6>
                                            <small class="text-muted">{{ucfirst($request->status)}} -{{$request->created_at->format('M d, Y')}}</small>
                                        </div>
                                        <span class="badge text-white bg-{{$request->status == 'approved' ? 'success' : ($request->status === 'pending' ? 'warning' : 'danger')}}">{{ucfirst($request->status)}}</span>
                                        </div>
                                    </div>
                                    @endforeach
                                @endif
                            </div>
                            
                            <div class="tab-pane fade" id="requests">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Class</th>
                                            <th>Date</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($requests->take(5) as $request)
                                        <tr>
                                            <td>#REQ-{{$request->created_at->year}}-{{$request->id}}</td>
                                            <td>{{$request->class->class_content_name}}</td>
                                            <td>{{$request->created_at->format('M d, Y')}}</td>
                                            <td><span class="badge text-light bg-{{$request->status === 'approved' ? 'success' : ($request->status === 'pending' ? 'warning' : 'danger')}}">{{ucfirst($request->status)}}</span></td>
                                            <td><a href="{{route('request.show', $request->id)}}" class="btn btn-sm btn-outline-primary">View</a></td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                @if (count($requests) > 5)
                                    <a href="{{route('requests.index')}}" class="btn btn-primary">
                                        <i class="bi bi-list-ul"></i> View All Requests
                                    </a>
                                @elseif(count($requests) == 0)
                                    <div class="text-center">
                                        <p>No Requests</p>
                                    </div>
                                @endif
                            </div>
                            
                            <div class="tab-pane fade" id="settings">
                                <form action="{{route('settingsUpdate', $user->id)}}" method="POST">
                                    @csrf
                                    <div class="mb-3">
                                        <label class="form-label">Email</label>
                                        <input type="email" class="form-control" name="email" value="{{old('email', $user->email)}}">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Password</label>
                                        <input type="password" class="form-control" name="password" placeholder="Enter new password">
                                    </div>
                                    <button type="submit" class="btn btn-primary">Save Changes</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="card shadow-sm mb-4">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h5 class="card-title mb-0">Notifications</h5>
                            @if (count($notifications) >= 2)
                                <form action="{{route('notifications.markAllRead')}}" method="post">
                                    @csrf
                                    <button type="submit" class="btn btn-sm btn-outline-secondary mark-all-read">
                                        Mark all as read
                                    </button>
                                </form>
                            @endif
                        </div>
                        
                        <div class="notification-list">
                            
                            @if ($notifications->isEmpty())
                                <div class="text-center">
                                    <p>No notifications found</p>
                                </div>
                            @endif

                            @foreach ($notifications->take(5) as $notification)
                                <div class="notification-item p-3 border-bottom">
                                    <div class="d-flex">
                                        <div class="flex-shrink-0 mr-3">
                                            <i class="bi bi-check-circle-fill text-success"></i>
                                        </div>
                                        <div class="flex-grow-1">
                                            <p class="mb-1">{{$notification->data['title'] ?? "No title"}}</p>
                                            <small class="text-muted">{{$notification->created_at->diffForHumans()}}</small>
                                        </div>
                                        
                                        @if ($notification->unread())
                                            <form action="{{route('notifications.markAsRead', $notification->id)}}" method="POST">
                                                @csrf
                                                <button type="submit" class="btn btn-close notification-dismiss">Mark as read</button>
                                            </form>
                                        @endif

                                    </div>
                                </div>
                            @endforeach
                            
                        </div>
                        
                        <a href="{{ route('notifications.index') }}" class="btn btn-sm btn-link w-100 mt-2">
                            View all notifications
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection