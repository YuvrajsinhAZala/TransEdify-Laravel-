@extends('layouts.student')

@section('title', 'Reports')

@section('content')
<div class="row">
    <div class="col-12">
        <h2 class="mb-4">Academic Reports</h2>
    </div>
</div>

<div class="row g-4 mb-4">
    <!-- Total Courses Card -->
    <div class="col-md-3">
        <div class="card text-center">
            <div class="card-body">
                <div class="display-4 mb-3">📚</div>
                <h5 class="card-title">Total Courses</h5>
                <h2 class="text-primary">{{ $totalCourses }}</h2>
            </div>
        </div>
    </div>

    <!-- Attendance Percentage Card -->
    <div class="col-md-3">
        <div class="card text-center">
            <div class="card-body">
                <div class="display-4 mb-3">✅</div>
                <h5 class="card-title">Attendance</h5>
                <h2 class="text-{{ $attendancePercentage >= 75 ? 'success' : ($attendancePercentage >= 50 ? 'warning' : 'danger') }}">
                    {{ number_format($attendancePercentage, 1) }}%
                </h2>
            </div>
        </div>
    </div>

    <!-- Average Marks Card -->
    <div class="col-md-3">
        <div class="card text-center">
            <div class="card-body">
                <div class="display-4 mb-3">📊</div>
                <h5 class="card-title">Average Marks</h5>
                <h2 class="text-{{ $averageMarks >= 50 ? 'success' : 'danger' }}">
                    {{ $averageMarks ? number_format($averageMarks, 1) : 'N/A' }}
                </h2>
            </div>
        </div>
    </div>

    <!-- Fees Summary Card -->
    <div class="col-md-3">
        <div class="card text-center">
            <div class="card-body">
                <div class="display-4 mb-3">💰</div>
                <h5 class="card-title">Fees Status</h5>
                <h6 class="text-success">Paid: ${{ number_format($paidFees, 2) }}</h6>
                <h6 class="text-warning">Unpaid: ${{ number_format($unpaidFees, 2) }}</h6>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h5>Summary</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <h6>Academic Performance</h6>
                        <ul class="list-unstyled">
                            <li><strong>Total Courses:</strong> {{ $totalCourses }}</li>
                            <li><strong>Average Marks:</strong> {{ $averageMarks ? number_format($averageMarks, 1) : 'N/A' }}</li>
                            <li><strong>Attendance Rate:</strong> {{ number_format($attendancePercentage, 1) }}%</li>
                        </ul>
                    </div>
                    <div class="col-md-6">
                        <h6>Financial Status</h6>
                        <ul class="list-unstyled">
                            <li><strong>Total Fees:</strong> ${{ number_format($totalFees, 2) }}</li>
                            <li><strong>Paid:</strong> ${{ number_format($paidFees, 2) }}</li>
                            <li><strong>Unpaid:</strong> ${{ number_format($unpaidFees, 2) }}</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

