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
        Schema::create('productos', function (Blueprint $table) {
            $table->increments('id_productos');
            $table->string('nombres_productos', 75)->nullable()->default(null);
            $table->string('descripcion', 170)->nullable()->default(null);
            $table->integer('valor')->nullable()->default(null);
            $table->integer('id_categorias')->unsigned()->nullable()->default(null);
            $table->text('imagen');

            $table->index(["id_categorias"], 'id_categorias_idx');


            $table->foreign('id_categorias', 'id_categorias_idx')
                ->references('id_categorias')->on('categorias')
                ->onDelete('restrict')
                ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('productos');
    }
};
