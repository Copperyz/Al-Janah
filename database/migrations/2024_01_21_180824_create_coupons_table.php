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
        Schema::create('coupons', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('customer_id')->nullable();
            $table->string('code', 50)->unique();
            $table->decimal('amount', 10, 2)->default(0);
            $table->datetime('expiry_date');
            $table->tinyInteger('used')->default(0);
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->unsignedBigInteger('deleted_by')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table
                ->foreign('customer_id')
                ->references('id')
                ->on('customers');
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
        Schema::dropIfExists('coupons');
    }
};
