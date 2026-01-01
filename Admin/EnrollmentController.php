<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\User;
use App\Models\Enrollment;
use Illuminate\Http\Request;

class EnrollmentController extends Controller
{
    public function index()
    {
        $courses = Course::all();
        $students = User::where('role', 'student')->get();
        $assigned = [];
        $selectedCourseId = null;

        if (request()->has('course_id') || request()->has('course_id')) {
            $selectedCourseId = request('course_id');
            $assigned = Enrollment::where('course_id', $selectedCourseId)
                ->pluck('student_id')
                ->toArray();
        }

        return view('admin.enrollments.index', compact('courses', 'students', 'assigned', 'selectedCourseId'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'course_id' => 'required|exists:courses,id',
            'students' => 'nullable|array',
            'students.*' => 'exists:users,id',
        ]);

        $courseId = $request->course_id;
        
        // Remove all current enrollments for this course
        Enrollment::where('course_id', $courseId)->delete();
        
        // Add new enrollments
        if ($request->has('students')) {
            foreach ($request->students as $studentId) {
                Enrollment::create([
                    'student_id' => $studentId,
                    'course_id' => $courseId,
                ]);
            }
        }

        return redirect()->route('admin.enrollments.index', ['course_id' => $courseId])
            ->with('success', 'Course assignments updated.');
    }
}

