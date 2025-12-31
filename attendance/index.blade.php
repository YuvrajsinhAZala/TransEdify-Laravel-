@extends('layouts.admin')

@section('title', 'Manage Attendance')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Manage Attendance</h2>
</div>

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h5>Mark Attendance</h5>
            </div>
            <div class="card-body">
                <form method="GET" action="{{ route('admin.attendance.index') }}" class="mb-4">
                    <div class="row">
                        <div class="col-md-4">
                            <label class="form-label">Select Course</label>
                            <select name="course_id" class="form-select" required>
                                <option value="">-- Select Course --</option>
                                @foreach($courses as $course)
                                    <option value="{{ $course->id }}" {{ $selectedCourseId == $course->id ? 'selected' : '' }}>
                                        {{ $course->course_code }} - {{ $course->course_name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Date</label>
                            <input type="date" name="date" class="form-control" value="{{ $selectedDate }}" required>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">&nbsp;</label>
                            <div>
                                <button type="submit" name="view" value="1" class="btn btn-info">View Attendance</button>
                            </div>
                        </div>
                    </div>
                </form>

                @if($selectedCourseId && $students->count() > 0)
                <form method="POST" action="{{ route('admin.attendance.store') }}">
                    @csrf
                    <input type="hidden" name="course_id" value="{{ $selectedCourseId }}">
                    <input type="hidden" name="date" value="{{ $selectedDate }}">
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Username</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($students as $student)
                                    <tr>
                                        <td>{{ $student->id }}</td>
                                        <td>{{ $student->name }}</td>
                                        <td>{{ $student->username }}</td>
                                        <td>
                                            <select name="attendance[{{ $student->id }}]" class="form-select form-select-sm">
                                                <option value="present">Present</option>
                                                <option value="absent">Absent</option>
                                            </select>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <button type="submit" class="btn btn-primary mt-3">Save Attendance</button>
                </form>
                @elseif($viewAttendance && $attendanceRecords->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Student Name</th>
                                    <th>Status</th>
                                    <th>Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($attendanceRecords as $record)
                                    <tr>
                                        <td>{{ $record->student->name }}</td>
                                        <td>
                                            <span class="badge bg-{{ $record->status == 'present' ? 'success' : 'danger' }}">
                                                {{ ucfirst($record->status) }}
                                            </span>
                                        </td>
                                        <td>{{ $record->date }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @elseif($selectedCourseId)
                    <div class="alert alert-warning">No students enrolled in this course.</div>
                @else
                    <div class="alert alert-info">Please select a course to mark attendance.</div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection

