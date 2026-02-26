<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tbl_modulo', function (Blueprint $table) {
            $table->integer('id_modulo')->autoIncrement();
            $table->string('nombre', 255)->nullable();
            $table->string('icono', 255)->nullable();
            $table->string('pagina', 45)->nullable();
            $table->integer('orden')->nullable();
            $table->tinyInteger('activo')->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tbl_modulo');
    }
};
