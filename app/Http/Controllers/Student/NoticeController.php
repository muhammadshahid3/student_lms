<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Notice;
use Illuminate\View\View;

class NoticeController extends Controller
{
    public function index(): View
    {
        $notices = Notice::where('is_active', true)
            ->where(function ($query) {
                $query->whereNull('expire_date')
                      ->orWhere('expire_date', '>=', now());
            })
            ->where('publish_date', '<=', now())
            ->latest()
            ->paginate(15);

        return view('student.notices.index', compact('notices'));
    }

    public function show(Notice $notice): View
    {
        if (!$notice->is_active || ($notice->expire_date && $notice->expire_date < now())) {
            abort(404);
        }

        $notice->incrementViews();

        return view('student.notices.show', compact('notice'));
    }
}
