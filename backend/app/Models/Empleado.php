<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Empleado extends Model
{
    protected $fillable = ['nombre', 'correo'];

    public function tareasCreadas()
    {
        return $this->hasMany(Tarea::class, 'creado_por');
    }

    public function tareasAsignadas()
    {
        return $this->hasMany(Tarea::class, 'responsable');
    }
}
