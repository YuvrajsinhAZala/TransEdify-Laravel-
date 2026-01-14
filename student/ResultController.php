<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Result;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ResultController extends Controller
{
    public function index()
    {
        $student = Auth::user();
        $results = Result::where('student_id', $student->id)
            ->with('course')
            ->get();
        
        return view('student.results.index', compact('results'));
    }
}

