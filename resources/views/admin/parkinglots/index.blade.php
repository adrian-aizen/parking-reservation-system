<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="font-semibold text-2xl text-gray-800 dark:text-gray-200">Manage Parking Lots</h2>
                <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">Create, edit, and manage parking lots</p>
            </div>
            <a href="{{ route('admin.parkinglots.edit', 0) }}" onclick="return false" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded-lg">+ Add New Parking Lot</a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Add New Parking Lot Form -->
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6 mb-6">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Add New Parking Lot</h3>
                <form action="{{ route('admin.parkinglots.store') }}" method="POST" class="space-y-4">
                    @csrf
                    <div class="grid md:grid-cols-2 gap-4">
                        <div>
                            <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Parking Lot Name</label>
                            <input type="text" name="name" id="name" placeholder="e.g., Main Street Parking" class="mt-1 block w-full rounded-md border border-gray-300 dark:border-gray-600 px-3 py-2 dark:bg-gray-700 dark:text-white" required>
                            @error('name') <span class="text-red-600 text-sm mt-1 block">{{ $message }}</span> @enderror
                        </div>
                        <div>
                            <label for="capacity" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Capacity</label>
                            <input type="number" name="capacity" id="capacity" min="1" placeholder="e.g., 100" class="mt-1 block w-full rounded-md border border-gray-300 dark:border-gray-600 px-3 py-2 dark:bg-gray-700 dark:text-white" required>
                            @error('capacity') <span class="text-red-600 text-sm mt-1 block">{{ $message }}</span> @enderror
                        </div>
                    </div>
                    <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded-lg">Add Parking Lot</button>
                </form>
            </div>

            <!-- Parking Lots Table -->
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="overflow-x-auto">
                    <table class="w-full text-sm">
                        <thead class="bg-gray-50 dark:bg-gray-700">
                            <tr>
                                <th class="px-6 py-3 text-left font-semibold text-gray-900 dark:text-white">Parking Lot Name</th>
                                <th class="px-6 py-3 text-left font-semibold text-gray-900 dark:text-white">Capacity</th>
                                <th class="px-6 py-3 text-left font-semibold text-gray-900 dark:text-white">Reservations</th>
                                <th class="px-6 py-3 text-left font-semibold text-gray-900 dark:text-white">Availability</th>
                                <th class="px-6 py-3 text-left font-semibold text-gray-900 dark:text-white">Created</th>
                                <th class="px-6 py-3 text-left font-semibold text-gray-900 dark:text-white">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                            @forelse($parkinglots as $lot)
                                @php
                                    $reserved = $lot->reservations_count;
                                    $available = $lot->capacity - $reserved;
                                    $occupancy = $lot->capacity > 0 ? round(($reserved / $lot->capacity) * 100) : 0;
                                @endphp
                                <tr class="hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors">
                                    <td class="px-6 py-4">
                                        <div class="text-gray-900 dark:text-white font-semibold">{{ $lot->name }}</div>
                                    </td>
                                    <td class="px-6 py-4 text-gray-900 dark:text-white">{{ $lot->capacity }} spots</td>
                                    <td class="px-6 py-4 text-gray-900 dark:text-white">{{ $reserved }}</td>
                                    <td class="px-6 py-4">
                                        <div class="flex items-center gap-2">
                                            <div class="flex-1 bg-gray-300 dark:bg-gray-600 rounded-full h-2">
                                                <div class="bg-blue-600 h-2 rounded-full" style="width: {{ $occupancy }}%"></div>
                                            </div>
                                            <span class="text-sm text-gray-600 dark:text-gray-400">{{ $available }} free</span>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 text-gray-600 dark:text-gray-400">{{ $lot->created_at->format('M d, Y') }}</td>
                                    <td class="px-6 py-4">
                                        <div class="flex gap-2">
                                            <a href="{{ route('admin.parkinglots.edit', $lot) }}" class="text-green-600 dark:text-green-400 hover:underline">Edit</a>
                                            <form action="{{ route('admin.parkinglots.destroy', $lot) }}" method="POST" class="inline" onclick="return confirm('Are you sure? This action cannot be undone.')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-600 dark:text-red-400 hover:underline" @if($lot->reservations()->exists()) disabled @endif>
                                                    Delete
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="px-6 py-4 text-center text-gray-600 dark:text-gray-400">No parking lots found</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                
                <!-- Pagination -->
                <div class="px-6 py-4 border-t border-gray-200 dark:border-gray-700">
                    {{ $parkinglots->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
