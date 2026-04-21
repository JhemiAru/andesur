<?php

namespace App\Http\Controllers;

use App\Models\Compra;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CompraController extends Controller
{
    public function comprar(Request $request, $id)
    {
        // Evitar compras duplicadas (PRO 🔥)
        if (Compra::where('user_id', Auth::id())
            ->where('plantilla_id', $id)
            ->exists()) {

            return back()->with('success', 'Ya compraste esta plantilla');
        }

        Compra::create([
            'user_id' => Auth::id(),
            'plantilla_id' => $id,
            'precio' => $request->precio
        ]);

        return redirect()->back()->with('success', 'Compra realizada correctamente');
    }
}