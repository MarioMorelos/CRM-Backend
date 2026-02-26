<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tbl_usuario', function (Blueprint $table) {
            $table->integer('idusuario')->autoIncrement();
            $table->integer('id_grupo')->default(0);
            $table->string('nombre', 45)->nullable();
            $table->string('apellidos', 45)->nullable();
            $table->string('email', 45)->nullable();
            $table->string('password', 255)->nullable();
            $table->integer('id_rol')->nullable();
            $table->dateTime('fecha_ultimo_acceso')->nullable();
            $table->tinyInteger('activo')->default(1);
            $table->tinyInteger('pass_default')->default(1);
            $table->string('token', 64)->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tbl_usuario');
    }
};
