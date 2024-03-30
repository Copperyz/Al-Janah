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
    Schema::create('customers', function (Blueprint $table) {
      $table->id();
      $table->string('type');
      $table->string('customer_code', 13);
      $table->uuid('customer_reference')->unique();
      $table->string('first_name', 50);
      $table->string('last_name', 50);
      $table->string('email')->unique();
      $table->string('phone')->unique();
      $table->string('address');
      $table->unsignedBigInteger('city_id')->nullable();
      $table->unsignedBigInteger('country_id')->nullable();
      $table->string('status');
      $table->decimal('total_amount', 10, 2)->default(0);
      $table->unsignedBigInteger('user_id')->nullable();
      $table->unsignedBigInteger('created_by')->nullable();
      $table->unsignedBigInteger('updated_by')->nullable();
      $table->unsignedBigInteger('deleted_by')->nullable();
      $table->timestamps();
      $table->softDeletes();

      $table
        ->foreign('city_id')
        ->references('id')
        ->on('cities');
      $table
        ->foreign('country_id')
        ->references('id')
        ->on('countries');
      $table
        ->foreign('user_id')
        ->references('id')
        ->on('users');
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
    Schema::dropIfExists('customers');
  }
};
