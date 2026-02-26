<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tbl_rel_marca_categoria', function (Blueprint $table) {
            $table->integer('id_rel_marca_categoria')->autoIncrement();
            $table->integer('id_marca')->nullable();
            $table->integer('id_categoria')->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tbl_rel_marca_categoria');
    }
};
