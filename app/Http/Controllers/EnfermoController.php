<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Enfermedad;

class EnfermoController extends Controller
{
    public function index()
    {
        $enfermedades = Enfermedad::all();
        return view('enfermedades.enfermo', compact('enfermedades'));
    }

    public function create()
    {
        return view('enfermedades.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'required|string',
        ]);

        Enfermedad::create($request->all());

        return redirect()->route('enfermedades.index')->with('success', 'Enfermedad registrada correctamente.');
    }
}
