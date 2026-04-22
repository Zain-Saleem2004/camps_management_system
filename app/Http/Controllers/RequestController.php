<?php

namespace App\Http\Controllers;

use App\Models\Camp;
use App\Models\User;
use App\Models\Supporter;
use App\Models\Message;
use App\Models\RegistrationRequest;
use Illuminate\Http\Request;

class RequestController extends Controller
{
    private function getSharedData()
    {
        return [
            'campsCount' => Camp::count(),
            'adminsCount' => User::where('role', 'admin')->count(),
            'representativesCount' => User::where('role', 'representative')->count(),
            'dataEntriesCount' => User::where('role', 'data_entry')->count(),
            'supportersCount' => Supporter::count(),
            'messagesCount' => Message::count(),
            'camps' => Camp::all(),
            'requests' => RegistrationRequest::latest('created_at')->get(),
            'messages' => Message::latest('created_at')->get(),
        ];
    }

    public function index()
    {
        $data = $this->getSharedData();
        $data['section'] = 'requests';

        return view('dashboard.dashboard', $data);
    }

    public function show($id)
    {
        $data = $this->getSharedData();
        $data['selectedRequest'] = RegistrationRequest::findOrFail($id);
        $data['section'] = 'requests';
        $data['subsection'] = 'show-request';

        return view('dashboard.dashboard', $data);
    }

    public function approve($id)
    {
        $requestRecord = RegistrationRequest::findOrFail($id);
        $requestRecord->status = 'approved';
        $requestRecord->save();

        return redirect()->route('requests.show', $id)->with('success', 'تم قبول الطلب');
    }

    public function reject($id)
    {
        $requestRecord = RegistrationRequest::findOrFail($id);
        $requestRecord->status = 'rejected';
        $requestRecord->save();

        return redirect()->route('requests.show', $id)->with('success', 'تم رفض الطلب');
    }
}