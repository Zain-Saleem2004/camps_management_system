<?php

namespace App\Http\Controllers;

use App\Models\Camp;
use App\Models\User;
use App\Models\Supporter;
use App\Models\Message;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
{
    return view('dashboard.dashboard', [
        'section' => 'dashboard',
        'campsCount' => Camp::count(),
        'adminsCount' => User::where('role', 'admin')->count(),
        'representativesCount' => User::where('role', 'representative')->count(),
        'dataEntriesCount' => User::where('role', 'data_entry')->count(),
        'supportersCount' => Supporter::count(),
        'messagesCount' => Message::count(),
    ]);
}
}