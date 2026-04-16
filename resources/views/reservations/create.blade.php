<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 dark:text-gray-200">Create a Parking Reservation</h2>
        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">Book your parking spot easily with our booking engine</p>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <form action="{{ route('reservations.store') }}" method="POST" class="space-y-8">
                @csrf

                <!-- Step 1: Select Parking Lot -->
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Step 1: Select Parking Lot</h3>
                    <div class="grid gap-4 md:grid-cols-2">
                        @foreach($parkinglots as $lot)
                            <label class="relative flex items-center p-4 border-2 border-gray-200 dark:border-gray-700 rounded-lg cursor-pointer hover:border-blue-500 dark:hover:border-blue-500 transition-colors"
                                   onclick="this.querySelector('input').checked = true">
                                <input type="radio" name="parking_lot_id" value="{{ $lot->id }}" class="hidden" required>
                                <div class="flex-1">
                                    <h4 class="font-semibold text-gray-900 dark:text-white">{{ $lot->name }}</h4>
                                    <p class="text-sm text-gray-600 dark:text-gray-400">{{ $lot->capacity }} spots available</p>
                                </div>
                                <div class="w-5 h-5 border-2 border-gray-300 rounded-full flex items-center justify-center">
                                    <div class="hidden w-3 h-3 bg-blue-600 rounded-full"></div>
                                </div>
                            </label>
                        @endforeach
                    </div>
                    @error('parking_lot_id') <span class="text-red-600 text-sm mt-2 block">{{ $message }}</span> @enderror
                </div>

                <!-- Step 2: Vehicle Information -->
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Step 2: Vehicle Information</h3>
                    
                    <div class="grid gap-4 md:grid-cols-2">
                        <div>
                            <label for="vehicle_type" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Vehicle Type *</label>
                            <select name="vehicle_type" id="vehicle_type" class="mt-1 block w-full rounded-md border border-gray-300 dark:border-gray-600 px-3 py-2 dark:bg-gray-700 dark:text-white" required>
                                <option value="">Select vehicle type</option>
                                <option value="Car" {{ old('vehicle_type') === 'Car' ? 'selected' : '' }}>🚗 Car</option>
                                <option value="SUV" {{ old('vehicle_type') === 'SUV' ? 'selected' : '' }}>🚙 SUV</option>
                                <option value="Motorcycle" {{ old('vehicle_type') === 'Motorcycle' ? 'selected' : '' }}>🏍️ Motorcycle</option>
                                <option value="Van" {{ old('vehicle_type') === 'Van' ? 'selected' : '' }}>🚐 Van</option>
                                <option value="Truck" {{ old('vehicle_type') === 'Truck' ? 'selected' : '' }}>🚚 Truck</option>
                            </select>
                            @error('vehicle_type') <span class="text-red-600 text-sm mt-1 block">{{ $message }}</span> @enderror
                        </div>

                        <div>
                            <label for="vehicle_make" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Make (Brand) *</label>
                            <input type="text" name="vehicle_make" id="vehicle_make" value="{{ old('vehicle_make') }}" placeholder="e.g., Toyota, Honda" class="mt-1 block w-full rounded-md border border-gray-300 dark:border-gray-600 px-3 py-2 dark:bg-gray-700 dark:text-white" required>
                            @error('vehicle_make') <span class="text-red-600 text-sm mt-1 block">{{ $message }}</span> @enderror
                        </div>

                        <div>
                            <label for="vehicle_model" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Model *</label>
                            <input type="text" name="vehicle_model" id="vehicle_model" value="{{ old('vehicle_model') }}" placeholder="e.g., Civic, Camry" class="mt-1 block w-full rounded-md border border-gray-300 dark:border-gray-600 px-3 py-2 dark:bg-gray-700 dark:text-white" required>
                            @error('vehicle_model') <span class="text-red-600 text-sm mt-1 block">{{ $message }}</span> @enderror
                        </div>

                        <div>
                            <label for="vehicle_color" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Color *</label>
                            <input type="text" name="vehicle_color" id="vehicle_color" value="{{ old('vehicle_color') }}" placeholder="e.g., Silver, Black" class="mt-1 block w-full rounded-md border border-gray-300 dark:border-gray-600 px-3 py-2 dark:bg-gray-700 dark:text-white" required>
                            @error('vehicle_color') <span class="text-red-600 text-sm mt-1 block">{{ $message }}</span> @enderror
                        </div>

                        <div>
                            <label for="license_plate_number" class="block text-sm font-medium text-gray-700 dark:text-gray-300">License Plate *</label>
                            <input type="text" name="license_plate_number" id="license_plate_number" value="{{ old('license_plate_number') }}" placeholder="e.g., ABC-1234" class="mt-1 block w-full rounded-md border border-gray-300 dark:border-gray-600 px-3 py-2 dark:bg-gray-700 dark:text-white uppercase" required>
                            @error('license_plate_number') <span class="text-red-600 text-sm mt-1 block">{{ $message }}</span> @enderror
                        </div>

                        <div>
                            <label for="plate_number" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Plate Number (Old) *</label>
                            <input type="text" name="plate_number" id="plate_number" value="{{ old('plate_number') }}" class="mt-1 block w-full rounded-md border border-gray-300 dark:border-gray-600 px-3 py-2 dark:bg-gray-700 dark:text-white" required>
                            @error('plate_number') <span class="text-red-600 text-sm mt-1 block">{{ $message }}</span> @enderror
                        </div>
                    </div>
                </div>

                <!-- Step 3: Reservation Details -->
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Step 3: Reservation Details</h3>
                    
                    <div class="grid gap-4 md:grid-cols-2">
                        <div>
                            <label for="reservation_date" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Date *</label>
                            <input type="date" name="reservation_date" id="reservation_date" value="{{ old('reservation_date') }}" min="{{ date('Y-m-d') }}" class="mt-1 block w-full rounded-md border border-gray-300 dark:border-gray-600 px-3 py-2 dark:bg-gray-700 dark:text-white" required>
                            @error('reservation_date') <span class="text-red-600 text-sm mt-1 block">{{ $message }}</span> @enderror
                        </div>

                        <div>
                            <label for="start_time" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Start Time *</label>
                            <input type="time" name="start_time" id="start_time" value="{{ old('start_time') }}" class="mt-1 block w-full rounded-md border border-gray-300 dark:border-gray-600 px-3 py-2 dark:bg-gray-700 dark:text-white" required>
                            @error('start_time') <span class="text-red-600 text-sm mt-1 block">{{ $message }}</span> @enderror
                        </div>

                        <div>
                            <label for="end_time" class="block text-sm font-medium text-gray-700 dark:text-gray-300">End Time *</label>
                            <input type="time" name="end_time" id="end_time" value="{{ old('end_time') }}" class="mt-1 block w-full rounded-md border border-gray-300 dark:border-gray-600 px-3 py-2 dark:bg-gray-700 dark:text-white" required>
                            @error('end_time') <span class="text-red-600 text-sm mt-1 block">{{ $message }}</span> @enderror
                        </div>

                        <div>
                            <label for="parking_slot" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Parking Slot *</label>
                            <input type="text" name="parking_slot" id="parking_slot" value="{{ old('parking_slot') }}" placeholder="e.g., C2-302" class="mt-1 block w-full rounded-md border border-gray-300 dark:border-gray-600 px-3 py-2 dark:bg-gray-700 dark:text-white" required>
                            @error('parking_slot') <span class="text-red-600 text-sm mt-1 block">{{ $message }}</span> @enderror
                        </div>
                    </div>
                </div>

                <!-- Step 4: Permit Type Selection -->
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Step 4: Permit Type</h3>
                    <div class="grid gap-4 md:grid-cols-3">
                        @foreach(['daily' => ['label' => 'Daily Permit', 'price' => 50, 'icon' => '📅'], 'weekly' => ['label' => 'Weekly Permit', 'price' => 300, 'icon' => '📆'], 'monthly' => ['label' => 'Monthly Permit', 'price' => 1000, 'icon' => '📋']] as $type => $details)
                            <label class="relative flex flex-col items-center p-4 border-2 border-gray-200 dark:border-gray-700 rounded-lg cursor-pointer hover:border-blue-500 dark:hover:border-blue-500 transition-colors"
                                   onclick="this.querySelector('input').checked = true; updateCost()">
                                <input type="radio" name="permit_type" value="{{ $type }}" class="hidden permit-radio" data-price="{{ $details['price'] }}" required>
                                <span class="text-4xl mb-2">{{ $details['icon'] }}</span>
                                <h4 class="font-semibold text-gray-900 dark:text-white text-center">{{ $details['label'] }}</h4>
                                <p class="text-sm text-gray-600 dark:text-gray-400 mt-2">₹{{ number_format($details['price']) }}</p>
                                <div class="mt-3 w-5 h-5 border-2 border-gray-300 rounded-full flex items-center justify-center">
                                    <div class="hidden w-3 h-3 bg-blue-600 rounded-full"></div>
                                </div>
                            </label>
                        @endforeach
                    </div>
                    @error('permit_type') <span class="text-red-600 text-sm mt-2 block">{{ $message }}</span> @enderror
                </div>

                <!-- Step 5: Payment Method -->
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Step 5: Payment Method</h3>
                    <div class="grid gap-4 md:grid-cols-2">
                        <label class="relative flex items-center p-4 border-2 border-gray-200 dark:border-gray-700 rounded-lg cursor-pointer hover:border-blue-500 dark:hover:border-blue-500 transition-colors"
                               onclick="this.querySelector('input').checked = true">
                            <input type="radio" name="payment_method" value="credit_card" class="hidden" required>
                            <span class="text-3xl mr-3">💳</span>
                            <div class="flex-1">
                                <h4 class="font-semibold text-gray-900 dark:text-white">Credit Card</h4>
                                <p class="text-sm text-gray-600 dark:text-gray-400">Visa, Mastercard, Amex</p>
                            </div>
                            <div class="w-5 h-5 border-2 border-gray-300 rounded-full flex items-center justify-center">
                                <div class="hidden w-3 h-3 bg-blue-600 rounded-full"></div>
                            </div>
                        </label>

                        <label class="relative flex items-center p-4 border-2 border-gray-200 dark:border-gray-700 rounded-lg cursor-pointer hover:border-blue-500 dark:hover:border-blue-500 transition-colors"
                               onclick="this.querySelector('input').checked = true">
                            <input type="radio" name="payment_method" value="upi" class="hidden" required>
                            <span class="text-3xl mr-3">📱</span>
                            <div class="flex-1">
                                <h4 class="font-semibold text-gray-900 dark:text-white">UPI</h4>
                                <p class="text-sm text-gray-600 dark:text-gray-400">Google Pay, PhonePe, BHIM</p>
                            </div>
                            <div class="w-5 h-5 border-2 border-gray-300 rounded-full flex items-center justify-center">
                                <div class="hidden w-3 h-3 bg-blue-600 rounded-full"></div>
                            </div>
                        </label>
                    </div>
                    @error('payment_method') <span class="text-red-600 text-sm mt-2 block">{{ $message }}</span> @enderror
                </div>

                <!-- Cost Display and Submit -->
                <div class="bg-blue-50 dark:bg-blue-900 border border-blue-200 dark:border-blue-700 overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <h3 class="text-lg font-semibold text-blue-900 dark:text-blue-100">Total Cost</h3>
                            <p id="cost-display" class="text-4xl font-bold text-blue-600 dark:text-blue-400 mt-2">₹0</p>
                        </div>
                        <input type="hidden" name="cost" id="cost-input" value="0">
                        <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 px-8 rounded-lg transition-colors">
                            Confirm & Book →
                        </button>
                    </div>
                </div>

                <!-- Notes -->
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Additional Notes (Optional)</h3>
                    <textarea name="notes" rows="3" class="w-full rounded-md border border-gray-300 dark:border-gray-600 px-3 py-2 dark:bg-gray-700 dark:text-white" placeholder="Any special requests or notes...">{{ old('notes') }}</textarea>
                </div>
            </form>
        </div>
    </div>

    <script>
        function updateCost() {
            const selected = document.querySelector('input[name="permit_type"]:checked');
            if (selected) {
                const price = selected.dataset.price;
                document.getElementById('cost-display').textContent = '₹' + new Intl.NumberFormat('en-IN').format(price);
                document.getElementById('cost-input').value = price;
            }
        }
        
        // Initialize on page load
        document.addEventListener('DOMContentLoaded', updateCost);
    </script>
</x-app-layout>