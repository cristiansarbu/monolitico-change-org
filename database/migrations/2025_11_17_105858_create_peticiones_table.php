<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('peticiones', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->unsigned();
            $table->bigInteger('categoria_id')->unsigned();
            $table->string('titulo', 255);
            $table->text('descripcion');
            $table->text('destinatario');
            $table->integer('firmantes');
            $table->enum('estado', ['aceptada', 'pendiente']);

            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('CASCADE');
            $table->foreign('categoria_id')
                ->references('id')
                ->on('users')
                ->onDelete('CASCADE');
//          $table->string('image', 255, ); No se necesita
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('peticiones');
    }
};
