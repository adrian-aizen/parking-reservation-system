<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="font-semibold text-2xl text-gray-800 dark:text-gray-200">Reservation Details</h2>
                <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">#RES-{{ str_pad($reservation->id, 6, '0', STR_PAD_LEFT) }}</p>
            </div>
            <a href="{{ route('admin.reservations.index') }}" class="text-blue-600 hover:text-blue-700 font-medium">← Back to List</a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <!-- User Information -->
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">User Information</h3>
                <div class="grid md:grid-cols-2 gap-6">
                    <div>
                        <p class="text-sm text-gray-600 dark:text-gray-400">Name</p>
                        <p class="text-lg font-semibold text-gray-900 dark:text-white">{{ $reservation->user->name }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-600 dark:text-gray-400">Email</p>
                        <p class="text-lg font-semibold text-gray-900 dark:text-white">{{ $reservation->user->email }}</p>
                    </div>
                </div>
            </div>

            <!-- Parking Details -->
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Parking Details</h3>
                <div class="grid md:grid-cols-3 gap-6">
                    <div>
                        <p class="text-sm text-gray-600 dark:text-gray-400">Parking Lot</p>
                        <p class="text-lg font-semibold text-gray-900 dark:text-white">{{ $reservation->parkingLot->name }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-600 dark:text-gray-400">Parking Slot</p>
                        <p class="text-2xl font-bold text-blue-600">{{ $reservation->parking_slot }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-600 dark:text-gray-400">Date</p>
                        <p class="text-lg font-semibold text-gray-900 dark:text-white">{{ $reservation->reservation_date->format('M d, Y') }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-600 dark:text-gray-400">Start Time</p>
                        <p class="text-lg font-semibold text-gray-900 dark:text-white">{{ $reservation->start_time }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-600 dark:text-gray-400">End Time</p>
                        <p class="text-lg font-semibold text-gray-900 dark:text-white">{{ $reservation->end_time }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-600 dark:text-gray-400">Duration</p>
                        <p class="text-lg font-semibold text-gray-900 dark:text-white">
                            @php
                                $start = \DateTime::createFromFormat('H:i:s', $reservation->start_time);
                                $end = \DateTime::createFromFormat('H:i:s', $reservation->end_time);
                                $diff = $start->diff($end);
                                echo $diff->format('%h hrs %i mins');
                            @endphp
                        </p>
                    </div>
                </div>
            </div>

            <!-- Vehicle Details -->
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Vehicle Details</h3>
                <div class="grid md:grid-cols-2 gap-6">
                    <div>
                        <p class="text-sm text-gray-600 dark:text-gray-400">Vehicle Type</p>
                        <p class="text-lg font-semibold text-gray-900 dark:text-white">{{ $reservation->vehicle_type }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-600 dark:text-gray-400">Make & Model</p>
                        <p class="text-lg font-semibold text-gray-900 dark:text-white">{{ $reservation->vehicle_make }} {{ $reservation->vehicle_model }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-600 dark:text-gray-400">Color</p>
                        <p class="text-lg font-semibold text-gray-900 dark:text-white">{{ $reservation->vehicle_color }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-600 dark:text-gray-400">License Plate</p>
                        <p class="text-lg font-mono font-semibold text-gray-900 dark:text-white">{{ $reservation->license_plate_number }}</p>
                    </div>
                </div>
            </div>

            <!-- Payment & Permit Details -->
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Payment & Permit</h3>
                <div class="grid md:grid-cols-3 gap-6">
                    <div>
                        <p class="text-sm text-gray-600 dark:text-gray-400">Permit Type</p>
                        <p class="text-lg font-semibold text-gray-900 dark:text-white capitalize">{{ ucfirst($reservation->permit_type) }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-600 dark:text-gray-400">Payment Method</p>
                        <p class="text-lg font-semibold text-gray-900 dark:text-white capitalize">{{ str_replace('_', ' ', $reservation->payment_method) }}</p>
                    </div>
                    <div class="bg-green-50 dark:bg-green-900 p-4 rounded-lg">
                        <p class="text-sm text-gray-600 dark:text-gray-400">Total Cost</p>
                        <p class="text-2xl font-bold text-green-600 dark:text-green-400">₹{{ number_format($reservation->cost) }}</p>
                    </div>
                </div>
            </div>

            <!-- Status -->
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Status</h3>
                <div class="flex items-center gap-4">
                    <span class="inline-flex items-center px-4 py-2 rounded-lg text-lg font-medium
                        @if($reservation->status === 'pending') bg-yellow-100 dark:bg-yellow-900 text-yellow-800 dark:text-yellow-200
                        @elseif($reservation->status === 'confirmed') bg-green-100 dark:bg-green-900 text-green-800 dark:text-green-200
                        @else bg-red-100 dark:bg-red-900 text-red-800 dark:text-red-200
                        @endif">
                        {{ ucfirst($reservation->status) }}
                    </span>
                    <a href="{{ route('admin.reservations.edit', $reservation) }}" class="text-blue-600 dark:text-blue-400 hover:underline">Edit Status</a>
                </div>
            </div>

            <!-- Notes -->
            @if($reservation->notes)
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Notes</h3>
                    <p class="text-gray-700 dark:text-gray-300">{{ $reservation->notes }}</p>
                </div>
            @endif

            <!-- Action Buttons -->
            <div class="flex gap-4 justify-end">
                <a href="{{ route('admin.reservations.edit', $reservation) }}" class="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-md shadow-sm text-white bg-blue-600 hover:bg-blue-700">
                    Edit Reservation
                </a>
                <form action="{{ route('admin.reservations.destroy', $reservation) }}" method="POST" class="inline" onclick="return confirm('Are you sure?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-md shadow-sm text-white bg-red-600 hover:bg-red-700">
                        Delete Reservation
                    </button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
