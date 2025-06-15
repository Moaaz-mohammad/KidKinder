@extends('layouts.theme')

@section('page-title', 'Request')

@section('css')
<style>
    * {
        box-sizing: border-box;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }
    
    body {
        background-color: #f5f5f5;
        /* margin: 0;
        padding: 20px; */
    }
    
    .tracking-container {
        max-width: 800px;
        margin: 30px auto;
        background: white;
        border-radius: 10px;
        box-shadow: 0 0 20px rgba(0,0,0,0.1);
        padding: 30px;
    }
    
    h1 {
        color: #333;
        text-align: center;
        margin-bottom: 30px;
    }
    
    .request-header {
        display: flex;
        justify-content: space-between;
        margin-bottom: 15px;
        align-items: center;
    }
    
    .status-timeline {
        position: relative;
        padding: 20px 0;
    }
    
    .timeline-progress {
        height: 4px;
        background: #e0e0e0;
        position: absolute;
        top: 50px;
        left: 0;
        right: 0;
        z-index: 1;
    }
    
    .progress-bar {
        height: 100%;
        background: #4CAF50; /* Default color (for approved) */
        width: 0%; /* Will be adjusted by JS based on status */
    }
    
    .timeline-steps {
        display: flex;
        justify-content: space-between;
        position: relative;
        z-index: 2;
    }
    
    .step {
        text-align: center;
        width: 33.33%; /* 3 steps now */
    }
    
    .step-icon {
        width: 40px;
        height: 40px;
        background: white;
        border: 3px solid #e0e0e0;
        border-radius: 50%;
        margin: 0 auto 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #999;
        font-weight: bold;
    }
    
    .step.pending .step-icon {
        border-color: #FF9800;
        background: #FF9800;
        color: white;
    }
    
    .step.approved .step-icon {
        border-color: #4CAF50;
        background: #4CAF50;
        color: white;
    }
    
    .step.rejected .step-icon {
        border-color: #F44336;
        background: #F44336;
        color: white;
    }
    
    .step p {
        margin: 5px 0;
        font-size: 14px;
        color: #666;
    }
    
    .step.active p {
        color: #333;
        font-weight: 500;
    }
    
    .request-summary {
        margin-top: 40px;
        border-top: 1px solid #eee;
        padding-top: 20px;
    }
    
    .summary-row {
        display: flex;
        margin-bottom: 10px;
    }
    
    .summary-label {
        width: 150px;
        color: #666;
    }
    
    .summary-value {
        flex: 1;
        font-weight: 500;
    }
    
    .status-badge {
        display: inline-block;
        padding: 6px 12px;
        border-radius: 20px;
        font-weight: 500;
    }
    
    .badge-pending {
        background-color: #FFF3E0;
        color: #FF9800;
    }
    
    .badge-approved {
        background-color: #E8F5E9;
        color: #4CAF50;
    }
    
    .badge-rejected {
        background-color: #FFEBEE;
        color: #F44336;
    }
    
    @media (max-width: 600px) {
        .timeline-steps {
            flex-wrap: wrap;
        }
        
        .step {
            width: 100%;
            margin-bottom: 20px;
        }
        
        .summary-row {
            flex-direction: column;
        }
        
        .summary-label {
            margin-bottom: 5px;
            width: 100%;
        }
    }
</style>
@endsection
@section('content')
<body>
    <div class="tracking-container">

        <div class="d-flex justify-content-between">
                <h1>#REQ-{{$TheRequest->id}}</h1>
        
        <a href="{{url()->previous()}}" class="btn btn-back">
                <i class="bi bi-arrow-left"></i>
                Back</a>
        </div>



        <div class="request-header">
            <div>
                <strong>Submitted:</strong> <span id="request-date">{{$TheRequest->created_at->format('M d, Y')}}</span>
            </div>
            <div>
                <strong>Status:</strong> <span id="request-status" class="status-badge badge-pending">{{$TheRequest->status}}</span>
            </div>
        </div>
        
        <div class="status-timeline">
            <div class="timeline-progress">
                <div class="progress-bar" id="progress-bar"></div>
            </div>
            <div class="timeline-steps" id="timeline-steps">
                @if ($TheRequest->status != 'rejected')
                    <div class="step pending" id="step-pending">
                        <div class="step-icon">1</div>
                        <p>Pending</p>
                        <p>{{$TheRequest->created_at->format('M d, Y')}}</p>
                    </div>
                    <div class="step" id="step-approved">
                        <div class="step-icon">2</div>
                        <p>Approved</p>
                        <p id="approved-date">-</p>
                    </div>
                @else
                    <div class="step" id="step-rejected">
                    <div class="step-icon">3</div>
                    <p>Rejected</p>
                    <p id="rejected-date">-</p>
                    </div>
                @endif
            </div>
        </div>
        
        <div class="request-summary">
            <h3>Request Details</h3>
            <div class="summary-row">
                <div class="summary-label">Class Name:</div>
                <div class="summary-value">{{$class->class_content_name}}</div>
            </div>
            <div class="summary-row">
                <div class="summary-label">Submitted By:</div>
                <div class="summary-value">{{$TheRequest->email}}</div>
            </div>
            <div class="summary-row">
                <div class="summary-label">Description:</div>
                <div class="summary-value">
                    {{$TheRequest->additional_info}}
                </div>
            </div>
            <div class="summary-row" id="reason-row" style="display: none;">
                <div class="summary-label">Reason:</div>
                <div class="summary-value" id="reason-text"></div>
            </div>
        </div>
    </div>

    <script>
        // Simulate different statuses - replace with your actual status check
        const status = `{{$TheRequest->status}}`; // Can be "pending", "approved", or "rejected"
        const approvedDate = "-";
        const rejectedDate = "";
        const rejectionReason = "No Given";
        
        // Update UI based on status
        function updateStatus() {
            const progressBar = document.getElementById('progress-bar');
            const statusBadge = document.getElementById('request-status');
            
            // Reset all steps
            let stepPending = document.getElementById('step-pending');
            let stepaPproved = document.getElementById('step-approved');
            let stepRejected =  document.getElementById('step-rejected');

            let timelineSteps = document.getElementById('timeline-steps');

            if (stepPending && stepPending) {
                stepPending.classList.remove('pending', 'approved', 'rejected');
                stepaPproved.classList.remove('pending', 'approved', 'rejected');
            }else {
                stepRejected.classList.remove('pending', 'approved', 'rejected');
            }
            
            // Update based on current status
            if (status === "pending") {
                progressBar.style.width = "50%";
                progressBar.style.backgroundColor = "#FF9800";
                statusBadge.className = "status-badge badge-pending";
                statusBadge.textContent = "Pending";
                
                document.getElementById('step-pending').classList.add('pending');
            } 
            else if (status === "approved") {
                progressBar.style.width = "100%";
                progressBar.style.backgroundColor = "#4CAF50";
                statusBadge.className = "status-badge badge-approved";
                statusBadge.textContent = "Approved";
                document.getElementById('step-pending').classList.add('approved');
                document.getElementById('step-approved').classList.add('approved');
                document.getElementById('approved-date').textContent = approvedDate;
            } 
            else if (status === "rejected") {
                progressBar.style.width = "100%";
                progressBar.style.backgroundColor = "#F44336";
                statusBadge.className = "status-badge badge-rejected";
                statusBadge.textContent = "Rejected";
                timelineSteps.style.justifyContent = 'center';
                if (stepPending) {
                    document.getElementById('step-pending').classList.add('rejected');
                }
                document.getElementById('step-rejected').classList.add('rejected');
                document.getElementById('rejected-date').textContent = rejectedDate;
                
                // Show rejection reason
                document.getElementById('reason-row').style.display = "flex";
                document.getElementById('reason-text').textContent = rejectionReason;
            }
        }
        
        // Initialize
        updateStatus();

    </script>
@endsection