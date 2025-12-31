@extends('layouts.admin')

@section('title', 'Manage Courses')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Manage Courses</h2>
</div>

<div class="row">
    <div class="col-md-4">
        <div class="card">
            <div class="card-header">
                <h5>{{ $editCourse ? 'Edit Course' : 'Add New Course' }}</h5>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ $editCourse ? route('admin.courses.update', $editCourse->id) : route('admin.courses.store') }}">
                    @csrf
                    @if($editCourse)
                        @method('PUT')
                    @endif

                    @if(!$editCourse)
                    <div class="mb-3">
                        <label class="form-label">Course Code</label>
                        <input type="text" name="course_code" class="form-control" value="{{ old('course_code') }}" required>
                        @error('course_code')<div class="text-danger small">{{ $message }}</div>@enderror
                    </div>
                    @endif

                    <div class="mb-3">
                        <label class="form-label">Course Name</label>
                        <input type="text" name="course_name" class="form-control" value="{{ old('course_name', $editCourse->course_name ?? '') }}" required>
                        @error('course_name')<div class="text-danger small">{{ $message }}</div>@enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Description</label>
                        <textarea name="description" class="form-control" rows="3">{{ old('description', $editCourse->description ?? '') }}</textarea>
                        @error('description')<div class="text-danger small">{{ $message }}</div>@enderror
                    </div>
                    <button type="submit" class="btn btn-primary">{{ $editCourse ? 'Update' : 'Add' }} Course</button>
                    @if($editCourse)
                        <a href="{{ route('admin.courses.index') }}" class="btn btn-secondary">Cancel</a>
                    @endif
                </form>
            </div>
        </div>
    </div>
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h5>Courses List</h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Course Code</th>
                                <th>Course Name</th>
                                <th>Description</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($courses as $course)
                                <tr>
                                    <td>{{ $course->id }}</td>
                                    <td>{{ $course->course_code }}</td>
                                    <td>{{ $course->course_name }}</td>
                                    <td>{{ Str::limit($course->description, 50) }}</td>
                                    <td>
                                        <a href="{{ route('admin.courses.index', ['edit' => $course->id]) }}" class="btn btn-sm btn-warning">Edit</a>
                                        <form method="POST" action="{{ route('admin.courses.destroy', $course->id) }}" class="d-inline" onsubmit="return confirm('Are you sure?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr><td colspan="5" class="text-center">No courses found.</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

