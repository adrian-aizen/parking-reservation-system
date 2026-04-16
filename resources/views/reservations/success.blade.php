<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 dark:text-gray-200">Booking Confirmed!</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <!-- Success Animation -->
            <div class="mb-8 flex justify-center">
                <div class="animate-bounce">
                    <div class="inline-flex items-center justify-center w-24 h-24 bg-green-100 dark:bg-green-900 rounded-full">
                        <svg class="w-16 h-16 text-green-600 dark:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Success Message -->
            <div class="text-center mb-8">
                <h1 class="text-4xl font-bold text-gray-900 dark:text-white mb-2">Reservation Successful!</h1>
                <p class="text-lg text-gray-600 dark:text-gray-400">Your parking slot has been confirmed. Here are the details:</p>
            </div>

            <!-- Booking Summary Card -->
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-lg sm:rounded-lg p-8 mb-6">
                <h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-6">Booking Summary</h2>
                
                <div class="grid md:grid-cols-2 gap-8">
                    <!-- Parking Details -->
                    <div class="border-r border-gray-200 dark:border-gray-700 pr-6">
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Parking Details</h3>
                        
                        <div class="space-y-4">
                            <div>
                                <p class="text-sm text-gray-600 dark:text-gray-400">Parking Slot</p>
                                <p class="text-2xl font-bold text-blue-600 dark:text-blue-400">{{ $reservation->parking_slot }}</p>
                            </div>

                            <div>
                                <p class="text-sm text-gray-600 dark:text-gray-400">Parking Lot</p>
                                <p class="text-lg font-semibold text-gray-900 dark:text-white">{{ $reservation->parkingLot->name }}</p>
                            </div>

                            <div>
                                <p class="text-sm text-gray-600 dark:text-gray-400">Date</p>
                                <p class="text-lg font-semibold text-gray-900 dark:text-white">{{ $reservation->reservation_date->format('M d, Y') }}</p>
                            </div>

                            <div>
                                <p class="text-sm text-gray-600 dark:text-gray-400">Time Slot</p>
                                <p class="text-lg font-semibold text-gray-900 dark:text-white">{{ $reservation->start_time }} - {{ $reservation->end_time }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Vehicle & Cost Details -->
                    <div>
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Vehicle & Payment</h3>
                        
                        <div class="space-y-4">
                            <div>
                                <p class="text-sm text-gray-600 dark:text-gray-400">Vehicle</p>
                                <p class="text-lg font-semibold text-gray-900 dark:text-white">{{ $reservation->vehicle_make }} {{ $reservation->vehicle_model }}</p>
                                <p class="text-sm text-gray-600 dark:text-gray-400">{{ $reservation->vehicle_color }} {{ $reservation->vehicle_type }}</p>
                            </div>

                            <div>
                                <p class="text-sm text-gray-600 dark:text-gray-400">License Plate</p>
                                <p class="text-lg font-semibold text-gray-900 dark:text-white font-mono">{{ $reservation->license_plate_number }}</p>
                            </div>

                            <div>
                                <p class="text-sm text-gray-600 dark:text-gray-400">Permit Type</p>
                                <p class="text-lg font-semibold text-gray-900 dark:text-white capitalize">{{ ucfirst($reservation->permit_type) }} Permit</p>
                            </div>

                            <div class="bg-green-50 dark:bg-green-900 p-4 rounded-lg">
                                <p class="text-sm text-gray-600 dark:text-gray-400">Total Cost</p>
                                <p class="text-3xl font-bold text-green-600 dark:text-green-400">₹{{ number_format($reservation->cost) }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Reservation ID -->
                <div class="mt-6 pt-6 border-t border-gray-200 dark:border-gray-700">
                    <p class="text-sm text-gray-600 dark:text-gray-400">Reservation ID</p>
                    <p class="text-lg font-mono text-gray-900 dark:text-white">#RES-{{ str_pad($reservation->id, 6, '0', STR_PAD_LEFT) }}</p>
                </div>
            </div>

            <!-- Payment Status -->
            <div class="bg-blue-50 dark:bg-blue-900 border border-blue-200 dark:border-blue-700 overflow-hidden shadow-sm sm:rounded-lg p-6 mb-6">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <svg class="h-6 w-6 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <div class="ml-3">
                        <p class="text-sm font-medium text-blue-900 dark:text-blue-100">
                            Payment Method: <strong class="capitalize">{{ str_replace('_', ' ', $reservation->payment_method) }}</strong>
                        </p>
                        <p class="text-sm text-blue-800 dark:text-blue-200 mt-1">
                            Status: <strong class="text-green-600 dark:text-green-400">{{ ucfirst($reservation->status) }}</strong>
                        </p>
                    </div>
                </div>
            </div>

            <!-- Important Information -->
            <div class="bg-yellow-50 dark:bg-yellow-900 border border-yellow-200 dark:border-yellow-700 overflow-hidden shadow-sm sm:rounded-lg p-6 mb-6">
                <h3 class="text-lg font-semibold text-yellow-900 dark:text-yellow-100 mb-4">Important Information</h3>
                <ul class="space-y-2 text-yellow-800 dark:text-yellow-200 text-sm">
                    <li>✓ Please arrive at least 15 minutes before your reservation time</li>
                    <li>✓ Keep your license plate and reservation ID handy</li>
                    <li>✓ Your parking slot will be held until 30 minutes after end time</li>
                    <li>✓ Extended parking will be charged at ₹20 per hour</li>
                    <li>✓ Please follow all parking lot rules and regulations</li>
                </ul>
            </div>

            <!-- Action Buttons -->
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="{{ route('reservations.show', $reservation) }}" class="inline-flex items-center justify-center px-6 py-3 border border-transparent text-base font-medium rounded-md shadow-sm text-white bg-blue-600 hover:bg-blue-700">
                    View Booking Details
                </a>
                <a href="{{ route('receipts.index') }}" class="inline-flex items-center justify-center px-6 py-3 border border-gray-300 dark:border-gray-600 text-base font-medium rounded-md shadow-sm text-gray-700 dark:text-gray-300 bg-white dark:bg-gray-800 hover:bg-gray-50 dark:hover:bg-gray-700">
                    View Receipts
                </a>
                <a href="{{ route('dashboard') }}" class="inline-flex items-center justify-center px-6 py-3 border border-gray-300 dark:border-gray-600 text-base font-medium rounded-md shadow-sm text-gray-700 dark:text-gray-300 bg-white dark:bg-gray-800 hover:bg-gray-50 dark:hover:bg-gray-700">
                    Back to Dashboard
                </a>
            </div>
        </div>
    </div>

    <style>
        @keyframes bounce {
            0%, 100% {
                transform: translateY(0);
            }
            50% {
                transform: translateY(-10px);
            }
        }
        .animate-bounce {
            animation: bounce 2s infinite;
        }
    </style>
</x-app-layout>
