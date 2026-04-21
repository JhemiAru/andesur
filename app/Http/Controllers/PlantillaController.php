<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Plantilla;
use App\Models\Compra;
use Illuminate\Support\Facades\Auth;

class PlantillaController extends Controller
{
    /**
     * Mostrar catálogo de plantillas
     */
    public function index()
    {
        $plantillas = Plantilla::all();

        return view('plantillas.index', compact('plantillas'));
    }

    /**
     * Mostrar una plantilla específica
     */
    public function show($id)
    {
        $plantilla = Plantilla::findOrFail($id);

        // 🔒 PROTEGER PLANTILLAS PREMIUM
        if ($plantilla->tipo === 'premium') {

            // Si no está logueado
            if (!Auth::check()) {
                return redirect('/login')->with('success', 'Debes iniciar sesión para acceder');
            }

            // Verificar si ya compró
            $comprada = Compra::where('user_id', Auth::id())
                ->where('plantilla_id', $id)
                ->exists();

            if (!$comprada) {
                return redirect('/')->with('success', 'Debes comprar esta plantilla');
            }
        }

        return view('plantillas.show', compact('plantilla'));
    }
}