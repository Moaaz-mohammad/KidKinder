@extends('layouts.theme')

@section('page-title', 'Notifications')

@section('css')
  <style>
        body {
            background-color: #f8f9fa;
        }
        .notification-container {
            max-width: 1200px;
            margin: 0 auto;
            background: white;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0,0,0,0.05);
            padding: 25px;
        }
        .notification-table {
            border-radius: 8px;
            overflow: hidden;
        }
        .notification-table thead {
            background-color: #f1f5f9;
        }
        .unread-row {
            background-color: #f0f7ff !important;
        }
        .notification-title {
            font-weight: 600;
            color: #1e293b;
        }
        .notification-message {
            color: #64748b;
            font-size: 0.9rem;
        }
        .status-badge {
            font-size: 0.8rem;
            padding: 5px 10px;
            border-radius: 20px;
        }
        .action-btn {
            width: 32px;
            height: 32px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
        }
        .empty-state {
            padding: 40px 0;
            text-align: center;
        }
        .empty-state i {
            font-size: 3rem;
            color: #cbd5e1;
        }
  </style>
@endsection

@section('content')

<div class="container py-5">
      <div class="notification-container">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="mb-0">My Notifications</h2>
            <div>
                <form action="{{route('notifications.markAllRead')}}" method="post" class="d-inline-block">
                    @csrf
                    <button type="submit" class="btn btn-outline-primary btn-sm me-2">
                      <i class="bi bi-check-circle"></i> Mark All as Read
                    </button>
                </form>
                <form action="{{route('notifications.destroyAll')}}" class="d-inline-block" method="post" {{--onsubmit="return confirm('Are you sure you want to delete all notifications?')" --}}>
                  @csrf
                  @method("DELETE")
                  <button type="submit" class="btn btn-outline-danger btn-sm">
                    <i class="bi bi-trash"></i> Delete All Notifications
                  </button>
                </form>
            </div>
        </div>

        <div class="table-responsive notification-table">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th width="50px">#</th>
                        <th>Notification</th>
                        <th width="120px">Status</th>
                        <th width="150px">Date</th>
                        <th width="100px">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Unread Notification Example -->
                    @foreach ($unreadNotifications as $notification)
                      <tr class="unread-row">
                          <td></td>
                          <td>
                              <div class="notification-title">{{$notification->data['title']}}</div>
                              <div class="notification-message">{{$notification->data['message']}}</div>
                          </td>
                          <td>
                              <span class="status-badge bg-warning text-dark">Unread</span>
                          </td>
                          <td>
                              <div>{{$notification->created_at->format('M d, Y')}}</div>
                              <small class="text-muted">{{ $notification->created_at->format('h:i A')}}</small>
                          </td>
                          <td>
                              <form action="{{route('notifications.markAsRead', $notification->id)}}" method="POST">
                                @csrf
                                <button type="submit" class="action-btn btn btn-outline-primary me-1" title="Mark as read">
                                  <i class="bi bi-check-circle"></i>
                                </button>
                              </form>
                              {{-- <button class="action-btn btn btn-outline-danger" title="Delete">
                                  <i class="bi bi-trash"></i>
                              </button> --}}
                          </td>
                      </tr>
                    @endforeach

                    <!-- Read Notification Example -->
                    @foreach ($readNotifications as $notification)
                      <tr>
                        <td></td>
                        <td>
                            <div class="notification-title">{{$notification->data['title'] ?? "No title"}}</div>
                            <div class="notification-message">{{$notification->data['message'] ?? "No message"}}</div>
                        </td>
                        <td>
                            <span class="status-badge bg-success">Read</span>
                        </td>
                        <td>
                            <div>{{$notification->created_at->format('M d, Y')}}</div>
                            <small class="text-muted">{{$notification->created_at->format('H:i A')}}</small>
                        </td>
                        <td>
                            <form action="{{route('notifications.destroy', $notification->id)}}" method="POST">
                              @csrf
                              @method("DELETE")
                              <button type="submit" class="action-btn btn btn-outline-danger" title="Delete">
                                <i class="bi bi-trash"></i>
                            </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach

                    <!-- More notifications can be added here -->
                </tbody>
            </table>
        </div>

        <!-- Empty State (hidden by default) -->
        @if ($readNotifications->isEmpty() && $unreadNotifications->isEmpty())
          <div class="empty-state">
            <i class="bi bi-bell-slash"></i>
            <h5 class="mt-3">No notifications yet</h5>
            <p class="text-muted">When you get notifications, they'll appear here</p>
          </div>
        @endif

        <!-- Pagination -->
        <nav class="mt-4">
            {{-- <ul class="pagination justify-content-center">
                <li class="page-item disabled">
                    <a class="page-link" href="#" tabindex="-1">Previous</a>
                </li>
                <li class="page-item active"><a class="page-link" href="#">1</a></li>
                <li class="page-item"><a class="page-link" href="#">2</a></li>
                <li class="page-item"><a class="page-link" href="#">3</a></li>
                <li class="page-item">
                    <a class="page-link" href="#">Next</a>
                </li>
            </ul> --}}
            {{-- {{$pagin->links()}} --}}
        </nav>
    </div>
</div>

@endsection

@section('js')
  <script>

  </script>
@endsection