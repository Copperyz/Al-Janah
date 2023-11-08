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
      $table->unsignedBigInteger('order_id')->nullable();
      $table->string('name');
      $table->unsignedBigInteger('item_type_id');
      $table->integer('height');
      $table->integer('width');
      $table->integer('size');
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
        ->foreign('order_id')
        ->references('id')
        ->on('orders');
      $table
        ->foreign('item_type_id')
        ->references('id')
        ->on('item_types');
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
