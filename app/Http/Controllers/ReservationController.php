<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use App\Models\ParkingLot;
use Illuminate\Http\Request;

class ReservationController extends Controller
{
    public function index()
    {
        $reservations = auth()->user()->reservations()->latest()->get();
        return view('reservations.index', compact('reservations'));
    }

    public function create()
    {
        $parkinglots = ParkingLot::all();
        return view('reservations.create', compact('parkinglots'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'parking_lot_id' => 'required|exists:parking_lots,id',
            'vehicle_type' => 'required|string',
            'vehicle_make' => 'required|string',
            'vehicle_model' => 'required|string',
            'license_plate_number' => 'required|string|unique:reservations',
            'vehicle_color' => 'required|string',
            'plate_number' => 'required|string',
            'permit_type' => 'required|in:daily,weekly,monthly',
            'reservation_date' => 'required|date|after_or_equal:today',
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i|after:start_time',
            'parking_slot' => 'required|string',
            'cost' => 'required|numeric|min:0',
            'payment_method' => 'required|in:credit_card,upi',
            'status' => 'required|in:pending,confirmed',
        ]);

        $validated['user_id'] = auth()->id();
        $reservation = Reservation::create($validated);

        return redirect()->route('reservations.success', $reservation)->with('success', 'Reservation created successfully.');
    }

    public function show(Reservation $reservation)
    {
        $this->authorize('view', $reservation);
        return view('reservations.show', compact('reservation'));
    }

    public function success(Reservation $reservation)
    {
        $this->authorize('view', $reservation);
        return view('reservations.success', compact('reservation'));
    }

    public function edit(Reservation $reservation)
    {
        $this->authorize('update', $reservation);
        $parkinglots = ParkingLot::all();
        return view('reservations.edit', compact('reservation', 'parkinglots'));
    }

    public function update(Request $request, Reservation $reservation)
    {
        $this->authorize('update', $reservation);

        $validated = $request->validate([
            'parking_lot_id' => 'required|exists:parking_lots,id',
            'vehicle_type' => 'required|string',
            'vehicle_make' => 'required|string',
            'vehicle_model' => 'required|string',
            'license_plate_number' => 'required|string|unique:reservations,license_plate_number,' . $reservation->id,
            'vehicle_color' => 'required|string',
            'plate_number' => 'required|string',
            'permit_type' => 'required|in:daily,weekly,monthly',
            'reservation_date' => 'required|date|after_or_equal:today',
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i|after:start_time',
            'parking_slot' => 'required|string',
            'cost' => 'required|numeric|min:0',
            'payment_method' => 'required|in:credit_card,upi',
            'status' => 'required|in:pending,confirmed,cancelled',
        ]);

        $reservation->update($validated);

        return redirect()->route('reservations.show', $reservation)->with('success', 'Reservation updated successfully.');
    }

    public function destroy(Reservation $reservation)
    {
        $this->authorize('delete', $reservation);
        $reservation->update(['status' => 'cancelled']);
        return redirect()->route('reservations.index')->with('success', 'Reservation cancelled successfully.');
    }

    public function receipts()
    {
        $receipts = auth()->user()->reservations()->latest()->get();
        return view('receipts.index', compact('receipts'));
    }

    // Admin Methods
    public function adminIndex()
    {
        $this->authorizeAdmin();
        $reservations = Reservation::latest()->paginate(15);
        return view('admin.reservations.index', compact('reservations'));
    }

    public function adminShow(Reservation $reservation)
    {
        $this->authorizeAdmin();
        return view('admin.reservations.show', compact('reservation'));
    }

    public function adminEdit(Reservation $reservation)
    {
        $this->authorizeAdmin();
        $parkinglots = ParkingLot::all();
        return view('admin.reservations.edit', compact('reservation', 'parkinglots'));
    }

    public function adminUpdate(Request $request, Reservation $reservation)
    {
        $this->authorizeAdmin();

        $validated = $request->validate([
            'parking_lot_id' => 'required|exists:parking_lots,id',
            'user_id' => 'required|exists:users,id',
            'vehicle_type' => 'required|string',
            'vehicle_make' => 'required|string',
            'vehicle_model' => 'required|string',
            'license_plate_number' => 'required|string|unique:reservations,license_plate_number,' . $reservation->id,
            'vehicle_color' => 'required|string',
            'plate_number' => 'required|string',
            'permit_type' => 'required|in:daily,weekly,monthly',
            'reservation_date' => 'required|date',
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i|after:start_time',
            'parking_slot' => 'required|string',
            'cost' => 'required|numeric|min:0',
            'payment_method' => 'required|in:credit_card,upi',
            'status' => 'required|in:pending,confirmed,cancelled',
            'notes' => 'nullable|string',
        ]);

        $reservation->update($validated);

        return redirect()->route('admin.reservations.show', $reservation)->with('success', 'Reservation updated successfully.');
    }

    public function adminDestroy(Reservation $reservation)
    {
        $this->authorizeAdmin();
        $reservation->delete();
        return redirect()->route('admin.reservations.index')->with('success', 'Reservation deleted successfully.');
    }

    private function authorizeAdmin()
    {
        if (!auth()->check() || !auth()->user()->isAdmin()) {
            abort(403, 'Unauthorized access');
        }
    }
}

