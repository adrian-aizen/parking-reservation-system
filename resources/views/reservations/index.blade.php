<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('My Reservations') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <a href="{{ route('reservations.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mb-4 inline-block">Create New Reservation</a>

                    @if(session('success'))
                        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                            {{ session('success') }}
                        </div>
                    @endif

                    <table class="w-full bg-white shadow rounded">
                        <thead class="bg-gray-200">
                            <tr>
                                <th class="p-2">Vehicle</th>
                                <th class="p-2">Plate #</th>
                                <th class="p-2">Date</th>
                                <th class="p-2">Time</th>
                                <th class="p-2">Slot</th>
                                <th class="p-2">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($reservations as $res)
                            <tr class="text-center border-t">
                                <td class="p-2">{{ $res->vehicle_type }}</td>
                                <td class="p-2">{{ $res->plate_number }}</td>
                                <td class="p-2">{{ $res->reservation_date->format('Y-m-d') }}</td>
                                <td class="p-2">
                                    {{ $res->start_time }} - {{ $res->end_time }}
                                </td>
                                <td class="p-2">{{ $res->parking_slot }}</td>
                                <td class="p-2">
                                    <a href="{{ route('reservations.show', $res) }}" class="text-blue-500">View</a> |
                                    <a href="{{ route('reservations.edit', $res) }}" class="text-yellow-500">Edit</a> |
                                    <form action="{{ route('reservations.destroy', $res) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-500" onclick="return confirm('Are you sure?')">Delete</button>
                                    </form>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6" class="p-2 text-center">No reservations found.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>