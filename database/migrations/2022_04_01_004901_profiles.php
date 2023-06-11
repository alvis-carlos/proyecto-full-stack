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
        Schema::create('profiles', function (Blueprint $table) {
            $table->id();
            $table->string('Nombres', 25)->nullable()->default(null);
            $table->string('apellidos', 25)->nullable()->default(null);
            $table->string('direccion', 25)->nullable()->default(null);
            $table->string('telefono')->nullable()->default(null);
            $table->string('cedula')->nullable()->default(null);
            $table->string('tipo_documento')->nullable()->default(null);
            $table->unsignedBigInteger('id_user')->unsigned();

            $table->index(["id_user"], 'id_users_idx');


            $table->foreign('id_user')
                ->references('id')->on('users')
                ->onDelete('restrict')
                ->onUpdate('cascade');

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
        //
    }
};
