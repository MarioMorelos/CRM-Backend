<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tbl_descarga_cupon', function (Blueprint $table) {
            $table->integer('id_descarga_cupon')->autoIncrement();
            $table->integer('id_cliente')->nullable();
            $table->integer('id_marca')->nullable();
            $table->dateTime('fecha_descarga')->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tbl_descarga_cupon');
    }
};
