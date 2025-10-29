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
        Schema::create('asistencia', function (Blueprint $table) {
            $table->id();
            $table->date('fecha');
            $table->string('modalidad', 50);
            $table->boolean('estado')->default(true);

            // 👇 Primero defines la columna
            $table->integer('registro');

            // 👇 Luego defines la FK
            $table->foreign('registro')
                ->references('registro')
                ->on('docente')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreignId('horario_materia_id')
                ->constrained('horario_materia')
                ->onDelete('cascade');

            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('asistencia');
    }
};
