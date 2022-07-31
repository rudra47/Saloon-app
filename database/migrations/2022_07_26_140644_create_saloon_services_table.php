<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSaloonServicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('saloon_services', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100);
            $table->foreignId('saloon_id')->constrained('saloons')->onDelete('cascade');
            $table->double('price')->default(0.00);
            $table->unsignedTinyInteger('discount_type')->default(1)->comment('1=> Flat, 2=>Percentage');
            $table->integer('discount_price')->default(0);
            $table->unsignedTinyInteger('status')->default(1)->comment('1=> Active, 0=>Inactive');
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
        Schema::dropIfExists('saloon_services');
    }
}
