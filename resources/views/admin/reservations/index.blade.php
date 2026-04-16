<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 dark:text-gray-200">Manage Reservations</h2>
        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">View, edit, and manage all parking reservations</p>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Filters and Search -->
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6 mb-6">
                <div class="flex flex-col sm:flex-row gap-4">
                    <div class="flex-1">
                        <input type="text" placeholder="Search by plate number..." class="w-full rounded-md border border-gray-300 dark:border-gray-600 px-3 py-2 dark:bg-gray-700 dark:text-white">
                    </div>
                    <select class="rounded-md border border-gray-300 dark:border-gray-600 px-3 py-2 dark:bg-gray-700 dark:text-white">
                        <option>All Status</option>
                        <option>Pending</option>
                        <option>Confirmed</option>
                        <option>Cancelled</option>
                    </select>
                </div>
            </div>

            <!-- Reservations Table -->
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="overflow-x-auto">
                    <table class="w-full text-sm">
                        <thead class="bg-gray-50 dark:bg-gray-700">
                            <tr>
                                <th class="px-6 py-3 text-left font-semibold text-gray-900 dark:text-white">Reservation ID</th>
                                <th class="px-6 py-3 text-left font-semibold text-gray-900 dark:text-white">User</th>
                                <th class="px-6 py-3 text-left font-semibold text-gray-900 dark:text-white">Vehicle</th>
                                <th class="px-6 py-3 text-left font-semibold text-gray-900 dark:text-white">Date</th>
                                <th class="px-6 py-3 text-left font-semibold text-gray-900 dark:text-white">Slot</th>
                                <th class="px-6 py-3 text-left font-semibold text-gray-900 dark:text-white">Status</th>
                                <th class="px-6 py-3 text-left font-semibold text-gray-900 dark:text-white">Cost</th>
                                <th class="px-6 py-3 text-left font-semibold text-gray-900 dark:text-white">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                            @forelse($reservations as $reservation)
                                <tr class="hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors">
                                    <td class="px-6 py-4 text-gray-900 dark:text-white font-mono">#RES-{{ str_pad($reservation->id, 6, '0', STR_PAD_LEFT) }}</td>
                                    <td class="px-6 py-4">
                                        <div class="text-gray-900 dark:text-white font-medium">{{ $reservation->user->name }}</div>
                                        <div class="text-sm text-gray-600 dark:text-gray-400">{{ $reservation->user->email }}</div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="text-gray-900 dark:text-white">{{ $reservation->license_plate_number }}</div>
                                        <div class="text-sm text-gray-600 dark:text-gray-400">{{ $reservation->vehicle_make }} {{ $reservation->vehicle_model }}</div>
                                    </td>
                                    <td class="px-6 py-4 text-gray-900 dark:text-white">{{ $reservation->reservation_date->format('M d, Y') }}</td>
                                    <td class="px-6 py-4 text-gray-900 dark:text-white font-semibold">{{ $reservation->parking_slot }}</td>
                                    <td class="px-6 py-4">
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium
                                            @if($reservation->status === 'pending') bg-yellow-100 dark:bg-yellow-900 text-yellow-800 dark:text-yellow-200
                                            @elseif($reservation->status === 'confirmed') bg-green-100 dark:bg-green-900 text-green-800 dark:text-green-200
                                            @else bg-red-100 dark:bg-red-900 text-red-800 dark:text-red-200
                                            @endif">
                                            {{ ucfirst($reservation->status) }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 text-gray-900 dark:text-white font-semibold">₹{{ number_format($reservation->cost) }}</td>
                                    <td class="px-6 py-4">
                                        <div class="flex gap-2">
                                            <a href="{{ route('admin.reservations.show', $reservation) }}" class="text-blue-600 dark:text-blue-400 hover:underline">View</a>
                                            <a href="{{ route('admin.reservations.edit', $reservation) }}" class="text-green-600 dark:text-green-400 hover:underline">Edit</a>
                                            <form action="{{ route('admin.reservations.destroy', $reservation) }}" method="POST" class="inline" onclick="return confirm('Are you sure?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-600 dark:text-red-400 hover:underline">Delete</button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" class="px-6 py-4 text-center text-gray-600 dark:text-gray-400">No reservations found</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                
                <!-- Pagination -->
                <div class="px-6 py-4 border-t border-gray-200 dark:border-gray-700">
                    {{ $reservations->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
