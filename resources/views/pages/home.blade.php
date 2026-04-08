@extends('app')

@section('content')
    <div class="container mx-auto px-4 py-8 bg-black">
        <h1 class="text-3xl text-black font-bold mb-6">Welcome to the Parking Reservation System</h1>
        <p class="text-lg text-gray-300 mb-4">Easily reserve your parking spot in advance and avoid the hassle of finding parking.</p>
        <a href="{{ route('reservations.index') }}" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">View My Reservations</a>
    </div>
@endsection