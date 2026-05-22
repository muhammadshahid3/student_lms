<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Notice;
use Illuminate\Http\Request;
use Illuminate\View\View;

class NoticeController extends Controller
{
    public function index(Request $request): View
    {
        $query = Notice::with('admin');

        if ($request->has('type') && $request->type !== '') {
            $query->where('type', $request->type);
        }

        $notices = $query->latest()->paginate(15);

        return view('admin.notices.index', compact('notices'));
    }

    public function create(): View
    {
        return view('admin.notices.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'type' => 'required|in:general,urgent,academic,event',
            'publish_date' => 'required|date',
            'expire_date' => 'nullable|date|after_or_equal:publish_date',
            'attachment' => 'nullable|file|mimes:pdf,doc,docx,jpg,jpeg,png,zip|max:5120',
        ]);

        $attachmentPath = null;
        if ($request->hasFile('attachment')) {
            $attachmentPath = $request->file('attachment')->store('notices', 'public');
        }

        Notice::create([
            'created_by' => auth()->user()->admin->id,
            'title' => $validated['title'],
            'content' => $validated['content'],
            'type' => $validated['type'],
            'publish_date' => $validated['publish_date'],
            'expire_date' => $validated['expire_date'],
            'attachment_path' => $attachmentPath,
        ]);

        return redirect()->route('admin.notices.index')->with('success', 'Notice created successfully.');
    }

    public function edit(Notice $notice): View
    {
        return view('admin.notices.edit', compact('notice'));
    }

    public function update(Request $request, Notice $notice)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'type' => 'required|in:general,urgent,academic,event',
            'publish_date' => 'required|date',
            'expire_date' => 'nullable|date|after_or_equal:publish_date',
            'attachment' => 'nullable|file|mimes:pdf,doc,docx,jpg,jpeg,png,zip|max:5120',
            'is_active' => 'required|boolean',
        ]);

        $attachmentPath = $notice->attachment_path;
        if ($request->hasFile('attachment')) {
            $attachmentPath = $request->file('attachment')->store('notices', 'public');
        }

        $notice->update([
            'title' => $validated['title'],
            'content' => $validated['content'],
            'type' => $validated['type'],
            'publish_date' => $validated['publish_date'],
            'expire_date' => $validated['expire_date'],
            'attachment_path' => $attachmentPath,
            'is_active' => $validated['is_active'],
        ]);

        return redirect()->route('admin.notices.index')->with('success', 'Notice updated successfully.');
    }

    public function destroy(Notice $notice)
    {
        $notice->delete();

        return redirect()->route('admin.notices.index')->with('success', 'Notice deleted successfully.');
    }
}
