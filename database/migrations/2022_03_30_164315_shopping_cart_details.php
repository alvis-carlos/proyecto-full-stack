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
        Schema::create('shopping_cart_details', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->integer('id_productos')->unsigned();
            $table->unsignedBigInteger('shopping_cart_id')->unsigned();
            $table->integer('quantity');

            $table->foreign('shopping_cart_id')
            ->references('id')->on('shopping_carts');
            
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
        Schema::drop('shopping_cart_details');
    }
};
