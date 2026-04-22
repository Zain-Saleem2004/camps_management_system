<?php

namespace App\Http\Controllers;

use App\Models\Camp;
use App\Models\Representative;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class RepresentativeController extends Controller
{
    use Traits\DashboardData;
    public function create()
    {
        $camps = Camp::doesntHave('representative')->get();

        return view('representatives.create', compact('camps'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'camp_id' => 'required|exists:camps,id|unique:representatives,camp_id',
            'name' => 'required|string|max:100',
            'email' => 'required|email|max:150|unique:users,email|unique:representatives,email',
            'password' => 'required|string|min:8',
            'phone' => 'nullable|string|max:20',
            'gender' => 'nullable|string|max:20',
            'national_id_no' => 'required|string|max:20',
            'governorate' => 'required|string|max:100',
        ]);

        DB::transaction(function () use ($validated) {
            $hashedPassword = Hash::make($validated['password']);

            $user = User::create([
                'name' => $validated['name'],
                'email' => $validated['email'],
                'password' => $hashedPassword,
                'role' => 'representative',
                'is_active' => true,
                'phone' => $validated['phone'] ?? null,
            ]);

            Representative::create([
                'user_id' => $user->id,
                'camp_id' => $validated['camp_id'],
                'name' => $validated['name'],
                'email' => $validated['email'],
                'password' => $hashedPassword,
                'phone' => $validated['phone'] ?? null,
                'gender' => $validated['gender'] ?? null,
                'national_id_no' => $validated['national_id_no'],
                'governorate' => $validated['governorate'],
                'status' => 'active',
            ]);
        });

        return redirect()->back()->with('success', 'تم إضافة المندوب بنجاح');
    }

    public function showByCamp(Camp $camp)
    {
        $camp->load('representative');

        return view('dashboard.dashboard', array_merge(
            $this->dashboardData(),
            [
                'section' => 'camps',
                'subsection' => 'delegate-upload',
                'selectedCamp' => $camp,
                'representative' => $camp->representative
            ]
        ));
    }
}
