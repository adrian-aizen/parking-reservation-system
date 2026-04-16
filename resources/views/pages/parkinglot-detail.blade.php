<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <a href="{{ route('dashboard') }}" class="text-blue-600 hover:text-blue-700 text-sm font-medium mb-2 inline-block">&larr; Back to Dashboard</a>
                <h2 class="font-semibold text-2xl text-gray-800 dark:text-gray-200 leading-tight">
                    {{ $parkinglot->name }}
                </h2>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <!-- Parking Lot Information -->
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-8">
                <div class="grid md:grid-cols-2 gap-8">
                    <!-- Left Column: Basic Info -->
                    <div class="space-y-6">
                        <div>
                            <h3 class="text-sm font-medium text-gray-500 dark:text-gray-400">Parking Lot Name</h3>
                            <p class="mt-2 text-2xl font-bold text-gray-900 dark:text-white">{{ $parkinglot->name }}</p>
                        </div>

                        <div>
                            <h3 class="text-sm font-medium text-gray-500 dark:text-gray-400">Total Capacity</h3>
                            <p class="mt-2 text-2xl font-bold text-blue-600">{{ $parkinglot->capacity }} spots</p>
                        </div>

                        <div>
                            <h3 class="text-sm font-medium text-gray-500 dark:text-gray-400">Created</h3>
                            <p class="mt-2 text-gray-700 dark:text-gray-300">{{ $parkinglot->created_at->format('M d, Y') }}</p>
                        </div>
                    </div>

                    <!-- Right Column: Statistics -->
                    <div class="space-y-6">
                        <div class="bg-gradient-to-br from-blue-50 to-blue-100 dark:from-blue-900 dark:to-blue-800 rounded-lg p-6">
                            <h3 class="text-sm font-medium text-blue-800 dark:text-blue-200">Reserved Spots</h3>
                            <p class="mt-2 text-4xl font-bold text-blue-600 dark:text-blue-400">{{ $reservationCount }}</p>
                            <p class="mt-1 text-sm text-blue-700 dark:text-blue-300">Reservations</p>
                        </div>

                        <div class="bg-gradient-to-br from-green-50 to-green-100 dark:from-green-900 dark:to-green-800 rounded-lg p-6">
                            <h3 class="text-sm font-medium text-green-800 dark:text-green-200">Available Spots</h3>
                            <p class="mt-2 text-4xl font-bold text-green-600 dark:text-green-400">{{ $availableSpots }}</p>
                            <p class="mt-1 text-sm text-green-700 dark:text-green-300">Open for reservation</p>
                        </div>

                        <div class="bg-gradient-to-br from-purple-50 to-purple-100 dark:from-purple-900 dark:to-purple-800 rounded-lg p-6">
                            <h3 class="text-sm font-medium text-purple-800 dark:text-purple-200">Occupancy Rate</h3>
                            <p class="mt-2 text-4xl font-bold text-purple-600 dark:text-purple-400">{{ $parkinglot->capacity > 0 ? round(($reservationCount / $parkinglot->capacity) * 100) : 0 }}%</p>
                            <div class="mt-3 w-full bg-purple-300 dark:bg-purple-700 rounded-full h-2">
                                <div class="bg-purple-600 dark:bg-purple-400 h-2 rounded-full" style="width: {{ $parkinglot->capacity > 0 ? round(($reservationCount / $parkinglot->capacity) * 100) : 0 }}%"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Reservation Section -->
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-8">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-6">Make a Reservation</h3>

                @if($availableSpots > 0)
                    <div class="bg-green-50 dark:bg-green-900 border border-green-200 dark:border-green-700 rounded-lg p-4 mb-6">
                        <p class="text-green-800 dark:text-green-200">
                            <strong>Good news!</strong> This parking lot has <strong>{{ $availableSpots }} available spots</strong> for reservation.
                        </p>
                    </div>

                    <div class="space-y-4">
                        <a href="{{ route('reservations.create') }}" class="inline-block w-full md:w-auto rounded-md bg-blue-600 px-6 py-3 text-center font-semibold text-white hover:bg-blue-700 transition-colors">
                            Reserve a Spot Now
                        </a>
                        <p class="text-sm text-gray-600 dark:text-gray-400">
                            Click the button above to proceed with your reservation at {{ $parkinglot->name }}.
                        </p>
                    </div>
                @else
                    <div class="bg-red-50 dark:bg-red-900 border border-red-200 dark:border-red-700 rounded-lg p-4">
                        <p class="text-red-800 dark:text-red-200">
                            <strong>Sorry!</strong> This parking lot is currently full. No spots are available for reservation at the moment.
                        </p>
                    </div>
                @endif
            </div>

            <!-- Recent Reservations -->
            @if($parkinglot->reservations()->exists())
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-8">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-6">Recent Reservations</h3>

                    <div class="overflow-x-auto">
                        <table class="w-full text-sm">
                            <thead class="bg-gray-50 dark:bg-gray-700">
                                <tr>
                                    <th class="px-4 py-3 text-left font-semibold text-gray-900 dark:text-white">Plate Number</th>
                                    <th class="px-4 py-3 text-left font-semibold text-gray-900 dark:text-white">Vehicle Type</th>
                                    <th class="px-4 py-3 text-left font-semibold text-gray-900 dark:text-white">Date</th>
                                    <th class="px-4 py-3 text-left font-semibold text-gray-900 dark:text-white">Time Slot</th>
                                    <th class="px-4 py-3 text-left font-semibold text-gray-900 dark:text-white">Parking Slot</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                                @foreach($parkinglot->reservations()->latest()->limit(10)->get() as $reservation)
                                    <tr class="hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors">
                                        <td class="px-4 py-3 text-gray-900 dark:text-gray-100">{{ $reservation->plate_number }}</td>
                                        <td class="px-4 py-3 text-gray-600 dark:text-gray-300">{{ $reservation->vehicle_type }}</td>
                                        <td class="px-4 py-3 text-gray-600 dark:text-gray-300">{{ $reservation->reservation_date->format('M d, Y') }}</td>
                                        <td class="px-4 py-3 text-gray-600 dark:text-gray-300">{{ $reservation->start_time }} - {{ $reservation->end_time }}</td>
                                        <td class="px-4 py-3 text-gray-600 dark:text-gray-300">{{ $reservation->parking_slot }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
