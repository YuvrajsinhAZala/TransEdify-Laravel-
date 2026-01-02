<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class StudentController extends Controller
{
    public function index()
    {
        $students = User::where('role', 'student')->get();
        $editStudent = null;
        
        if (request()->has('edit')) {
            $editStudent = User::where('id', request('edit'))->where('role', 'student')->first();
        }

        return view('admin.students.index', compact('students', 'editStudent'));
    }

    public function create()
    {
        return redirect()->route('admin.students.index');
    }

    public function store(Request $request)
    {
        $request->validate([
            'username' => 'required|string|max:50|unique:users',
            'password' => 'required|string|min:6',
            'name' => 'required|string|max:100',
            'email' => 'required|email|max:100',
        ]);

        User::create([
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'role' => 'student',
            'name' => $request->name,
            'email' => $request->email,
        ]);

        return redirect()->route('admin.students.index')->with('success', 'Student added successfully.');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|email|max:100',
        ]);

        $student = User::where('id', $id)->where('role', 'student')->firstOrFail();
        $student->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);

        return redirect()->route('admin.students.index')->with('success', 'Student updated.');
    }

    public function destroy($id)
    {
        $student = User::where('id', $id)->where('role', 'student')->firstOrFail();
        $student->delete();

        return redirect()->route('admin.students.index')->with('success', 'Student deleted.');
    }
}

