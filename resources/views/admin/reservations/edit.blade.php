<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-2xl text-gray-800 dark:text-gray-200">Edit Reservation</h2>
            <a href="{{ route('admin.reservations.show', $reservation) }}" class="text-blue-600 hover:text-blue-700 font-medium">← Back to Details</a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                <form action="{{ route('admin.reservations.update', $reservation) }}" method="POST" class="space-y-8">
                    @csrf
                    @method('PATCH')

                    <!-- User Selection -->
                    <div>
                        <label for="user_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300">User</label>
                        <select name="user_id" id="user_id" class="mt-1 block w-full rounded-md border border-gray-300 dark:border-gray-600 px-3 py-2 dark:bg-gray-700 dark:text-white" required>
                            @foreach(\App\Models\User::all() as $user)
                                <option value="{{ $user->id }}" {{ $reservation->user_id === $user->id ? 'selected' : '' }}>{{ $user->name }} ({{ $user->email }})</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Parking Lot Selection -->
                    <div>
                        <label for="parking_lot_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Parking Lot</label>
                        <select name="parking_lot_id" id="parking_lot_id" class="mt-1 block w-full rounded-md border border-gray-300 dark:border-gray-600 px-3 py-2 dark:bg-gray-700 dark:text-white" required>
                            @foreach($parkinglots as $lot)
                                <option value="{{ $lot->id }}" {{ $reservation->parking_lot_id === $lot->id ? 'selected' : '' }}>{{ $lot->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Vehicle Information -->
                    <div class="border-t border-gray-200 dark:border-gray-700 pt-6">
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Vehicle Information</h3>
                        <div class="grid md:grid-cols-2 gap-4">
                            <div>
                                <label for="vehicle_type" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Vehicle Type</label>
                                <input type="text" name="vehicle_type" id="vehicle_type" value="{{ $reservation->vehicle_type }}" class="mt-1 block w-full rounded-md border border-gray-300 dark:border-gray-600 px-3 py-2 dark:bg-gray-700 dark:text-white" required>
                            </div>
                            <div>
                                <label for="vehicle_make" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Make</label>
                                <input type="text" name="vehicle_make" id="vehicle_make" value="{{ $reservation->vehicle_make }}" class="mt-1 block w-full rounded-md border border-gray-300 dark:border-gray-600 px-3 py-2 dark:bg-gray-700 dark:text-white" required>
                            </div>
                            <div>
                                <label for="vehicle_model" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Model</label>
                                <input type="text" name="vehicle_model" id="vehicle_model" value="{{ $reservation->vehicle_model }}" class="mt-1 block w-full rounded-md border border-gray-300 dark:border-gray-600 px-3 py-2 dark:bg-gray-700 dark:text-white" required>
                            </div>
                            <div>
                                <label for="vehicle_color" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Color</label>
                                <input type="text" name="vehicle_color" id="vehicle_color" value="{{ $reservation->vehicle_color }}" class="mt-1 block w-full rounded-md border border-gray-300 dark:border-gray-600 px-3 py-2 dark:bg-gray-700 dark:text-white" required>
                            </div>
                            <div>
                                <label for="license_plate_number" class="block text-sm font-medium text-gray-700 dark:text-gray-300">License Plate</label>
                                <input type="text" name="license_plate_number" id="license_plate_number" value="{{ $reservation->license_plate_number }}" class="mt-1 block w-full rounded-md border border-gray-300 dark:border-gray-600 px-3 py-2 dark:bg-gray-700 dark:text-white uppercase" required>
                            </div>
                            <div>
                                <label for="plate_number" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Plate Number</label>
                                <input type="text" name="plate_number" id="plate_number" value="{{ $reservation->plate_number }}" class="mt-1 block w-full rounded-md border border-gray-300 dark:border-gray-600 px-3 py-2 dark:bg-gray-700 dark:text-white" required>
                            </div>
                        </div>
                    </div>

                    <!-- Reservation Details -->
                    <div class="border-t border-gray-200 dark:border-gray-700 pt-6">
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Reservation Details</h3>
                        <div class="grid md:grid-cols-2 gap-4">
                            <div>
                                <label for="reservation_date" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Date</label>
                                <input type="date" name="reservation_date" id="reservation_date" value="{{ $reservation->reservation_date->format('Y-m-d') }}" class="mt-1 block w-full rounded-md border border-gray-300 dark:border-gray-600 px-3 py-2 dark:bg-gray-700 dark:text-white" required>
                            </div>
                            <div>
                                <label for="start_time" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Start Time</label>
                                <input type="time" name="start_time" id="start_time" value="{{ $reservation->start_time }}" class="mt-1 block w-full rounded-md border border-gray-300 dark:border-gray-600 px-3 py-2 dark:bg-gray-700 dark:text-white" required>
                            </div>
                            <div>
                                <label for="end_time" class="block text-sm font-medium text-gray-700 dark:text-gray-300">End Time</label>
                                <input type="time" name="end_time" id="end_time" value="{{ $reservation->end_time }}" class="mt-1 block w-full rounded-md border border-gray-300 dark:border-gray-600 px-3 py-2 dark:bg-gray-700 dark:text-white" required>
                            </div>
                            <div>
                                <label for="parking_slot" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Parking Slot</label>
                                <input type="text" name="parking_slot" id="parking_slot" value="{{ $reservation->parking_slot }}" class="mt-1 block w-full rounded-md border border-gray-300 dark:border-gray-600 px-3 py-2 dark:bg-gray-700 dark:text-white" required>
                            </div>
                        </div>
                    </div>

                    <!-- Payment Details -->
                    <div class="border-t border-gray-200 dark:border-gray-700 pt-6">
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Payment Details</h3>
                        <div class="grid md:grid-cols-3 gap-4">
                            <div>
                                <label for="permit_type" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Permit Type</label>
                                <select name="permit_type" id="permit_type" class="mt-1 block w-full rounded-md border border-gray-300 dark:border-gray-600 px-3 py-2 dark:bg-gray-700 dark:text-white" required>
                                    <option value="daily" {{ $reservation->permit_type === 'daily' ? 'selected' : '' }}>Daily</option>
                                    <option value="weekly" {{ $reservation->permit_type === 'weekly' ? 'selected' : '' }}>Weekly</option>
                                    <option value="monthly" {{ $reservation->permit_type === 'monthly' ? 'selected' : '' }}>Monthly</option>
                                </select>
                            </div>
                            <div>
                                <label for="cost" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Cost (₹)</label>
                                <input type="number" name="cost" id="cost" step="0.01" min="0" value="{{ $reservation->cost }}" class="mt-1 block w-full rounded-md border border-gray-300 dark:border-gray-600 px-3 py-2 dark:bg-gray-700 dark:text-white" required>
                            </div>
                            <div>
                                <label for="payment_method" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Payment Method</label>
                                <select name="payment_method" id="payment_method" class="mt-1 block w-full rounded-md border border-gray-300 dark:border-gray-600 px-3 py-2 dark:bg-gray-700 dark:text-white" required>
                                    <option value="credit_card" {{ $reservation->payment_method === 'credit_card' ? 'selected' : '' }}>Credit Card</option>
                                    <option value="upi" {{ $reservation->payment_method === 'upi' ? 'selected' : '' }}>UPI</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <!-- Status & Notes -->
                    <div class="border-t border-gray-200 dark:border-gray-700 pt-6">
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Status & Notes</h3>
                        <div class="space-y-4">
                            <div>
                                <label for="status" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Status</label>
                                <select name="status" id="status" class="mt-1 block w-full rounded-md border border-gray-300 dark:border-gray-600 px-3 py-2 dark:bg-gray-700 dark:text-white" required>
                                    <option value="pending" {{ $reservation->status === 'pending' ? 'selected' : '' }}>Pending</option>
                                    <option value="confirmed" {{ $reservation->status === 'confirmed' ? 'selected' : '' }}>Confirmed</option>
                                    <option value="cancelled" {{ $reservation->status === 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                                </select>
                            </div>
                            <div>
                                <label for="notes" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Notes</label>
                                <textarea name="notes" id="notes" rows="4" class="mt-1 block w-full rounded-md border border-gray-300 dark:border-gray-600 px-3 py-2 dark:bg-gray-700 dark:text-white">{{ $reservation->notes }}</textarea>
                            </div>
                        </div>
                    </div>

                    <!-- Submit Buttons -->
                    <div class="flex gap-4 border-t border-gray-200 dark:border-gray-700 pt-6">
                        <button type="submit" class="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-md shadow-sm text-white bg-blue-600 hover:bg-blue-700">
                            Save Changes
                        </button>
                        <a href="{{ route('admin.reservations.show', $reservation) }}" class="inline-flex items-center px-6 py-3 border border-gray-300 dark:border-gray-600 text-base font-medium rounded-md shadow-sm text-gray-700 dark:text-gray-300 bg-white dark:bg-gray-800 hover:bg-gray-50 dark:hover:bg-gray-700">
                            Cancel
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
