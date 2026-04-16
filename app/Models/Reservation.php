<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Reservation extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'parking_lot_id',
        'vehicle_type',
        'plate_number',
        'permit_type',
        'vehicle_make',
        'vehicle_model',
        'license_plate_number',
        'vehicle_color',
        'reservation_date',
        'start_time',
        'end_time',
        'parking_slot',
        'cost',
        'payment_method',
        'status',
        'notes',
    ];

    protected $casts = [
        'reservation_date' => 'date',
        'cost' => 'decimal:2',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function parkingLot()
    {
        return $this->belongsTo(ParkingLot::class);
    }
}