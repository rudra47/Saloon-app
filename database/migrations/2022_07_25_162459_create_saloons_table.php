<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSaloonsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('saloons', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100);
            $table->string('email', 100)->unique()->nullable();
            $table->string('phone', 50)->unique()->nullable();
            $table->text('address')->nullable();
            $table->string('latitude', 20)->unique();
            $table->string('longitude', 20)->unique();
            $table->unsignedTinyInteger('status')->default(1)->comment('2=>Pending, 1=> Active, 0=>Inactive');
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
        Schema::dropIfExists('saloons');
    }
}