<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-2xl text-gray-800 dark:text-gray-200 leading-tight">
                @if(auth()->user()->isAdmin())
                    {{ __('Admin Dashboard') }}
                @else
                    {{ __('Parking Reservations') }}
                @endif
            </h2>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <div class="mb-8">
                <h1 class="text-2xl font-bold text-gray-900">Dashboard</h1>
                <p class="text-sm text-gray-500 mt-1">Welcome back, {{ auth()->user()->name }}</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                <a href="{{ route('reservations.create') }}" class="bg-gradient-to-br from-blue-500 to-blue-600 hover:from-blue-600 hover:to-blue-700 text-white rounded-lg shadow-lg p-6 flex flex-col items-center justify-center transition transform hover:scale-105">
                    <svg class="w-12 h-12 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                    </svg>
                    <span class="font-semibold text-lg">New Reservation</span>
                </a>

                <a href="{{ route('reservations.index') }}" class="bg-gradient-to-br from-green-500 to-green-600 hover:from-green-600 hover:to-green-700 text-white rounded-lg shadow-lg p-6 flex flex-col items-center justify-center transition transform hover:scale-105">
                    <svg class="w-12 h-12 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                    </svg>
                    <span class="font-semibold text-lg">My Reservations</span>
                </a>

                @if(auth()->user()->isAdmin())
                    <a href="{{ route('admin.parkinglots.index') }}" class="bg-gradient-to-br from-purple-500 to-purple-600 hover:from-purple-600 hover:to-purple-700 text-white rounded-lg shadow-lg p-6 flex flex-col items-center justify-center transition transform hover:scale-105">
                        <svg class="w-12 h-12 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                        </svg>
                        <span class="font-semibold text-lg">Parking Lots</span>
                    </a>

                    <a href="{{ route('admin.reservations.index') }}" class="bg-gradient-to-br from-orange-500 to-orange-600 hover:from-orange-600 hover:to-orange-700 text-white rounded-lg shadow-lg p-6 flex flex-col items-center justify-center transition transform hover:scale-105">
                        <svg class="w-12 h-12 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <span class="font-semibold text-lg">Manage Reservations</span>
                    </a>
                @endif
            </div>

            @if(auth()->user()->isAdmin())
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6 mb-8">
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white mb-4">Admin Overview</h3>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <div class="bg-blue-50 dark:bg-blue-900/20 p-4 rounded-lg">
                            <p class="text-sm text-gray-600 dark:text-gray-400">Total Parking Lots</p>
                            <p class="text-2xl font-bold text-blue-600">{{ \App\Models\ParkingLot::count() }}</p>
                        </div>
                        <div class="bg-green-50 dark:bg-green-900/20 p-4 rounded-lg">
                            <p class="text-sm text-gray-600 dark:text-gray-400">Total Reservations</p>
                            <p class="text-2xl font-bold text-green-600">{{ \App\Models\Reservation::count() }}</p>
                        </div>
                        <div class="bg-purple-50 dark:bg-purple-900/20 p-4 rounded-lg">
                            <p class="text-sm text-gray-600 dark:text-gray-400">Registered Users</p>
                            <p class="text-2xl font-bold text-purple-600">{{ \App\Models\User::count() }}</p>
                        </div>
                    </div>
                </div>
            @else
                
                <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 mb-8">
                    <div class="bg-white rounded-xl border border-gray-200 p-5">
                        <p class="text-xs font-medium text-gray-500 uppercase tracking-wide">Total Lots</p>
                        <p class="text-3xl font-bold text-gray-900 mt-1">{{ $parkinglots->count() }}</p>
                    </div>
                    <div class="bg-white rounded-xl border border-gray-200 p-5">
                        <p class="text-xs font-medium text-gray-500 uppercase tracking-wide">Latest Status</p>
                        <p class="text-3xl font-bold text-gray-900 mt-1">
                            {{ $latestReservation ? ucfirst($latestReservation->status) : 'N/A' }}
                        </p>
                    </div>
                    <div class="bg-white rounded-xl border border-gray-200 p-5">
                        <p class="text-xs font-medium text-gray-500 uppercase tracking-wide">Available Spots</p>
                        <p class="text-3xl font-bold text-gray-900 mt-1">
                            {{ $parkinglots->sum(function($lot) { return max(0, $lot->capacity - $lot->reservations()->count()); }) }}
                        </p>
                    </div>
                </div>

                <div class="bg-white rounded-xl border border-gray-200 p-6 mb-8">
                    <h2 class="text-base font-semibold text-gray-900 mb-4">Latest Reservation</h2>
                    
                    @if($latestReservation)
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <p class="text-sm text-gray-600 dark:text-gray-400">Parking Lot</p>
                                <p class="text-lg font-semibold text-gray-900">{{ $latestReservation->parkingLot->name }}</p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-600 dark:text-gray-400">Date</p>
                                <p class="text-lg font-semibold text-gray-900">{{ $latestReservation->reservation_date->format('M d, Y') }}</p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-600 dark:text-gray-400">Parking Slot</p>
                                <p class="text-lg font-semibold text-gray-900">{{ $latestReservation->parking_slot }}</p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-600 dark:text-gray-400">Status</p>
                                @if($latestReservation->status === 'confirmed')
                                    <span class="px-2.5 py-1 rounded-full text-xs font-medium bg-teal-100 text-teal-700">Confirmed</span>
                                @elseif($latestReservation->status === 'pending')
                                    <span class="px-2.5 py-1 rounded-full text-xs font-medium bg-amber-100 text-amber-700">Pending</span>
                                @else
                                    <span class="px-2.5 py-1 rounded-full text-xs font-medium bg-red-100 text-red-700">Cancelled</span>
                                @endif
                            </div>
                        </div>
                        <div class="mt-4 flex gap-2">
                            <a href="{{ route('reservations.show', $latestReservation) }}" class="text-blue-600 hover:text-blue-700 font-medium text-sm">View Details →</a>
                        </div>
                    @else
                        <div class="text-center py-8">
                            <p class="text-gray-400 text-sm">No reservations yet.</p>
                            <a href="{{ route('reservations.create') }}" class="mt-3 inline-block text-sm text-teal-600 font-medium hover:underline">
                                Book your first spot →
                            </a>
                        </div>
                    @endif
                </div>

                <div class="bg-white rounded-xl border border-gray-200 p-6 mb-8">
                    <h3 class="text-base font-semibold text-gray-900 mb-4">Available Parking Lots</h3>
                    @if($parkinglots->isEmpty())
                        <p class="text-gray-600 dark:text-gray-400">No parking lots available at the moment.</p>
                    @else
                        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                            @foreach($parkinglots as $parkinglot)
                                <div class="bg-white rounded-xl border border-gray-200 p-5 hover:shadow-md transition">
                                    <h3 class="font-semibold text-gray-900">{{ $parkinglot->name }}</h3>
                                    <p class="text-sm text-gray-500 mt-1">{{ $parkinglot->capacity }} total spots</p>
                                    <a href="{{ route('parkinglots.show', $parkinglot) }}"
                                       class="mt-4 inline-block w-full text-center bg-teal-600 hover:bg-teal-700 text-white text-sm font-medium py-2 rounded-lg transition">
                                        View & Reserve
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            @endif
        </div>
    </div>
</x-app-layout>