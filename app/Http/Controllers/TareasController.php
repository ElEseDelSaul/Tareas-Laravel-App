<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\Tarea;
use Illuminate\Http\Request;

class TareasController extends Controller
{
    /*
        * index : mostrar todas las tareas
        * store : guardar una tarea
        * update : actualizar una tarea
        * destroy : eliminar una tarea
        * edit : mostrar el formulario de edicion
    */

    //Agregar Tarea
    public function store(Request $request)
    {

        //Validar la peticion
        $request->validate([
            'titulo' => 'required|min:3'
        ]);
        //Crear objeto del Modelo
        $tarea = new Tarea;
        //Vaciar data en modelo
        $tarea->titulo = $request->titulo;
        $tarea->categoria_id = $request->categoria_id;
        //Agregar info en DB
        $tarea->save();
        //Redireccionar a home y guardar estado de solicitud a la SESSION
        return redirect()->route('tareas')->with('success', 'Tarea agregada correctamente');
    }

    public function index()
    {
        $tareas = Tarea::all();
        $categorias = Categoria::all();
        return view('tareas.index', ['tareas' => $tareas, 'categorias' => $categorias]);
    }

    public function show($id)
    {
        $tarea = Tarea::find($id);

        //Obtener Id de categoria vinculada a la tarea ACTUALMENTE
        $idCat = $tarea->categoria_id;
        $catego = Categoria::find($idCat);
        //dd($catego->nombre);

        //Obtener TODAS las categorias
        $categorias = Categoria::all();
        return view('tareas.show', ['tarea' => $tarea,'catego' => $catego ,'categorias' => $categorias]);
    }

    public function update(Request $request, $id)
    {
        //Identificar esa tarea
        $tarea = Tarea::find($id);
        //Empalmar data de peticion a el modelo
        $tarea->titulo = $request->titulo;
        $tarea->categoria_id = $request->categoria_id;
        //Actualizar tarea
        $tarea->save();

        //Console de php
        //dd($tarea);
        //dd($request);
        
        //$tareas = Tarea::all();  
        //return view('tareas.index', ['tareas' => $tareas, 'success' => 'Tarea Actualizada Correctamente.']);

        return redirect()->route('tareas')->with('success','Tarea Actualizada Correctamente.');

    }

    public function destroy($id){
        //Realizar busqueda de tarea
        $tarea = Tarea::find($id);
        //Eliminar de la DB
        $tarea->delete();
        //Redireccionar a index con su alerta
        return redirect()->route('tareas')->with('success','Tarea Eliminada Exitosamente.');
    }
}
