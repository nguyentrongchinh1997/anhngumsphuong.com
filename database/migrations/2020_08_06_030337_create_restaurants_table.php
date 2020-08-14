<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRestaurantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('restaurants', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('dish_id');
            $table->string('name');
            $table->string('slug');
            $table->string('thumb');
            $table->string('og_image')->nullable();
            $table->string('type')->nullable();
            $table->string('address')->nullable();
            $table->string('time')->nullable();
            $table->string('price')->nullable();
            $table->integer('rate')->nullable();
            $table->string('link');
            $table->string('link_encode');
            $table->integer('status')->default(1);
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
        Schema::dropIfExists('restaurants');
    }
}
