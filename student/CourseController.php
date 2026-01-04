<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CourseController extends Controller
{
    public function index()
    {
        $student = Auth::user();
        $courses = $student->courses()->get();
        
        return view('student.courses.index', compact('courses'));
    }
}

