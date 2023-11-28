<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
  /**
   * Run the migrations.
   */
  public function up(): void
  {
    Schema::create('shipment_histories', function (Blueprint $table) {
      $table->id();
      $table->unsignedBigInteger('trip_id');
      $table->unsignedBigInteger('shipment_id');
      $table->string('status', 50);
      $table->string('change_type', 50);
      $table->tinyInteger('route_leg');
      $table->string('note');
      $table->unsignedBigInteger('created_by')->nullable();
      $table->unsignedBigInteger('updated_by')->nullable();
      $table->unsignedBigInteger('deleted_by')->nullable();
      $table->timestamps();
      $table->softDeletes();

      $table
        ->foreign('trip_id')
        ->references('id')
        ->on('trips');
      $table
        ->foreign('shipment_id')
        ->references('id')
        ->on('shipments');
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
    Schema::dropIfExists('shipment_histories');
  }
};
