<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Reservation Details') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <p><strong>Vehicle Type:</strong> {{ $reservation->vehicle_type }}</p>
                    <p><strong>Plate Number:</strong> {{ $reservation->plate_number }}</p>
                    <p><strong>Reservation Date:</strong> {{ $reservation->reservation_date->format('Y-m-d') }}</p>
                    <p><strong>Start Time:</strong> {{ $reservation->start_time }}</p>
                    <p><strong>End Time:</strong> {{ $reservation->end_time }}</p>
                    <p><strong>Parking Slot:</strong> {{ $reservation->parking_slot }}</p>

                    <a href="{{ route('reservations.edit', $reservation) }}" class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-2 px-4 rounded mt-4 inline-block">Edit</a>
                    <a href="{{ route('reservations.index') }}" class="ml-4 bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded mt-4 inline-block">Back to List</a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>