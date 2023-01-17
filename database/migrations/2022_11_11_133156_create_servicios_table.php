<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('servicios', function (Blueprint $table) {
            $table->id();
            $table->string("nombre", 1000);
            $table->string("tipo");
            $table->unsignedDecimal("umas", 18,2)->default(0)->nullable();
            $table->unsignedDecimal("ordinario", 18,2)->nullable();
            $table->unsignedDecimal("urgente", 18,2)->default(0)->nullable();
            $table->unsignedDecimal("extra_urgente", 18,2)->default(0)->nullable();
            $table->string('operacion_principal');
            $table->string('operacion_parcial');
            $table->foreignId('categoria_servicio_id')->constrained()->onDelete('cascade');
            $table->foreignId('creado_por')->nullable()->references('id')->on('users');
            $table->foreignId('actualizado_por')->nullable()->references('id')->on('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('servicios');
    }
};
