<?php

namespace App\Http\Controllers;

use App\Models\ParkingLot;
use Illuminate\Http\Request;

class ParkinglotController extends Controller
{
    public function index()
    {
        $parkinglots = ParkingLot::all();
        return view('pages.home', compact('parkinglots'));
    }

    public function store(Request $request)
    {
        abort_unless(auth()->user()->isAdmin(), 403);

        $request->validate([
            'name' => 'required|string|max:255',
            'capacity' => 'required|integer|min:1',
        ]);

        ParkingLot::create($request->only(['name', 'capacity']));

        return back()->with('success', 'Parking lot added successfully.');
    }

    public function show($id)
    {
        $parkinglot = ParkingLot::findOrFail($id);
        $reservationCount = $parkinglot->reservations()->count();
        $availableSpots = $parkinglot->capacity - $reservationCount;

        return view('pages.parkinglot-detail', compact('parkinglot', 'reservationCount', 'availableSpots'));
    }

    public function edit($id)
    {
        // Code to show a form for editing an existing parking lot
    }

    public function update(Request $request, $id)
    {
        // Code to update an existing parking lot in the database
    }

    public function destroy($id)
    {
        // Code to delete a parking lot from the database
    }

    // Admin Methods
    public function adminIndex()
    {
        $this->authorizeAdmin();
        $parkinglots = ParkingLot::withCount('reservations')->paginate(15);
        return view('admin.parkinglots.index', compact('parkinglots'));
    }

    public function adminEdit(ParkingLot $parkinglot)
    {
        $this->authorizeAdmin();
        return view('admin.parkinglots.edit', compact('parkinglot'));
    }

    public function adminUpdate(Request $request, ParkingLot $parkinglot)
    {
        $this->authorizeAdmin();

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'capacity' => 'required|integer|min:1',
        ]);

        $parkinglot->update($validated);

        return redirect()->route('admin.parkinglots.index')->with('success', 'Parking lot updated successfully.');
    }

    public function adminStore(Request $request)
    {
        $this->authorizeAdmin();

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'capacity' => 'required|integer|min:1',
        ]);

        ParkingLot::create($validated);

        return redirect()->route('admin.parkinglots.index')->with('success', 'Parking lot created successfully.');
    }

    public function adminDestroy(ParkingLot $parkinglot)
    {
        $this->authorizeAdmin();

        if ($parkinglot->reservations()->exists()) {
            return back()->with('error', 'Cannot delete parking lot with existing reservations.');
        }

        $parkinglot->delete();
        return redirect()->route('admin.parkinglots.index')->with('success', 'Parking lot deleted successfully.');
    }

    private function authorizeAdmin()
    {
        if (!auth()->check() || !auth()->user()->isAdmin()) {
            abort(403, 'Unauthorized access');
        }
    }
}

