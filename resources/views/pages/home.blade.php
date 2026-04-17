<x-app-layout>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        
        <div class="flex items-center justify-between mb-8">
            <div>
                <h1 class="text-2xl font-bold text-gray-900">Parking Lots</h1>
                <p class="text-sm text-gray-500 mt-1">Browse available spots and make a reservation.</p>
            </div>
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

        @if($parkinglots->isEmpty())
            <div class="text-center py-16 text-gray-400">
                <p class="text-4xl mb-3">🅿</p>
                <p class="font-medium text-gray-500">No parking lots available yet.</p>
            </div>
        @else
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach ($parkinglots as $parkinglot)
                    <div class="bg-white rounded-2xl border border-gray-200 p-6 flex flex-col hover:shadow-md transition">
                        
                        <div class="flex items-start justify-between mb-4">
                            <div>
                                <h3 class="font-semibold text-gray-900 text-lg">{{ $parkinglot->name }}</h3>
                                <p class="text-sm text-gray-500 mt-0.5">{{ $parkinglot->capacity }} total spots</p>
                            </div>
                            <span class="text-2xl">🅿</span>
                        </div>
                        
                        {{-- Availability bar logic --}}
                        @php
                            $reserved = $parkinglot->reservations->count();
                            $available = $parkinglot->capacity - $reserved;
                            $pct = $parkinglot->capacity > 0 ? round(($available / $parkinglot->capacity) * 100) : 0;
                            $barColor = $pct > 50 ? 'bg-teal-500' : ($pct > 20 ? 'bg-amber-400' : 'bg-red-400');
                        @endphp
                        
                        <div class="mb-4">
                            <div class="flex justify-between text-xs text-gray-500 mb-1">
                                <span>{{ $available }} available</span>
                                <span>{{ $pct }}%</span>
                            </div>
                            <div class="h-2 bg-gray-100 rounded-full overflow-hidden">
                                <div class="{{ $barColor }} h-2 rounded-full transition-all" style="width: {{ $pct }}%"></div>
                            </div>
                        </div>

                        <a href="{{ route('parkinglots.show', $parkinglot) }}"
                           class="mt-auto block text-center bg-teal-600 hover:bg-teal-700 text-white text-sm font-medium py-2.5 rounded-xl transition">
                            View Details
                        </a>
                    </div>
                @endforeach
            </div>
        @endif

    </div>
</x-app-layout>