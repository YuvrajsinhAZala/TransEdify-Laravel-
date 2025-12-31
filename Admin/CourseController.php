<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Course;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    public function index()
    {
        $courses = Course::all();
        $editCourse = null;
        
        if (request()->has('edit')) {
            $editCourse = Course::find(request('edit'));
        }

        return view('admin.courses.index', compact('courses', 'editCourse'));
    }

    public function create()
    {
        return redirect()->route('admin.courses.index');
    }

    public function store(Request $request)
    {
        $request->validate([
            'course_code' => 'required|string|max:20|unique:courses',
            'course_name' => 'required|string|max:100',
            'description' => 'nullable|string',
        ]);

        Course::create($request->all());

        return redirect()->route('admin.courses.index')->with('success', 'Course added successfully.');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'course_name' => 'required|string|max:100',
            'description' => 'nullable|string',
        ]);

        $course = Course::findOrFail($id);
        $course->update([
            'course_name' => $request->course_name,
            'description' => $request->description,
        ]);

        return redirect()->route('admin.courses.index')->with('success', 'Course updated.');
    }

    public function destroy($id)
    {
        $course = Course::findOrFail($id);
        $course->delete();

        return redirect()->route('admin.courses.index')->with('success', 'Course deleted.');
    }
}

