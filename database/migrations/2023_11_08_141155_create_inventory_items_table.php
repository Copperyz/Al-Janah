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
    Schema::create('inventory_items', function (Blueprint $table) {
      $table->id();
      $table->unsignedBigInteger('inventory_id');
      $table->unsignedBigInteger('shipment_id')->nullable();
      $table->unsignedBigInteger('shipment_item_id')->nullable();
      $table->string('name');
      $table->string('status', 20);
      $table->string('itemCode', 13);
      $table->unsignedBigInteger('parcel_types_id')->nullable();
      $table->integer('height')->nullable();
      $table->integer('width')->nullable();
      $table->integer('size')->nullable();
      $table->integer('quantity');
      $table->string('aisle');
      $table->string('shelfNumber');
      $table->string('row');
      $table->unsignedBigInteger('created_by')->nullable();
      $table->unsignedBigInteger('updated_by')->nullable();
      $table->unsignedBigInteger('deleted_by')->nullable();
      $table->timestamps();
      $table->softDeletes();

      $table
        ->foreign('inventory_id')
        ->references('id')
        ->on('inventories');
      $table
        ->foreign('shipment_id')
        ->references('id')
        ->on('shipments');
      $table
        ->foreign('shipment_item_id')
        ->references('id')
        ->on('shipment_items');
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
    Schema::dropIfExists('inventory_items');
  }
};
