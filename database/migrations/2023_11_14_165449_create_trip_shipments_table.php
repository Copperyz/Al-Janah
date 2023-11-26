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
        Schema::create('trip_shipments', function (Blueprint $table) {
            $table->unsignedBigInteger('trip_id')->nullable();
            $table->unsignedBigInteger('shipment_id')->nullable();

            $table->foreign('trip_id')->references('id')->on('trips');
            $table->foreign('shipment_id')->references('id')->on('shipments');
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('trip_shipments');
    }
};