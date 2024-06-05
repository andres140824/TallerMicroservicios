<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Prioridad extends Model
{
    protected $fillable = ['nombre'];

    public function tareas()
    {
        return $this->hasMany(Tarea::class);
    }
}
