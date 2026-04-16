<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Receipts') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <p class="mb-4 text-sm text-gray-600 dark:text-gray-300">Your saved reservation receipts appear below. Click View to open the full receipt.</p>

                    @if($receipts->isEmpty())
                        <div class="rounded-lg border border-gray-200 bg-gray-50 p-6 text-gray-700 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300">
                            No receipts are available yet. Make a reservation to see it here.
                        </div>
                    @else
                        <div class="grid gap-4">
                            @foreach($receipts as $receipt)
                                <div class="rounded-xl border border-gray-200 bg-gray-50 p-5 shadow-sm dark:border-gray-700 dark:bg-gray-900">
                                    <div class="flex items-center justify-between gap-4">
                                        <div>
                                            <h3 class="text-lg font-semibold text-gray-900 dark:text-white">{{ $receipt->vehicle_type }} - {{ $receipt->plate_number }}</h3>
                                            <p class="text-sm text-gray-600 dark:text-gray-400">{{ $receipt->reservation_date->format('M d, Y') }} | {{ $receipt->start_time }} - {{ $receipt->end_time }}</p>
                                        </div>
                                        <a href="{{ route('reservations.show', $receipt) }}" class="rounded-md bg-blue-600 px-4 py-2 text-sm font-semibold text-white hover:bg-blue-700">View Receipt</a>
                                    </div>
                                    <p class="mt-3 text-gray-700 dark:text-gray-300">Parking Slot: {{ $receipt->parking_slot }}</p>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
