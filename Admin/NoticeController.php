<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Notice;
use Illuminate\Http\Request;

class NoticeController extends Controller
{
    public function index()
    {
        $notices = Notice::orderBy('created_at', 'desc')->get();
        $editNotice = null;
        
        if (request()->has('edit')) {
            $editNotice = Notice::find(request('edit'));
        }

        return view('admin.notices.index', compact('notices', 'editNotice'));
    }

    public function create()
    {
        return redirect()->route('admin.notices.index');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        Notice::create($request->all());

        return redirect()->route('admin.notices.index')->with('success', 'Notice posted successfully!');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        $notice = Notice::findOrFail($id);
        $notice->update($request->all());

        return redirect()->route('admin.notices.index')->with('success', 'Notice updated.');
    }

    public function destroy($id)
    {
        $notice = Notice::findOrFail($id);
        $notice->delete();

        return redirect()->route('admin.notices.index')->with('success', 'Notice deleted.');
    }
}

