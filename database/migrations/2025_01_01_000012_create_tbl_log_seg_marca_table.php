<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tbl_log_seg_marca', function (Blueprint $table) {
            $table->integer('id_log_seg_marca')->autoIncrement();
            $table->integer('id_marca')->nullable();
            $table->integer('id_estatus')->nullable();
            $table->string('comentarios', 255)->nullable();
            $table->dateTime('fecha_registro')->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tbl_log_seg_marca');
    }
};
