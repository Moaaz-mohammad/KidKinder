@extends('layouts.dashboard')

@section('page-title', 'Requests')

@section('css')
    <style>
        * {
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        body {
            background-color: #f8f9fa;
            /* margin: 0;
            padding: 20px; */
        }
        
        .admin-container {
            max-width: 1200px;
            margin: 30px auto;
            background: white;
            border-radius: 8px;
            box-shadow: 0 0 15px rgba(0,0,0,0.05);
            padding: 25px;
        }
        
        h1 {
            color: #2c3e50;
            margin-bottom: 25px;
            padding-bottom: 10px;
            border-bottom: 1px solid #eee;
        }
        
        .requests-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            font-size: 14px;
        }
        
        .requests-table th {
            text-align: left;
            padding: 12px 15px;
            background: #f1f5f9;
            color: #334155;
            font-weight: 600;
            border-bottom: 2px solid #e2e8f0;
        }
        
        .requests-table td {
            padding: 12px 15px;
            border-bottom: 1px solid #f1f5f9;
            vertical-align: middle;
        }
        
        .request-id {
            color: #3b82f6;
            font-weight: 500;
        }
        
        .user-info {
            display: flex;
            align-items: center;
        }
        
        /* .user-avatar {
            width: 32px;
            height: 32px;
            border-radius: 50%;
            margin-right: 10px;
            object-fit: cover;
        } */
        
        .status-badge {
            display: inline-block;
            padding: 5px 10px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 500;
            text-transform: capitalize;
        }
        
        .status-pending {
            background-color: #fef3c7;
            color: #d97706;
        }
        
        .status-approved {
            background-color: #dcfce7;
            color: #16a34a;
        }
        
        .status-rejected {
            background-color: #fee2e2;
            color: #dc2626;
        }
        
        .action-btns {
            display: flex;
            gap: 8px;
        }
        
        .btn {
            padding: 6px 12px;
            border-radius: 4px;
            font-size: 13px;
            font-weight: 500;
            cursor: pointer;
            border: none;
            transition: all 0.2s;
        }
        
        .btn-approve {
            background-color: #10b981;
            color: white;
        }
        
        .btn-approve:hover {
            background-color: #0d9f6e;
        }
        
        .btn-reject {
            background-color: #ef4444;
            color: white;
        }
        
        .btn-reject:hover {
            background-color: #dc2626;
        }
        
        .btn-view {
            background-color: #3b82f6;
            color: white;
        }
        
        .btn-view:hover {
            background-color: #2563eb;
        }
        
        .btn-pending {
            background-color: #f59e0b;
            color: white;
        }

        .btn-pending:hover {
            background-color: #d97706;
        }
        
        .pagination {
            display: flex;
            justify-content: center;
            margin-top: 25px;
            gap: 5px;
        }
        
        /* .page-btn {
            padding: 8px 12px;
            border-radius: 4px;
            background: white;
            border: 1px solid #e2e8f0;
            cursor: pointer;
        } */
        
        /* .page-btn.active {
            background: #3b82f6;
            color: white;
            border-color: #3b82f6;
        } */
        
        @media (max-width: 768px) {
            .requests-table {
                display: block;
                overflow-x: auto;
                white-space: nowrap;
            }
            
            .action-btns {
                flex-direction: column;
                gap: 5px;
            }
            
            .btn {
                width: 100%;
            }
        }
    </style>
@endsection

@section('content')
    <div class="admin-container">
    <h1>Requests Management</h1>
    
    <div class="table-responsive">
        <table class="requests-table">
            <thead>
                <tr>
                    <th>Request ID</th>
                    <th>User name</th>
                    <th>Class</th>
                    <th>Date</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @if (count($requests) > 0)
                    @foreach ($requests as $request)
                        @php
                            $request_status = $request->status;
                        @endphp
                        <tr>
                            <td class="request-id">#REQ-{{$request->id}}</td>
                            <td>
                                <div class="user-info">
                                    <span>{{$request->user->name}}</span>
                                </div>
                            </td>
                            <td>{{$request->class->class_content_name}}</td>
                            <td>{{$request->created_at->format('M d, y')}}</td>
                            <td><span class="status-badge status-{{$request->status}}">{{$request_status}}</span></td>
                            <td>
                                <div class="action-btns">
                                    <form action="{{route('admin.requests.approve', $request->id)}}" method="post">
                                        @csrf
                                        <input type="hidden" name="user_id" value="{{$request->user->id}}">
                                        <button type="submit" class="btn btn-approve">Approve</button>
                                    </form>
                                    <form action="{{route('admin.requests.reject', $request->id)}}" method="post">
                                        @csrf
                                        <button type="submit" class="btn btn-reject" >Reject</button>
                                    </form>
                                    <form action="{{route('admin.requests.pending', $request->id)}}" method="post">
                                        @csrf
                                        <button type="submit" class="btn btn-pending">pending</button>
                                    </form>
                                    <a href="{{route('admin.requests.show', $request->id)}}" class="btn btn-view">View</a>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                @endif
            </tbody>
        </table>
    </div>
    
    <div class="pagination">
        {{$requests->links()}}
        {{-- <button class="page-btn">Previous</button>
        <button class="page-btn active">1</button>
        <button class="page-btn">2</button>
        <button class="page-btn">3</button>
        <button class="page-btn">Next</button> --}}
    </div>
    </div>
@endsection