<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tbl_rel_rol_modulo', function (Blueprint $table) {
            $table->integer('id_rel_rol_modulo')->autoIncrement();
            $table->integer('id_rol')->nullable();
            $table->integer('id_modulo')->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tbl_rel_rol_modulo');
    }
};
