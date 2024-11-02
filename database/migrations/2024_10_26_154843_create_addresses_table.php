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
        Schema::create('addresses', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('customer_id');
            $table->string('type');
            $table->string('address_line');
            $table->unsignedBigInteger('city_id')->nullable();
            $table->boolean('is_default')->default(0);
            $table->timestamps();
            $table->softDeletes();

            $table
            ->foreign('customer_id')
            ->references('id')
            ->on('customers');

            $table
            ->foreign('city_id')
            ->references('id')
            ->on('cities');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('addresses');
    }
};
