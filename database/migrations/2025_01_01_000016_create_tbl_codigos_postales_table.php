<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tbl_codigos_postales', function (Blueprint $table) {
            $table->integer('id_codigo_postal')->autoIncrement();
            $table->string('cp', 5)->nullable();
            $table->string('colonia', 255)->nullable();
            $table->string('del_mun', 255)->nullable();
            $table->string('estado', 255)->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tbl_codigos_postales');
    }
};
