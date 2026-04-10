<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Plantilla;

class PlantillaController extends Controller
{
    // Mostrar catálogo
    public function index()
    {
        $plantillas = Plantilla::all();
        return view('catalogo', compact('plantillas'));
    }

    // Ver plantilla
    public function ver($id)
    {
        $plantilla = Plantilla::findOrFail($id);
        return redirect('/plantillas/' . $plantilla->carpeta . '/index.html');
    }

    // Mostrar formulario
    public function crear()
    {
        return view('crear');
    }

    // Guardar nueva plantilla
    public function guardar(Request $request)
    {
        $request->validate([
            'nombre' => 'required',
            'descripcion' => 'required',
            'imagen' => 'required|image',
            'carpeta' => 'required'
        ]);

        // Guardar imagen
        $imagen = time() . '.' . $request->imagen->extension();
        $request->imagen->move(public_path('imagenes'), $imagen);

        // Guardar en BD
        Plantilla::create([
            'nombre' => $request->nombre,
            'descripcion' => $request->descripcion,
            'imagen' => $imagen,
            'carpeta' => $request->carpeta
        ]);

        return redirect('/')->with('success', 'Plantilla agregada');
    }
}