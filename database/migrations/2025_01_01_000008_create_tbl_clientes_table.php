<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tbl_clientes', function (Blueprint $table) {
            $table->integer('id_cliente')->autoIncrement();
            $table->string('nombre_cliente', 255)->nullable();
            $table->string('key_clte', 45)->nullable();
            $table->string('img_logo', 255)->nullable();
            $table->string('img_banner', 255)->nullable();
            $table->tinyInteger('activo')->nullable();
            $table->tinyInteger('publico')->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tbl_clientes');
    }
};
