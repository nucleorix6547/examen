<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('bitacora', function (Blueprint $table) {
            $table->id();
            $table->integer('usuario_registro'); // se enlaza con usuarios.registro
            $table->string('accion', 100);       // tipo de acción: LOGIN, CREAR, ACTUALIZAR, ELIMINAR...
            $table->text('descripcion')->nullable(); // detalle de lo que pasó
            $table->timestamp('fecha')->useCurrent(); // fecha automática

            // 🔗 Relación con usuarios
            $table->foreign('usuario_registro')
                ->references('registro')
                ->on('usuarios')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bitacora');
    }
};
