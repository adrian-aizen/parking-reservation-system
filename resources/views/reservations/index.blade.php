@extends('layouts.app')

@section('content')

<h2 class="text-2xl font-bold mb-4">My Reservations</h2>

<table class="w-full bg-white shadow rounded">
    <thead class="bg-gray-200">
        <tr>
            <th class="p-2">Vehicle</th>
            <th class="p-2">Plate #</th>
            <th class="p-2">Date</th>
            <th class="p-2">Time</th>
            <th class="p-2">Slot</th>
        </tr>
    </thead>
    <tbody>
        @foreach($reservations as $res)
        <tr class="text-center border-t">
            <td class="p-2">{{ $res->vehicle_type }}</td>
            <td class="p-2">{{ $res->plate_number }}</td>
            <td class="p-2">{{ $res->reservation_date }}</td>
            <td class="p-2">
                {{ $res->start_time }} - {{ $res->end_time }}
            </td>
            <td class="p-2">{{ $res->parking_slot }}</td>
        </tr>
        @endforeach
    </tbody>
</table>

@endsection