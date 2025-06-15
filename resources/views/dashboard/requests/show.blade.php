@extends('layouts.dashboard')

@section('page-title', 'show')

@section('css')
    <style>
        * {
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        body {
            background-color: #f8f9fa;
            color: #333;
        }
        
        .request-container {
            max-width: 1000px;
            margin: 30px auto;
            background: white;
            border-radius: 8px;
            box-shadow: 0 0 15px rgba(0,0,0,0.05);
            padding: 30px;
        }
        
        .request-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 25px;
            padding-bottom: 15px;
            border-bottom: 1px solid #eee;
        }
        
        .request-title {
            font-size: 24px;
            font-weight: 600;
            color: #2c3e50;
            margin: 0;
        }
        
        .request-id {
            color: #3b82f6;
            font-weight: 500;
        }
        
        .status-badge {
            display: inline-block;
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 14px;
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
        
        .user-card {
            display: flex;
            align-items: center;
            margin-bottom: 25px;
            padding: 15px;
            background: #f8fafc;
            border-radius: 6px;
        }
    /*         
        .user-avatar {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            object-fit: cover;
            margin-right: 15px;
        }
         */
        .user-info h3 {
            margin: 0 0 5px 0;
            font-size: 18px;
        }
        
        .user-info p {
            margin: 0;
            color: #64748b;
            font-size: 14px;
        }
        
        .details-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }
        
        .detail-card {
            background: #f8fafc;
            border-radius: 6px;
            padding: 15px;
        }
        
        .detail-card h3 {
            margin-top: 0;
            margin-bottom: 15px;
            font-size: 16px;
            color: #475569;
            border-bottom: 1px solid #e2e8f0;
            padding-bottom: 8px;
        }
        
        .detail-row {
            display: flex;
            margin-bottom: 10px;
        }
        
        .detail-label {
            width: 120px;
            color: #64748b;
            font-size: 14px;
        }
        
        .detail-value {
            flex: 1;
            font-weight: 500;
            font-size: 14px;
        }
        
        .request-content {
            background: #f8fafc;
            border-radius: 6px;
            padding: 20px;
            margin-bottom: 30px;
        }
        
        .request-content h3 {
            margin-top: 0;
            border-bottom: 1px solid #e2e8f0;
            padding-bottom: 10px;
            color: #475569;
        }
        
        .request-description {
            white-space: pre-line;
            line-height: 1.6;
        }
        
        .action-btns {
            display: flex;
            gap: 15px;
            margin-top: 30px;
            padding-top: 20px;
            border-top: 1px solid #eee;
        }
        
        .btn {
            padding: 10px 20px;
            border-radius: 6px;
            font-weight: 500;
            cursor: pointer;
            border: none;
            transition: all 0.2s;
            font-size: 15px;
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
        
        .btn-back {
            background-color: #e2e8f0;
            color: #334155;
        }
        
        .btn-back:hover {
            background-color: #cbd5e1;
        }
        
              
        .btn-pending {
            background-color: #f59e0b;
            color: white;
        }

        .btn-pending:hover {
            background-color: #d97706;
        }

        .attachments {
            margin-top: 25px;
        }
        
        .attachment-list {
            display: flex;
            flex-wrap: wrap;
            gap: 15px;
            margin-top: 10px;
        }
        
        .attachment-item {
            display: flex;
            align-items: center;
            padding: 10px 15px;
            background: white;
            border: 1px solid #e2e8f0;
            border-radius: 6px;
            text-decoration: none;
            color: #334155;
            transition: all 0.2s;
        }
        
        .attachment-item:hover {
            border-color: #cbd5e1;
            background: #f8fafc;
        }
        
        .attachment-icon {
            margin-right: 10px;
            color: #64748b;
        }
        
        @media (max-width: 768px) {
            .request-header {
                flex-direction: column;
                align-items: flex-start;
                gap: 10px;
            }
            
            .details-grid {
                grid-template-columns: 1fr;
            }
            
            .action-btns {
                flex-direction: column;
            }
            
            .btn {
                width: 100%;
            }
        }
    </style>
@endsection

@section('content')

  @php
    $formatedTime_from = \Carbon\Carbon::createFromFormat("H:i:s", $requestClass->from_time)->format('H:i');
    $formatedTime_to = \Carbon\Carbon::createFromFormat("H:i:s", $requestClass->to)->format('H:i');
  @endphp

    <div class="request-container">
        <div class="request-header">
            <div>
                <h1 class="request-title"><span class="request-id">#REQ-{{$classRequest->id}}</span></h1>
                <span class="status-badge mt-2 status-{{$classRequest->status}}">{{$classRequest->status}}</span>
            </div>
            <a href="{{route('admin.requests.index')}}" class="btn btn-back">← Back to Requests</a>
        </div>
        
        <div class="user-card">
            <div class="user-info">
                <div class="d-flex">
                  <div class="row">
                    <h3>{{$classRequest->name}}</h3>
                    <p>{{$classRequest->email}}</p>
                    <p>Member since: {{$classRequest->user->created_at->format('M Y')}}</p>
                  </div>
                </div>
            </div>
        </div>
        
        <div class="details-grid">
            <div class="detail-card">
                <h3>Request Information</h3>
                <div class="detail-row">
                    <div class="detail-label">Class:</div>
                    <div class="detail-value">{{$requestClass->class_content_name}}</div>
                </div>
                <div class="detail-row">
                    <div class="detail-label">Submitted:</div>
                    {{-- <div class="detail-value">October 15, 2023 at 10:30 AM</div> --}}
                    {{-- <div class="detail-value">-----------------</div> --}}
                    <div class="detail-value">{{$classRequest->created_at->format('M d Y, h:i A')}}</div>
                </div>
                  <div class="detail-row">
                    <div class="detail-label">Class time</div>
                    <div class="detail-value">{{$formatedTime_from}} - {{$formatedTime_to}}</div>
                </div>
                  <div class="detail-row">
                    <div class="detail-label">Class ages</div>
                    <div class="detail-value">{{$requestClass->from_age}} - {{$requestClass->to_age}}</div>
                </div>
            </div>
            
            <div class="detail-card">
                <h3>User Details</h3>
                <div class="detail-row">
                    <div class="detail-label">First name:</div>
                    <div class="detail-value">{{$classRequest->name}}</div>
                </div>
                  <div class="detail-row">
                    <div class="detail-label">Last name:</div>
                    <div class="detail-value">{{$classRequest->user->last_name}}</div>
                </div>
                <div class="detail-row">
                    <div class="detail-label">Member since:</div>
                    <div class="detail-value">{{$classRequest->user->created_at->format('M d, Y')}}</div>
                </div>
                <div class="detail-row">
                    <div class="detail-label">user age:</div>
                    <div class="detail-value">{{$classRequest->user->age}}</div>
                </div>
            </div>
        </div>
        
        <div class="request-content">
            <h3>Request Details</h3>
            <div class="request-description">
              {{$classRequest->additional_info}}
            </div>
        </div>
        
        {{-- <div class="attachments">
            <h3>Attachments (2)</h3>
            <div class="attachment-list">
                <a href="#" class="attachment-item">
                    <span class="attachment-icon">📄</span>
                    <span>Project_Approval.pdf</span>
                </a>
                <a href="#" class="attachment-item">
                    <span class="attachment-icon">📊</span>
                    <span>Access_Requirements.xlsx</span>
                </a>
            </div>
        </div> --}}
        
        <div class="action-btns">
          <form action="{{route('admin.requests.approve', $classRequest->id)}}" method="POST">
            @csrf
            <input type="hidden" name="user_id" value="{{$classRequest->user->id}}">
            <button type="submit" class="btn btn-approve">Approve Request</button>
          </form>
          <form action="{{route('admin.requests.reject', $classRequest->id)}}" method="POST">
            @csrf
            <button type="submit" class="btn btn-reject">Reject Request</button>
          </form>
          <form action="{{route('admin.requests.pending', $classRequest->id)}}" method="POST">
            @csrf
            <button type="submit" class="btn btn-pending">Pending Request</button>
          </form>
        </div>
    </div>
@endsection