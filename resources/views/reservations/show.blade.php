<x-app-layout>
    <div class="py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <a href="{{ route('reservations.index') }}" class="inline-flex items-center gap-1 text-sm text-gray-500 hover:text-teal-600 mb-6 transition">
                ← Back to reservations
            </a>

            <div class="max-w-2xl mx-auto">
                <div class="bg-white rounded-2xl border border-gray-200 p-8 shadow-sm">

                    {{-- Header --}}
                    <div class="flex items-start justify-between mb-6">
                        <div>
                            <h1 class="text-xl font-bold text-gray-900">{{ $reservation->parkingLot->name ?? 'Parking Lot' }}</h1>
                            <p class="text-sm text-gray-500 mt-0.5">Reservation #{{ $reservation->id }}</p>
                        </div>
                        
                        {{-- Status Badge --}}
                        @if($reservation->status === 'confirmed')
                            <span class="px-3 py-1.5 rounded-full text-sm font-medium bg-teal-100 text-teal-700">Confirmed</span>
                        @elseif($reservation->status === 'pending')
                            <span class="px-3 py-1.5 rounded-full text-sm font-medium bg-amber-100 text-amber-700">Pending</span>
                        @else
                            <span class="px-3 py-1.5 rounded-full text-sm font-medium bg-red-100 text-red-600">{{ ucfirst($reservation->status ?? 'Cancelled') }}</span>
                        @endif
                    </div>

                    {{-- Detail rows --}}
                    <div class="divide-y divide-gray-100">
                        @php
                            $details = [
                                ['Date', \Carbon\Carbon::parse($reservation->reservation_date)->format('F d, Y')],
                                ['Time', $reservation->start_time . ' – ' . $reservation->end_time],
                                ['Parking Slot', $reservation->parking_slot],
                                ['Vehicle Type', $reservation->vehicle_type],
                                ['Plate Number', $reservation->plate_number],
                            ];
                        @endphp

                        @foreach($details as [$label, $value])
                        <div class="flex justify-between py-3 text-sm">
                            <span class="text-gray-500">{{ $label }}</span>
                            <span class="font-medium text-gray-900">{{ $value }}</span>
                        </div>
                        @endforeach
                    </div>

                    {{-- Actions --}}
                    @if($reservation->status !== 'cancelled')
                    <div class="flex gap-3 mt-8">
                        <a href="{{ route('reservations.edit', $reservation) }}"
                           class="flex-1 text-center border border-gray-300 hover:border-teal-400 text-gray-700 hover:text-teal-700 font-medium py-2.5 rounded-xl transition text-sm">
                            Edit Reservation
                        </a>
                        <form method="POST" action="{{ route('reservations.destroy', $reservation) }}"
                              onsubmit="return confirm('Are you sure you want to cancel?')" class="flex-1">
                            @csrf 
                            @method('DELETE')
                            <button type="submit"
                                    class="w-full bg-red-50 hover:bg-red-100 text-red-600 font-medium py-2.5 rounded-xl transition text-sm">
                                Cancel Reservation
                            </button>
                        </form>
                    </div>
                    @else
                    <p class="mt-8 text-center text-sm text-gray-400">This reservation has been cancelled.</p>
                    @endif

                </div>
            </div>

        </div>
    </div>
</x-app-layout>