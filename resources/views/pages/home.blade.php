@extends('layouts.app')

@section('content')
    <div class="container mx-auto px-4 py-8">
        <div class="bg-white dark:bg-gray-800 shadow-sm rounded-lg p-6 mb-8">
            <h1 class="text-3xl font-bold text-gray-900 dark:text-white mb-4">Welcome to the Parking Reservation System</h1>
            <p class="text-lg text-gray-600 dark:text-gray-300 mb-4">Easily reserve your parking spot in advance and avoid the hassle of finding parking.</p>
            <a href="{{ route('reservations.index') }}" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">View My Reservations</a>
        </div>

        @if ($parkinglots->isEmpty())
            <div class="bg-gray-100 dark:bg-gray-900 border border-gray-200 dark:border-gray-700 rounded-lg p-6 text-gray-700 dark:text-gray-300">
                No parking lots are currently available.
            </div>
        @else
            <div class="grid gap-4 md:grid-cols-2 lg:grid-cols-3">
                @foreach ($parkinglots as $parkinglot)
                    <div class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-lg p-5">
                        <h2 class="text-xl font-semibold text-gray-900 dark:text-white">{{ $parkinglot->name }}</h2>
                        <p class="mt-2 text-gray-600 dark:text-gray-300">Capacity: {{ $parkinglot->capacity }}</p>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
@endsection