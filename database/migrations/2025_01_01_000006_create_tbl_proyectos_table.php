<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tbl_proyectos', function (Blueprint $table) {
            $table->integer('id_proyecto')->autoIncrement();
            $table->string('nombre_proyecto', 255)->nullable();
            $table->integer('activo')->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tbl_proyectos');
    }
};
