<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\User;
use App\Models\Attendance;
use App\Models\Enrollment;
use Illuminate\Http\Request;

class AttendanceController extends Controller
{
    public function index()
    {
        $courses = Course::all();
        $students = [];
        $selectedCourseId = null;
        $selectedDate = request('date', date('Y-m-d'));
        $viewAttendance = false;
        $attendanceRecords = [];

        if (request()->has('course_id') || request()->has('view')) {
            $selectedCourseId = request('course_id');
            $students = User::whereHas('enrollments', function($query) use ($selectedCourseId) {
                $query->where('course_id', $selectedCourseId);
            })->get();

            if (request()->has('view')) {
                $viewAttendance = true;
                $attendanceRecords = Attendance::where('course_id', $selectedCourseId)
                    ->where('date', $selectedDate)
                    ->with('student')
                    ->get();
            }
        }

        return view('admin.attendance.index', compact(
            'courses', 
            'students', 
            'selectedCourseId', 
            'selectedDate',
            'viewAttendance',
            'attendanceRecords'
        ));
    }

    public function store(Request $request)
    {
        $request->validate([
            'course_id' => 'required|exists:courses,id',
            'date' => 'required|date',
            'attendance' => 'required|array',
            'attendance.*' => 'required|in:present,absent',
        ]);

        $courseId = $request->course_id;
        $date = $request->date;

        foreach ($request->attendance as $studentId => $status) {
            Attendance::updateOrCreate(
                [
                    'student_id' => $studentId,
                    'course_id' => $courseId,
                    'date' => $date,
                ],
                [
                    'status' => $status,
                ]
            );
        }

        return redirect()->route('admin.attendance.index')
            ->with('success', 'Attendance saved successfully!');
    }
}

