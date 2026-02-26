<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tbl_grupo', function (Blueprint $table) {
            $table->integer('id_grupo')->autoIncrement();
            $table->string('nobre_grupo', 255)->nullable();
            $table->tinyInteger('activo')->default(0);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tbl_grupo');
    }
};
