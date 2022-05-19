<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('coupons', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('image')->nullable();
            $table->bigInteger('downloads')->nullable();
            $table->date('validity');
            $table->timestamps();
        });

        Schema::create('city_coupon', function (Blueprint $table) {
            $table->id();
            $table->foreignId('city_id')
                    ->constrained('cities')
                    ->onDelete('cascade');

            $table->foreignId('coupon_id')
                    ->constrained('coupons')
                    ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('coupons');
    }
};
