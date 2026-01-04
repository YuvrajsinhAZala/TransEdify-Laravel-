@extends('layouts.student')

@section('title', 'My Courses')

@section('content')
<div class="row">
    <div class="col-12">
        <h2 class="mb-4">My Courses</h2>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                @if($courses->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Course Code</th>
                                    <th>Course Name</th>
                                    <th>Description</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($courses as $course)
                                    <tr>
                                        <td><strong>{{ $course->course_code }}</strong></td>
                                        <td>{{ $course->course_name }}</td>
                                        <td>{{ $course->description ?? 'No description available' }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="alert alert-info">
                        <p class="mb-0">You are not enrolled in any courses yet.</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection

