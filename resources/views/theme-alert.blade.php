@section('css')
    <style>
      /* Alert Base Styles */
.alert {
    padding: 15px 20px;
    border-radius: 6px;
    margin: 20px;
    border: 1px solid transparent;
    font-size: 14px;
    display: flex;
    align-items: flex-start;
}

/* Alert Variants */
.alert-success {
    background-color: #dcfce7;
    border-color: #bbf7d0;
    color: #166534;
}

.alert-warning {
    background-color: #fef3c7;
    border-color: #fde68a;
    color: #854d0e;
}

.alert-danger {
    background-color: #fee2e2;
    border-color: #fecaca;
    color: #991b1b;
}

.alert-info {
    background-color: #e0f2fe;
    border-color: #bae6fd;
    color: #0369a1;
}

/* Alert Dismissible */
.alert-dismissible {
    position: relative;
    padding-right: 40px;
}

.alert-dismissible .btn-close {
    position: absolute;
    top: 50%;
    right: 15px;
    transform: translateY(-50%);
    background: none;
    border: none;
    font-size: 18px;
    opacity: 0.7;
    cursor: pointer;
}

/* Alert Icons */
.alert-icon {
    margin-right: 12px;
    font-size: 18px;
}
    </style>
@endsection

<!-- Success Alert -->
@if (!empty(session('success')))
    <div class="alert alert-success alert-action">
        <span class="alert-icon">✓</span>
        {{session('success')}}
    </div>
@endif

<!-- Warning/Pending Alert -->
@if (!empty(session('warning')))
  <div class="alert alert-warning alert-action">
      <span class="alert-icon">!</span>
      {{session('warning')}}
  </div>
@endif
<!-- Error Alert -->
@if (!empty(session('error')))
  <div class="alert alert-danger alert-action">
    <span class="alert-icon">×</span>
    {{session('error')}}
  </div>
@endif

<!-- Dismissible Info Alert -->
{{-- <div class="alert alert-info alert-dismissible alert-action">
    <span class="alert-icon">i</span>
    New requests require manager approval
    <button class="btn-close">×</button>
</div> --}}