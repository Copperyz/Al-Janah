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
    Schema::create('payments', function (Blueprint $table) {
      $table->id();
      $table->unsignedBigInteger('order_id')->nullable();
      $table->enum('transaction_type', ['order', 'shipment']);
      $table
        ->decimal('shipment_amount', 10, 2)
        ->nullable()
        ->default(0);
      $table
        ->decimal('order_amount', 10, 2)
        ->nullable()
        ->default(0);
      $table->string('payment_method');
      $table->string('transaction_id');
      $table
        ->boolean('cancel')
        ->nullable()
        ->default(0);
      $table->enum('status', ['paid', 'refunded']);
      $table->unsignedBigInteger('created_by')->nullable();
      $table->unsignedBigInteger('updated_by')->nullable();
      $table->unsignedBigInteger('deleted_by')->nullable();
      $table->timestamps();
      $table->softDeletes();

      $table
        ->foreign('order_id')
        ->references('id')
        ->on('orders');
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
    Schema::dropIfExists('payments');
  }
};
