<?php

namespace App\Http\Controllers;

use App\Models\Solicitante;
use Illuminate\Http\Request;

class SolicitanteController extends Controller
{
    public function index()
    {
        $solicitantes = Solicitante::with('grupo', 'user')->get();
        return view('solicitantes.index', compact('solicitantes'));
    }

    public function dashboard()
    {
        return view('solicitantes.dashboard');
    }

    public function create()
    {
        return view('solicitantes.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'usuario_id' => 'required|exists:usuarios,id',
            'grupo_id' => 'required|exists:grupos,id',
        ]);

        Solicitante::create($request->all());
        return redirect()->route('solicitantes.index')->with('success', 'Solicitante criado com sucesso!');
    }

    public function show(Solicitante $solicitante)
    {
        //
    }

    public function edit(Solicitante $solicitante)
    {
        //
    }

    public function update(Request $request, Solicitante $solicitante)
    {
        //
    }


    public function destroy(Solicitante $solicitante)
    {
        //
    }
}
