<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Attendance;
use App\Models\Result;
use App\Models\Fee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReportController extends Controller
{
    public function index()
    {
        $student = Auth::user();
        
        $totalCourses = $student->courses()->count();
        $totalAttendance = Attendance::where('student_id', $student->id)->count();
        $presentCount = Attendance::where('student_id', $student->id)->where('status', 'present')->count();
        $attendancePercentage = $totalAttendance > 0 ? ($presentCount / $totalAttendance) * 100 : 0;
        
        $totalFees = Fee::where('student_id', $student->id)->sum('amount');
        $paidFees = Fee::where('student_id', $student->id)->where('status', 'paid')->sum('amount');
        $unpaidFees = Fee::where('student_id', $student->id)->where('status', 'unpaid')->sum('amount');
        
        $averageMarks = Result::where('student_id', $student->id)->avg('marks');
        
        return view('student.reports.index', compact(
            'totalCourses',
            'attendancePercentage',
            'totalFees',
            'paidFees',
            'unpaidFees',
            'averageMarks'
        ));
    }
}

