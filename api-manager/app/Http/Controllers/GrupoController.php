<?php

namespace App\Http\Controllers;

use App\Models\Grupo;
use Illuminate\Http\Request;

class GrupoController extends Controller
{
    public function index()
    {
        
        $grupos = Grupo::all();
        return view('grupos.index', compact('grupos'));
    }

    public function create()
    {
        return view('grupos.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nome' => 'required',
            'saldoPermitido' => 'required|numeric',
            'aprovador_id' => 'required|exists:usuarios,id',
        ]);

        Grupo::create($request->all());
        return redirect()->route('grupos.index')->with('success', 'Grupo criado com sucesso!');
    }

    public function updateSaldo(Request $request, $id)
    {
        $grupo = Grupo::find($id);
        $grupo->saldoPermitido = $request->saldoPermitido;
        $grupo->save();

        return redirect()->back()->with('success', 'Saldo do grupo atualizado com sucesso!');
    }

    public function show(Grupo $grupo)
    {
        //
    }

    public function edit(Grupo $grupo)
    {
        //
    }

    public function update(Request $request, Grupo $grupo)
    {
        //
    }

    public function destroy(Grupo $grupo)
    {
        //
    }
}
