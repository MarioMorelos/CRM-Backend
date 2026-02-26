<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tbl_categorias', function (Blueprint $table) {
            $table->integer('id_categoria')->autoIncrement();
            $table->string('nombre', 255)->nullable();
            $table->tinyInteger('activo')->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tbl_categorias');
    }
};
