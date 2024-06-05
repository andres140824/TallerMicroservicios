<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tarea extends Model
{
    protected $fillable = [
        'titulo', 'descripcion', 'estado_id', 'fecha_estimada_finalizacion', 'fecha_finalizacion',
        'creado_por', 'responsable', 'prioridad_id', 'observaciones'
    ];

    public function estado()
    {
        return $this->belongsTo(Estado::class);
    }

    public function prioridad()
    {
        return $this->belongsTo(Prioridad::class);
    }

    public function creador()
    {
        return $this->belongsTo(Empleado::class, 'creado_por');
    }

    public function responsable()
    {
        return $this->belongsTo(Empleado::class, 'responsable');
    }
}
