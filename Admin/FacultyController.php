<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class FacultyController extends Controller
{
    public function index()
    {
        $faculty = User::where('role', 'faculty')->get();
        $editFaculty = null;
        
        if (request()->has('edit')) {
            $editFaculty = User::where('id', request('edit'))->where('role', 'faculty')->first();
        }

        return view('admin.faculty.index', compact('faculty', 'editFaculty'));
    }

    public function create()
    {
        return redirect()->route('admin.faculty.index');
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
            'role' => 'faculty',
            'name' => $request->name,
            'email' => $request->email,
        ]);

        return redirect()->route('admin.faculty.index')->with('success', 'Faculty added successfully.');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|email|max:100',
        ]);

        $faculty = User::where('id', $id)->where('role', 'faculty')->firstOrFail();
        $faculty->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);

        return redirect()->route('admin.faculty.index')->with('success', 'Faculty updated.');
    }

    public function destroy($id)
    {
        $faculty = User::where('id', $id)->where('role', 'faculty')->firstOrFail();
        $faculty->delete();

        return redirect()->route('admin.faculty.index')->with('success', 'Faculty deleted.');
    }
}

