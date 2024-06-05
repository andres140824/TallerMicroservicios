<?php

$router->group(['prefix' => 'api'], function () use ($router) {
    $router->post('tareas', 'TareaController@create'); // Crear tarea
    $router->get('tareas', 'TareaController@index'); // Obtener todas las tareas
    $router->get('tareas/{id}', 'TareaController@show'); // Obtener una tarea específica
    $router->put('tareas/{id}', 'TareaController@update'); // Actualizar tarea
    $router->delete('tareas/{id}', 'TareaController@delete'); // Eliminar tarea
    $router->get('tareas/filtrar', 'TareaController@filter'); // Obtener tareas filtradas
});
