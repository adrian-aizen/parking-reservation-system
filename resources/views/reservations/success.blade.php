<x-app-layout>
    <div class="py-12">
        <div class="max-w-lg mx-auto px-4 sm:px-6 lg:px-8 text-center">

            {{-- Success icon --}}
            <div class="w-20 h-20 rounded-full bg-teal-100 flex items-center justify-center text-4xl mx-auto mb-6 text-teal-600">
                ✓
            </div>

            <h1 class="text-2xl font-bold text-gray-900 mb-2">Booking Confirmed!</h1>
            <p class="text-gray-500 mb-8">Your parking spot has been reserved successfully.</p>

            {{-- Receipt card --}}
            <div class="bg-white rounded-2xl border border-gray-200 p-6 text-left mb-8 shadow-sm">
                <div class="divide-y divide-gray-100">
                    @php
                        $receiptDetails = [
                            ['Reservation ID', '#' . str_pad($reservation->id, 5, '0', STR_PAD_LEFT)],
                            ['Lot', $reservation->parkingLot->name ?? 'Parking Lot'],
                            ['Slot', $reservation->parking_slot],
                            ['Date', \Carbon\Carbon::parse($reservation->reservation_date)->format('F d, Y')],
                            ['Time', $reservation->start_time . ' – ' . $reservation->end_time],
                            ['Vehicle', $reservation->vehicle_type . ' (' . $reservation->plate_number . ')'],
                            ['Permit', ucfirst($reservation->permit_type ?? 'Standard')],
                            ['Amount Paid', '₱ ' . number_format($reservation->cost ?? 0, 2)],
                            ['Payment', ucfirst(str_replace('_', ' ', $reservation->payment_method ?? 'Cash'))],
                        ];
                    @endphp

                    @foreach($receiptDetails as [$label, $value])
                    <div class="flex justify-between py-3 text-sm">
                        <span class="text-gray-500">{{ $label }}</span>
                        <span class="font-medium text-gray-900">{{ $value }}</span>
                    </div>
                    @endforeach
                </div>
            </div>

            {{-- Action buttons --}}
            <div class="flex flex-col sm:flex-row gap-3">
                <a href="{{ route('reservations.index') }}"
                   class="flex-1 text-center border border-gray-300 hover:border-teal-400 text-gray-700 hover:text-teal-700 font-medium py-3 rounded-xl transition text-sm">
                    My Reservations
                </a>
                <a href="{{ route('receipts.index') }}"
                   class="flex-1 text-center bg-teal-600 hover:bg-teal-700 text-white font-semibold py-3 rounded-xl transition text-sm shadow-sm">
                    View Receipts
                </a>
            </div>

        </div>
    </div>
</x-app-layout>