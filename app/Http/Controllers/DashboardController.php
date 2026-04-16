<?php

namespace App\Http\Controllers;

use App\Models\ParkingLot;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $parkinglots = ParkingLot::all();
        $latestReservation = auth()->check() ? auth()->user()->reservations()->latest()->first() : null;

        return view('dashboard', compact('parkinglots', 'latestReservation'));
    }
}
