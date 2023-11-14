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
    Schema::table('inventory_items', function (Blueprint $table) {
      //
      $table->string('status', 20)->after('name');
      $table->string('itemCode', 13)->after('status');
      $table
        ->unsignedBigInteger('parcel_types_id')
        ->nullable()
        ->after('itemCode');
      $table
        ->foreign('parcel_types_id')
        ->references('id')
        ->on('parcel_types');
      $table->dropForeign(['item_type_id']);
      $table->dropColumn('item_type_id');
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
  }
};
