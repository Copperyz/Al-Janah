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
        Schema::create('prices', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('good_types_id')->nullable();
            $table->unsignedBigInteger('parcel_types_id')->nullable();
            $table->unsignedBigInteger('from_country_id')->nullable();
            $table->unsignedBigInteger('to_country_id')->nullable();
            $table->decimal('price', 8, 2);
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->unsignedBigInteger('deleted_by')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table
                ->foreign('good_types_id')
                ->references('id')
                ->on('good_types');
            $table
                ->foreign('parcel_types_id')
                ->references('id')
                ->on('parcel_types');
            $table
                ->foreign('from_country_id')
                ->references('id')
                ->on('countries');
            $table
                ->foreign('to_country_id')
                ->references('id')
                ->on('countries');        
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
        Schema::dropIfExists('prices');
    }
};