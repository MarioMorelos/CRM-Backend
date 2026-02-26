<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tbl_sucursales_marca', function (Blueprint $table) {
            $table->integer('id_sucursal')->autoIncrement();
            $table->string('nombre', 255)->nullable();
            $table->string('tel', 45)->nullable();
            $table->string('calle', 255)->nullable();
            $table->string('num_ext', 45)->nullable();
            $table->string('num_int', 45)->nullable();
            $table->string('referencia', 255)->nullable();
            $table->string('latitud', 45)->nullable();
            $table->string('longitud', 45)->nullable();
            $table->string('cp', 45)->nullable();
            $table->string('id_cp', 45)->nullable();
            $table->tinyInteger('activo')->nullable();
            $table->dateTime('fecha_registro')->nullable();
            $table->integer('id_marca')->nullable();
            $table->integer('id_zona')->nullable();
            $table->integer('id_banco')->nullable();
            $table->string('num_afiliacion', 45)->nullable();
            $table->integer('id_estatus_calidad')->nullable();
            $table->integer('id_pais')->default(7);
            $table->integer('id_rel_cipa')->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tbl_sucursales_marca');
    }
};
