<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactMessage;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $totalMessages = ContactMessage::count();
        $todayMessages = ContactMessage::whereDate('created_at', Carbon::today())->count();
        $recentMessages = ContactMessage::latest()->take(5)->get();

        return view('admin.dashboard', compact('totalMessages', 'todayMessages', 'recentMessages'));
    }
}
