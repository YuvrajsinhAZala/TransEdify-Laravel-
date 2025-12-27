<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Fee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FeeController extends Controller
{
    public function index()
    {
        $student = Auth::user();
        $fees = Fee::where('student_id', $student->id)
            ->orderBy('created_at', 'desc')
            ->get();
        
        return view('student.fees.index', compact('fees'));
    }
}

