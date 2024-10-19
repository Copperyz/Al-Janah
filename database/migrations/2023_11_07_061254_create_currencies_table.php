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
        Schema::create('currencies', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->char('symbol', 3); // Assuming currency symbols are short (e.g., USD, EUR, ₹)
            $table->decimal('valueInUsd', 10, 2)->nullable()->default(0); // Higher precision for currency values
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->unsignedBigInteger('deleted_by')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table
            ->foreign('created_by')
            ->references('id')
            ->on('users');
            $table
            ->foreign('updated_by')
            ->references('id')
            ->on('users');
            $table
            ->foreign('deleted_by')
            ->references('id')
            ->on('users');
            });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('currencies');
    }
};
