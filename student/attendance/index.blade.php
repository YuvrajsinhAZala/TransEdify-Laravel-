@extends('layouts.student')

@section('title', 'My Attendance')

@section('content')
<div class="row">
    <div class="col-12">
        <h2 class="mb-4">My Attendance</h2>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                @if($attendances->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Date</th>
                                    <th>Course</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($attendances as $attendance)
                                    <tr>
                                        <td>{{ $attendance->date->format('M d, Y') }}</td>
                                        <td>{{ $attendance->course->course_name ?? 'N/A' }} ({{ $attendance->course->course_code ?? 'N/A' }})</td>
                                        <td>
                                            @if($attendance->status === 'present')
                                                <span class="badge bg-success">Present</span>
                                            @else
                                                <span class="badge bg-danger">Absent</span>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="alert alert-info">
                        <p class="mb-0">No attendance records found.</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection

