<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBookingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('saloon_id')->constrained('saloons')->onDelete('cascade');
            $table->foreignId('saloon_service_id')->constrained('saloon_services')->onDelete('cascade');
            $table->float('price');
            $table->dateTime('booking_apply_time')->nullable();
            $table->dateTime('booking_confirm_time')->nullable();
            $table->string('transaction_no', 50)->nullable();
            $table->unsignedTinyInteger('status')->default(0)->comment('4=>Completed, 3=>Active, 2=>Canceled, 1=> Paid, 0=>Pending');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bookings');
    }
}
