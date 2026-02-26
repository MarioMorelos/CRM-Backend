<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tbl_cat_estatus', function (Blueprint $table) {
            $table->integer('id_estatus')->autoIncrement();
            $table->string('nombre', 255)->nullable();
            $table->string('descripcion', 255)->nullable();
            $table->string('color', 45)->nullable();
            $table->tinyInteger('activo')->default(0);
            $table->string('colorhex', 45)->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tbl_cat_estatus');
    }
};
