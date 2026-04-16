<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('reservations', function (Blueprint $table) {
            $table->string('permit_type')->default('daily')->comment('daily, weekly, monthly');
            $table->string('vehicle_make')->nullable();
            $table->string('vehicle_model')->nullable();
            $table->string('license_plate_number')->nullable();
            $table->string('vehicle_color')->nullable();
            $table->decimal('cost', 8, 2)->default(0);
            $table->string('payment_method')->nullable()->comment('credit_card, upi');
            $table->string('status')->default('pending')->comment('pending, confirmed, cancelled');
            $table->text('notes')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('reservations', function (Blueprint $table) {
            $table->dropColumn([
                'permit_type',
                'vehicle_make',
                'vehicle_model',
                'license_plate_number',
                'vehicle_color',
                'cost',
                'payment_method',
                'status',
                'notes',
            ]);
        });
    }
};
