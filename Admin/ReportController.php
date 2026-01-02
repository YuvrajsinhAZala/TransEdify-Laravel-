<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Course;
use App\Models\Attendance;
use App\Models\Result;
use App\Models\Fee;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function index()
    {
        $totalStudents = User::where('role', 'student')->count();
        $totalCourses = Course::count();
        $totalFees = Fee::sum('amount');
        $paidFees = Fee::where('status', 'paid')->sum('amount');
        $unpaidFees = Fee::where('status', 'unpaid')->sum('amount');
        
        $recentStudents = User::where('role', 'student')->latest()->take(5)->get();
        $recentCourses = Course::latest()->take(5)->get();

        return view('admin.reports.index', compact(
            'totalStudents',
            'totalCourses',
            'totalFees',
            'paidFees',
            'unpaidFees',
            'recentStudents',
            'recentCourses'
        ));
    }
}

