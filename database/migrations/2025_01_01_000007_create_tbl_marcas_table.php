<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tbl_marcas', function (Blueprint $table) {
            $table->integer('id_marcas')->autoIncrement();
            $table->string('nombre', 255)->nullable();
            $table->string('logo', 255)->default('logo_default.jpg');
            $table->integer('id_usuario_marca')->nullable();
            $table->integer('id_cat_estatus')->nullable();
            $table->tinyInteger('activo')->nullable();
            $table->dateTime('fecha_registro')->nullable();
            $table->string('com_rechazo', 255)->nullable();
            $table->string('rs', 255)->nullable();
            $table->string('rfc', 255)->nullable();
            $table->string('tel', 45)->nullable();
            $table->string('contacto', 255)->nullable();
            $table->string('mail_contacto', 255)->nullable();
            $table->string('url', 255)->nullable();
            $table->date('vigencia')->nullable();
            $table->string('promo', 255)->nullable();
            $table->text('restric')->nullable();
            $table->string('cupon', 255)->default('cupon_default.jpg');
            $table->tinyInteger('llam_cal')->nullable();
            $table->tinyInteger('vis_cal')->nullable();
            $table->tinyInteger('dias_pvencer')->nullable();
            $table->integer('id_proy2')->nullable();
            $table->string('promo2', 255)->nullable();
            $table->string('contrato', 255)->default('contrato_default.pdf');
            $table->integer('id_proceso_calidad')->nullable();
            $table->string('imagen', 255)->default('imagen_default.jpg');
            $table->string('contrato2', 255)->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tbl_marcas');
    }
};
