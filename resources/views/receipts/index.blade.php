<x-app-layout>
    <div class="py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <div class="mb-8">
                <h1 class="text-2xl font-bold text-gray-900">Receipts</h1>
                <p class="text-sm text-gray-500 mt-1">Your payment history.</p>
            </div>

            <div class="space-y-4">
                @forelse($receipts as $receipt)
                <div class="bg-white rounded-2xl border border-gray-200 p-5 flex flex-col sm:flex-row sm:items-center justify-between gap-4 hover:shadow-sm transition">
                    
                    <div>
                        <p class="font-semibold text-gray-900">{{ $receipt->parkingLot->name ?? 'Parking Lot' }}</p>
                        <p class="text-sm text-gray-500 mt-0.5">
                            {{ \Carbon\Carbon::parse($receipt->reservation_date)->format('M d, Y') }} &middot;
                            <span class="font-mono">{{ $receipt->plate_number }}</span>
                        </p>
                        <p class="text-xs text-gray-400 mt-1">{{ ucfirst(str_replace('_', ' ', $receipt->payment_method ?? 'Cash')) }}</p>
                    </div>

                    <div class="flex items-center gap-4 shrink-0">
                        <p class="text-xl font-bold text-gray-900">₱ {{ number_format($receipt->cost ?? 0, 2) }}</p>
                        
                        @if($receipt->status === 'confirmed')
                            <span class="px-3 py-1 rounded-full text-xs font-medium bg-teal-100 text-teal-700">Confirmed</span>
                        @elseif($receipt->status === 'pending')
                            <span class="px-3 py-1 rounded-full text-xs font-medium bg-amber-100 text-amber-700">Pending</span>
                        @else
                            <span class="px-3 py-1 rounded-full text-xs font-medium bg-red-100 text-red-600">{{ ucfirst($receipt->status ?? 'Cancelled') }}</span>
                        @endif

                        <a href="{{ route('reservations.show', $receipt) }}"
                           class="text-sm text-gray-500 hover:text-teal-600 border border-gray-200 hover:border-teal-200 px-3 py-1.5 rounded-lg transition">
                            View
                        </a>
                    </div>
                </div>
                
                @empty
                <div class="text-center py-16 bg-white rounded-2xl border border-gray-200">
                    <p class="text-gray-400 text-sm">No receipts yet.</p>
                </div>
                @endforelse
            </div>

        </div>
    </div>
</x-app-layout>