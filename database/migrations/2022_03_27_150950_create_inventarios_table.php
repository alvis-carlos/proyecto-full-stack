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
        Schema::create('inventarios', function (Blueprint $table) {

            $table->increments('id');
            $table->date('fecha_vencimiento')->nullable()->default(null);
            $table->string('talla', 5)->nullable()->default(null);
            $table->float('peso')->nullable()->default(null);
            $table->string('marca', 45)->nullable()->default(null);
            $table->string('color', 15)->nullable()->default(null);
            $table->string('lote')->nullable()->default(null);
            $table->integer('cantidad_stock');
            $table->integer('id_productos')->unsigned()->nullable()->default(null);
            $table->integer('id_estado')->unsigned()->nullable()->default(null);

            $table->index(["id_productos"], 'id_producto_idx');

            $table->index(["id_estado"], 'id_estado_idx');


            $table->foreign('id_estado', 'id_estado_idx')
                ->references('id_estados')->on('estados')
                ->onDelete('restrict')
                ->onUpdate('cascade');

            $table->foreign('id_productos', 'id_producto_idx')
                ->references('id_productos')->on('productos')
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
        Schema::dropIfExists('inventarios');
    }
};
