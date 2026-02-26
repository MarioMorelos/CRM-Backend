<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tbl_asig_proyecto', function (Blueprint $table) {
            $table->integer('id_asig_proyecto')->autoIncrement();
            $table->integer('id_marca')->nullable();
            $table->integer('id_campania')->nullable();
            $table->integer('id_proyecto')->nullable();
            $table->date('f_inicio')->nullable();
            $table->date('vigencia')->nullable();
            $table->string('promo', 255)->nullable();
            $table->string('desc_promo', 255)->nullable();
            $table->text('restric')->nullable();
            $table->dateTime('fecha_registro')->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tbl_asig_proyecto');
    }
};
