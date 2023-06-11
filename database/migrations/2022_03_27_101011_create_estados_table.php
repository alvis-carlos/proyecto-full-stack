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
        Schema::create('estados', function (Blueprint $table) {
            $table->increments('id_estados');
            $table->string('nombre_esta', 45)->nullable()->default(null);
            $table->integer('id_tipo_estado')->unsigned()->nullable()->default(null);

            $table->index(["id_tipo_estado"], 'id_tipo_estado_idx');


            $table->foreign('id_tipo_estado', 'id_tipo_estado_idx')
                ->references('id_tipo_estado')->on('tipo_estados')
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
        Schema::dropIfExists('estados');
    }
};
