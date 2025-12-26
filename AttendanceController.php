<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Attendance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AttendanceController extends Controller
{
    public function index()
    {
        $student = Auth::user();
        $attendances = Attendance::where('student_id', $student->id)
            ->with('course')
            ->orderBy('date', 'desc')
            ->get();
        
        return view('student.attendance.index', compact('attendances'));
    }
}

