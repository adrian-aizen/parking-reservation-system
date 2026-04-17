<x-app-layout>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        
        <a href="{{ route('home') }}" class="inline-flex items-center gap-1 text-sm text-gray-500 hover:text-teal-600 mb-6 transition">
            ← Back to all lots
        </a>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            
            {{-- Left: lot info (spans 2 cols) --}}
            <div class="lg:col-span-2 space-y-6">
                
                <div class="bg-white rounded-2xl border border-gray-200 p-6">
                    <h1 class="text-2xl font-bold text-gray-900 mb-1">{{ $parkinglot->name }}</h1>
                    <p class="text-sm text-gray-500">Capacity: {{ $parkinglot->capacity }} spots</p>
                    
                    <div class="mt-6 grid grid-cols-2 gap-4">
                        <div class="bg-gray-50 rounded-xl p-4">
                            <p class="text-xs text-gray-500 uppercase tracking-wide font-medium">Available</p>
                            <p class="text-3xl font-bold text-teal-600 mt-1">{{ $availableSpots }}</p>
                        </div>
                        <div class="bg-gray-50 rounded-xl p-4">
                            <p class="text-xs text-gray-500 uppercase tracking-wide font-medium">Reserved</p>
                            <p class="text-3xl font-bold text-gray-700 mt-1">{{ $reservationCount }}</p>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-2xl border border-gray-200 p-6">
                    <h2 class="font-semibold text-gray-900 mb-4">Spot availability</h2>
                    
                    <div class="flex flex-wrap gap-2">
                        @for($i = 1; $i <= min($parkinglot->capacity, 60); $i++)
                            @if($i <= $reservationCount)
                                <div class="w-8 h-8 rounded-md bg-red-100 border border-red-200 flex items-center justify-center text-xs text-red-400 font-medium">
                                    {{ $i }}
                                </div>
                            @else
                                <div class="w-8 h-8 rounded-md bg-teal-50 border border-teal-200 flex items-center justify-center text-xs text-teal-600 font-medium">
                                    {{ $i }}
                                </div>
                            @endif
                        @endfor
                        
                        @if($parkinglot->capacity > 60)
                            <div class="w-auto px-3 h-8 rounded-md bg-gray-100 flex items-center text-xs text-gray-500">
                                +{{ $parkinglot->capacity - 60 }} more
                            </div>
                        @endif
                    </div>
                    
                    <div class="flex gap-4 mt-4 text-xs text-gray-500">
                        <span class="flex items-center gap-1">
                            <span class="w-3 h-3 rounded-sm bg-teal-100 border border-teal-200 inline-block"></span> Available
                        </span>
                        <span class="flex items-center gap-1">
                            <span class="w-3 h-3 rounded-sm bg-red-100 border border-red-200 inline-block"></span> Reserved
                        </span>
                    </div>
                </div>

                @if($parkinglot->reservations()->exists())
                    <div class="bg-white rounded-2xl border border-gray-200 p-6">
                        <h3 class="font-semibold text-gray-900 mb-4">Recent Reservations</h3>

                        <div class="overflow-x-auto">
                            <table class="w-full text-sm">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th class="px-4 py-3 text-left font-semibold text-gray-900 rounded-l-lg">Plate Number</th>
                                        <th class="px-4 py-3 text-left font-semibold text-gray-900">Vehicle Type</th>
                                        <th class="px-4 py-3 text-left font-semibold text-gray-900">Date</th>
                                        <th class="px-4 py-3 text-left font-semibold text-gray-900">Time Slot</th>
                                        <th class="px-4 py-3 text-left font-semibold text-gray-900 rounded-r-lg">Parking Slot</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-100">
                                    @foreach($parkinglot->reservations()->latest()->limit(10)->get() as $reservation)
                                        <tr class="hover:bg-gray-50 transition-colors">
                                            <td class="px-4 py-3 text-gray-900">{{ $reservation->plate_number }}</td>
                                            <td class="px-4 py-3 text-gray-500">{{ $reservation->vehicle_type }}</td>
                                            <td class="px-4 py-3 text-gray-500">{{ $reservation->reservation_date->format('M d, Y') }}</td>
                                            <td class="px-4 py-3 text-gray-500">{{ $reservation->start_time }} - {{ $reservation->end_time }}</td>
                                            <td class="px-4 py-3 text-gray-500">{{ $reservation->parking_slot }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                @endif

            </div>

            {{-- Right: booking card --}}
            <div class="lg:col-span-1">
                <div class="sticky top-24">
                    <div class="bg-white rounded-2xl border border-gray-200 p-6 shadow-sm">
                        <h2 class="font-semibold text-gray-900 mb-1">Reserve a spot</h2>
                        <p class="text-sm text-gray-500 mb-5">at {{ $parkinglot->name }}</p>
                        
                        <div class="space-y-3 mb-6">
                            <div class="flex justify-between text-sm">
                                <span class="text-gray-500">Daily</span>
                                <span class="font-medium text-gray-900">₱ 50.00</span>
                            </div>
                            <div class="flex justify-between text-sm">
                                <span class="text-gray-500">Weekly</span>
                                <span class="font-medium text-gray-900">₱ 300.00</span>
                            </div>
                            <div class="flex justify-between text-sm">
                                <span class="text-gray-500">Monthly</span>
                                <span class="font-medium text-gray-900">₱ 1,000.00</span>
                            </div>
                        </div>

                        @if($availableSpots > 0)
                            <a href="{{ route('reservations.create', ['parking_lot_id' => $parkinglot->id]) }}"
                               class="block text-center bg-teal-600 hover:bg-teal-700 text-white font-semibold py-3 rounded-xl transition">
                                Book Now
                            </a>
                        @else
                            <button disabled
                                    class="w-full bg-gray-100 text-gray-400 font-semibold py-3 rounded-xl cursor-not-allowed">
                                Lot Full
                            </button>
                        @endif
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>