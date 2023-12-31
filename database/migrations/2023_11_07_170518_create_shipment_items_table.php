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
        Schema::create('shipment_items', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('shipment_id');
            $table->unsignedBigInteger('good_types_id')->nullable();
            $table->unsignedBigInteger('parcel_types_id')->nullable();
            $table->string('name')->nullable();
            $table->integer('quantity');
            $table->decimal('price', 8, 2);
            $table->decimal('height', 8, 2);
            $table->decimal('width', 8, 2);
            $table->decimal('weight', 8, 2);
            $table->decimal('length', 8, 2);
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->unsignedBigInteger('deleted_by')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table
                ->foreign('shipment_id')
                ->references('id')
                ->on('shipments');
            $table
                ->foreign('good_types_id')
                ->references('id')
                ->on('good_types');
            $table
                ->foreign('parcel_types_id')
                ->references('id')
                ->on('parcel_types');
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
        Schema::dropIfExists('shipment_items');
    }
};