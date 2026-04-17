<x-app-layout>
    <div class="py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <div class="flex items-center justify-between mb-8">
                <div>
                    <h1 class="text-2xl font-bold text-gray-900">My Reservations</h1>
                    <p class="text-sm text-gray-500 mt-1">Manage all your parking bookings.</p>
                </div>
                <a href="{{ route('reservations.create') }}"
                   class="bg-teal-600 hover:bg-teal-700 text-white text-sm font-medium px-4 py-2.5 rounded-xl transition">
                    + New Reservation
                </a>
            </div>

            @if (session('success'))
                <div class="mb-6 p-4 bg-teal-50 border border-teal-200 text-teal-700 rounded-xl text-sm">
                    {{ session('success') }}
                </div>
            @endif
            
            @if (session('error'))
                <div class="mb-6 p-4 bg-red-50 border border-red-200 text-red-600 rounded-xl text-sm">
                    {{ session('error') }}
                </div>
            @endif

            <div class="space-y-4">
                @forelse($reservations as $reservation)
                <div class="bg-white rounded-2xl border border-gray-200 p-5 flex flex-col sm:flex-row sm:items-center justify-between gap-4 transition hover:shadow-sm">

                    <div class="flex items-start gap-4">
                        <div class="w-10 h-10 rounded-xl bg-teal-50 border border-teal-100 flex items-center justify-center text-lg shrink-0">🅿</div>
                        <div>
                            <p class="font-semibold text-gray-900">{{ $reservation->parkingLot->name ?? 'Parking Lot' }}</p>
                            <p class="text-sm text-gray-500 mt-0.5">
                                Slot {{ $reservation->parking_slot }} &middot;
                                {{ \Carbon\Carbon::parse($reservation->reservation_date)->format('M d, Y') }} &middot;
                                {{ $reservation->start_time }} – {{ $reservation->end_time }}
                            </p>
                            <p class="text-xs text-gray-400 mt-1">{{ $reservation->vehicle_type }} · {{ $reservation->plate_number }}</p>
                        </div>
                    </div>

                    <div class="flex items-center gap-3 shrink-0">
                        
                        {{-- Status badge --}}
                        @if($reservation->status === 'confirmed')
                            <span class="px-3 py-1 rounded-full text-xs font-medium bg-teal-100 text-teal-700">Confirmed</span>
                        @elseif($reservation->status === 'pending')
                            <span class="px-3 py-1 rounded-full text-xs font-medium bg-amber-100 text-amber-700">Pending</span>
                        @else
                            <span class="px-3 py-1 rounded-full text-xs font-medium bg-red-100 text-red-600">{{ ucfirst($reservation->status ?? 'Cancelled') }}</span>
                        @endif

                        <a href="{{ route('reservations.show', $reservation) }}"
                           class="text-sm text-gray-600 hover:text-teal-600 border border-gray-200 hover:border-teal-200 px-3 py-1.5 rounded-lg transition">
                            View
                        </a>

                        @if($reservation->status !== 'cancelled')
                        <a href="{{ route('reservations.edit', $reservation) }}"
                           class="text-sm text-gray-600 hover:text-teal-600 border border-gray-200 hover:border-teal-200 px-3 py-1.5 rounded-lg transition">
                            Edit
                        </a>
                        <form method="POST" action="{{ route('reservations.destroy', $reservation) }}"
                              onsubmit="return confirm('Cancel this reservation?')">
                            @csrf 
                            @method('DELETE')
                            <button type="submit"
                                    class="text-sm text-red-500 hover:text-red-700 border border-red-200 hover:border-red-300 px-3 py-1.5 rounded-lg transition">
                                Cancel
                            </button>
                        </form>
                        @endif
                    </div>
                </div>
                
                @empty
                <div class="text-center py-16 bg-white rounded-2xl border border-gray-200">
                    <p class="text-4xl mb-3">🅿</p>
                    <p class="font-medium text-gray-500">No reservations yet.</p>
                    <a href="{{ route('reservations.create') }}"
                       class="mt-4 inline-block text-sm text-teal-600 font-medium hover:underline">
                        Book your first spot →
                    </a>
                </div>
                @endforelse
            </div>

        </div>
    </div>
</x-app-layout>