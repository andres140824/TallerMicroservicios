<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;



class CreateTareasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('tareas')) {
            Schema::create('tareas', function (Blueprint $table) {
                $table->id();
                $table->string('titulo');
                $table->text('descripcion');
                $table->timestamp('fecha_creacion')->useCurrent();
                $table->timestamp('fecha_modificacion')->useCurrent()->nullable();
                $table->unsignedBigInteger('estado_id');
                $table->foreign('estado_id')->references('id')->on('estados');
                $table->timestamp('fecha_estimada_finalizacion')->nullable();
                $table->timestamp('fecha_finalizacion')->nullable();
                $table->unsignedBigInteger('creado_por');
                $table->foreign('creado_por')->references('id')->on('empleados');
                $table->unsignedBigInteger('responsable');
                $table->foreign('responsable')->references('id')->on('empleados');
                $table->unsignedBigInteger('prioridad_id');
                $table->foreign('prioridad_id')->references('id')->on('prioridades');
                $table->text('observaciones')->nullable();
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tareas');
    }
}
