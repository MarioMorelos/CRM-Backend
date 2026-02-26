<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tbl_pantalla', function (Blueprint $table) {
            $table->integer('idpantalla')->autoIncrement();
            $table->string('nombre', 255)->nullable();
            $table->string('ruta', 45)->nullable();
            $table->tinyInteger('activo')->nullable();
            $table->integer('idmodulo')->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tbl_pantalla');
    }
};
