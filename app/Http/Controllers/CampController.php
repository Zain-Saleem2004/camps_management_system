<?php

namespace App\Http\Controllers;

use App\Models\Camp;
use Illuminate\Http\Request;

class CampController extends Controller
{
    public function index()
    {
        $camps = Camp::latest()->get();

        return view('dashboard.dashboard', [
            'section' => 'camps',
            'camps' => $camps
        ]);
    }

    public function create()
    {
        return view('dashboard.camps.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required',
            'governorate' => 'required',
            'location' => 'required',
            'families_count' => 'required',
            'status' => 'required|in:active,inactive'
        ]);

        Camp::create($validated);

        return redirect()->route('camps.index')->with('success', 'تمت الإضافة');
    }

    public function show(Camp $camp)
    {
        $camps = Camp::latest()->get();

        return view('dashboard.dashboard', [
            'section' => 'camps',
            'subsection' => 'show-camp',
            'selectedCamp' => $camp,
            'camps' => $camps,
        ]);
    }

    public function edit(Camp $camp)
    {
        $camps = Camp::latest()->get();

        return view('dashboard.dashboard', [
            'section' => 'camps',
            'subsection' => 'edit-camp',
            'selectedCamp' => $camp,
            'camps' => $camps,
        ]);
    }

    public function update(Request $request, Camp $camp)
    {
        $validated = $request->validate([
            'name' => 'required',
            'governorate' => 'required',
            'location' => 'required',
            'families_count' => 'required',
            'status' => 'required|in:active,inactive',
        ]);

        $camp->update($validated);

        return redirect()->route('camps.index')->with('success', 'تم التعديل بنجاح');
    }

    public function destroy(Camp $camp)
    {
        $camp->delete();

        return back()->with('success', 'تم الحذف');
    }
}
