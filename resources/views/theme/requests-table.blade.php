@extends('layouts.theme')

@section('page-title', 'All Requests')

@section('css')
    <style>
    * {
        box-sizing: border-box;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }
    
    body {
        background-color: #f5f5f5;
        /* margin: 0; */
        /* padding: 20px; */
    }
    
    .requests-container {
        max-width: 1000px;
        margin: 60px auto;
        background: white;
        border-radius: 10px;
        box-shadow: 0 0 20px rgba(0,0,0,0.1);
        padding: 30px;
    }
    
    h1 {
        color: #333;
        margin-bottom: 30px;
    }
    
    .requests-table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
    }
    
    .requests-table th {
        text-align: left;
        padding: 15px 10px;
        background: #f9f9f9;
        border-bottom: 2px solid #eee;
        color: #666;
        font-weight: 600;
    }
    
    .requests-table td {
        padding: 15px 10px;
        border-bottom: 1px solid #eee;
        vertical-align: middle;
    }
    
    .request-id {
        color: #4CAF50;
        font-weight: 500;
    }
    
    .status-badge {
        display: inline-block;
        padding: 5px 10px;
        border-radius: 20px;
        font-size: 14px;
        font-weight: 500;
    }
    
    .status-pending {
        background-color: #FFF3E0;
        color: #FF9800;
    }
    
    /* .status-processing {
        background-color: #E3F2FD;
        color: #2196F3;
    } */
    
    .status-approved {
        background-color: #E8F5E9;
        color: #4CAF50;
    }
    
    .status-rejected {
        background-color: #FFEBEE;
        color: #F44336;
    }
    
    .action-link {
        color: #4CAF50;
        text-decoration: none;
        font-weight: 500;
    }
    
    .action-link:hover {
        text-decoration: underline;
    }
    
    .no-requests {
        text-align: center;
        padding: 40px;
        color: #666;
    }
    
    @media (max-width: 768px) {
        .requests-table {
            display: block;
            overflow-x: auto;
        }
        
        .requests-table th, 
        .requests-table td {
            white-space: nowrap;
        }
    }
    </style>
@endsection

@section('content')
    <div class="requests-container">
        <div class="d-flex justify-content-between align-items-center">
            <h1 class="mb-0">My Requests</h1>
            <a href="{{route('userProfile')}}" class="btn btn-back">
                <i class="bi bi-arrow-left"></i>
                Back</a>
        </div>
        @php
            $user = Auth::user();
        @endphp
        <table class="requests-table">
            <thead>
                <tr>
                    <th>Request ID</th>
                    <th>Date</th>
                    <th>Class</th>
                    <th>Status</th>
                    <th>Last Update</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @if ($user->classRequests)
                    @foreach ($user->classRequests as $request)
                        <tr>
                        <td class="request-id">#REQ-{{$request->id}}</td>
                        <td>{{$request->created_at->format('Y M, d')}}</td>
                        <td>{{$request->class->class_content_name}}</td>
                        <td><span class="status-badge status-{{$request->status}}">{{$request->status}}</span></td>
                        <td>{{$request->updated_at->format('M d, Y')}}</td>
                        <td><a href="{{route('request.show', $request->id)}}" class="action-link">View Details</a></td>
                        </tr>
                    @endforeach
                @endif
            </tbody>
        </table>
        
        <!-- Uncomment this if you want to show a message when no requests exist -->
        {{-- <div class="no-requests">
            <p>You don't have any requests yet.</p>
            <p>Submit a new request to see it appear here.</p>
        </div> --}}
    </div>
@endsection