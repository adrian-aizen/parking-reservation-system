<x-app-layout>


    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6 text-gray-900">
                    {{ __("You're logged in!") }}

                    <div class="mt-6">
                        <a href="{{ route('reservations.index') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">View My Reservations</a>
                        <a href="{{ route('reservations.create') }}" class="ml-4 bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">Make a Reservation</a>
                    </div>
                </div>
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-lg font-semibold mb-4">Your Recent Reservations</h3>

                    @php
                        $recentReservations = auth()->user()->reservations()->latest()->take(5)->get();
                    @endphp

                    @if($recentReservations->count() > 0)
                        <table class="w-full bg-white shadow rounded">
                            <thead class="bg-gray-200">
                                <tr>
                                    <th class="p-2">Vehicle</th>
                                    <th class="p-2">Date</th>
                                    <th class="p-2">Time</th>
                                    <th class="p-2">Slot</th>
                                    <th class="p-2">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($recentReservations as $res)
                                <tr class="text-center border-t">
                                    <td class="p-2">{{ $res->vehicle_type }}</td>
                                    <td class="p-2">{{ $res->reservation_date->format('M d, Y') }}</td>
                                    <td class="p-2">{{ $res->start_time }} - {{ $res->end_time }}</td>
                                    <td class="p-2">{{ $res->parking_slot }}</td>
                                    <td class="p-2">
                                        <a href="{{ route('reservations.show', $res) }}" class="text-blue-500 text-sm">View</a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @else
                        <p class="text-gray-500">No reservations yet. <a href="{{ route('reservations.create') }}" class="text-blue-500">Create your first reservation</a>.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
