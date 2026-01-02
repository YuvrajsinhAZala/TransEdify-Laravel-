<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\User;
use App\Models\Result;
use App\Models\Enrollment;
use Illuminate\Http\Request;

class ResultController extends Controller
{
    public function index()
    {
        $courses = Course::all();
        $students = [];
        $existingResults = [];
        $selectedCourseId = null;

        if (request()->has('course_id')) {
            $selectedCourseId = request('course_id');
            $students = User::whereHas('enrollments', function($query) use ($selectedCourseId) {
                $query->where('course_id', $selectedCourseId);
            })->get();

            $existingResults = Result::where('course_id', $selectedCourseId)
                ->get()
                ->keyBy('student_id');
        }

        return view('admin.results.index', compact(
            'courses', 
            'students', 
            'existingResults', 
            'selectedCourseId'
        ));
    }

    public function store(Request $request)
    {
        $request->validate([
            'course_id' => 'required|exists:courses,id',
            'marks' => 'required|array',
            'marks.*' => 'required|integer|min:0|max:100',
            'grades' => 'required|array',
            'grades.*' => 'required|string|max:2',
        ]);

        $courseId = $request->course_id;

        foreach ($request->marks as $studentId => $marks) {
            $grade = $request->grades[$studentId];
            
            Result::updateOrCreate(
                [
                    'student_id' => $studentId,
                    'course_id' => $courseId,
                ],
                [
                    'marks' => $marks,
                    'grade' => strtoupper($grade),
                ]
            );
        }

        return redirect()->route('admin.results.index', ['course_id' => $courseId])
            ->with('success', 'Results saved successfully!');
    }
}

