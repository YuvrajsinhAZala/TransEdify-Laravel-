<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Fee;
use App\Models\User;
use Illuminate\Http\Request;

class FeeController extends Controller
{
    public function index()
    {
        $fees = Fee::with('student')->orderBy('created_at', 'desc')->get();
        $students = User::where('role', 'student')->orderBy('name')->get();
        $editFee = null;
        
        if (request()->has('edit')) {
            $editFee = Fee::find(request('edit'));
        }

        return view('admin.fees.index', compact('fees', 'students', 'editFee'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'student_id' => 'required|exists:users,id',
            'amount' => 'required|numeric|min:0',
            'status' => 'required|in:paid,unpaid',
            'due_date' => 'required|date',
            'description' => 'nullable|string',
        ]);

        Fee::create($request->all());

        return redirect()->route('admin.fees.index')->with('success', 'Fee assigned.');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'student_id' => 'required|exists:users,id',
            'amount' => 'required|numeric|min:0',
            'status' => 'required|in:paid,unpaid',
            'due_date' => 'required|date',
            'description' => 'nullable|string',
        ]);

        $fee = Fee::findOrFail($id);
        $fee->update($request->all());

        return redirect()->route('admin.fees.index')->with('success', 'Fee updated.');
    }

    public function destroy($id)
    {
        $fee = Fee::findOrFail($id);
        $fee->delete();

        return redirect()->route('admin.fees.index')->with('success', 'Fee deleted.');
    }
}

