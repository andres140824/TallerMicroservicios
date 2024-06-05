<?php

namespace App\Http\Controllers;

use App\Models\Tarea;
use Illuminate\Http\Request;

class TareaController extends Controller
{
    // Crear tarea
    public function create(Request $request)
    {
        $this->validate($request, [
            'titulo' => 'required',
            'descripcion' => 'required',
            'prioridad' => 'required',
            'responsable' => 'required',
            'fecha_estimada' => 'required|date',
        ]);

        $tarea = Tarea::create([
            'titulo' => $request->titulo,
            'descripcion' => $request->descripcion,
            'prioridad' => $request->prioridad,
            'responsable' => $request->responsable,
            'fecha_estimada' => $request->fecha_estimada,
            'estado' => 'Pendiente',
            'fecha_creacion' => now(),
            'fecha_modificacion' => now(),
        ]);

        return response()->json($tarea, 201);
    }

    // Obtener todas las tareas
    public function index()
    {
        return response()->json(Tarea::all());
    }

    // Obtener una tarea específica
    public function show($id)
    {
        $tarea = Tarea::findOrFail($id);
        return response()->json($tarea);
    }

    // Actualizar tarea
    public function update(Request $request, $id)
    {
        $tarea = Tarea::findOrFail($id);

        $this->validate($request, [
            'titulo' => 'sometimes|required',
            'descripcion' => 'sometimes|required',
            'prioridad' => 'sometimes|required',
            'responsable' => 'sometimes|required',
            'fecha_estimada' => 'sometimes|required|date',
            'estado' => 'sometimes|required',
        ]);

        $tarea->update($request->all());
        return response()->json($tarea);
    }

    // Eliminar tarea
    public function delete($id)
    {
        $tarea = Tarea::findOrFail($id);
        $tarea->delete();
        return response()->json(null, 204);
    }

    // Obtener tareas filtradas
    public function filter(Request $request)
    {
        $query = Tarea::query();

        if ($request->has('prioridad')) {
            $query->where('prioridad', $request->prioridad);
        }

        if ($request->has('estado')) {
            $query->where('estado', $request->estado);
        }

        if ($request->has('responsable')) {
            $query->where('responsable', $request->responsable);
        }

        if ($request->has('titulo')) {
            $query->where('titulo', 'like', '%' . $request->titulo . '%');
        }

        if ($request->has('descripcion')) {
            $query->where('descripcion', 'like', '%' . $request->descripcion . '%');
        }

        if ($request->has('fecha_inicio') && $request->has('fecha_fin')) {
            $query->whereBetween('fecha_estimada', [$request->fecha_inicio, $request->fecha_fin]);
        }

        $tareas = $query->get();
        return response()->json($tareas);
    }
}
