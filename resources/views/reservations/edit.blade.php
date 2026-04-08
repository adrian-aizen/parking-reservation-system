<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Reservation') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form action="{{ route('reservations.update', $reservation) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-4">
                            <label for="vehicle_type" class="block text-sm font-medium text-gray-700">Vehicle Type</label>
                            <input type="text" name="vehicle_type" id="vehicle_type" value="{{ old('vehicle_type', $reservation->vehicle_type) }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                            @error('vehicle_type') <span class="text-red-500">{{ $message }}</span> @enderror
                        </div>

                        <div class="mb-4">
                            <label for="plate_number" class="block text-sm font-medium text-gray-700">Plate Number</label>
                            <input type="text" name="plate_number" id="plate_number" value="{{ old('plate_number', $reservation->plate_number) }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                            @error('plate_number') <span class="text-red-500">{{ $message }}</span> @enderror
                        </div>

                        <div class="mb-4">
                            <label for="reservation_date" class="block text-sm font-medium text-gray-700">Reservation Date</label>
                            <input type="date" name="reservation_date" id="reservation_date" value="{{ old('reservation_date', $reservation->reservation_date->format('Y-m-d')) }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                            @error('reservation_date') <span class="text-red-500">{{ $message }}</span> @enderror
                        </div>

                        <div class="mb-4">
                            <label for="start_time" class="block text-sm font-medium text-gray-700">Start Time</label>
                            <input type="time" name="start_time" id="start_time" value="{{ old('start_time', $reservation->start_time) }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                            @error('start_time') <span class="text-red-500">{{ $message }}</span> @enderror
                        </div>

                        <div class="mb-4">
                            <label for="end_time" class="block text-sm font-medium text-gray-700">End Time</label>
                            <input type="time" name="end_time" id="end_time" value="{{ old('end_time', $reservation->end_time) }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                            @error('end_time') <span class="text-red-500">{{ $message }}</span> @enderror
                        </div>

                        <div class="mb-4">
                            <label for="parking_slot" class="block text-sm font-medium text-gray-700">Parking Slot</label>
                            <input type="text" name="parking_slot" id="parking_slot" value="{{ old('parking_slot', $reservation->parking_slot) }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                            @error('parking_slot') <span class="text-red-500">{{ $message }}</span> @enderror
                        </div>

                        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Update Reservation</button>
                        <a href="{{ route('reservations.index') }}" class="ml-4 text-gray-500">Cancel</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>