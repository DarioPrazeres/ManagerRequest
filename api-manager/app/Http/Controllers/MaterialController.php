<?php

namespace App\Http\Controllers;

use App\Models\Material;
use Illuminate\Http\Request;

class MaterialController extends Controller
{
    public function index()
    {
        $materials = Material::latest()->paginate(10);
        return view('materials.index', compact('materials'))->with('i',(request()->input('page', 1)));
    }

    public function create()
    {
        return view('materials.create');
    }

    
    public function store(Request $request)
    {
        $request->validate([
            'nome' => 'required|string|max:255',
            'preco' => 'required|numeric',
            'photoMaterial' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        if ($request->hasFile('photoMaterial')) {
             $imageContent = base64_encode(file_get_contents($request->file('photoMaterial')->getRealPath()));
        }

        Material::create([
            'nome' => $request->nome,
            'preco' => $request->preco,
            'photoMaterial' => $imageContent, 
        ]);

        //Material::create($request->all());
        return redirect()->route('materials.index')->with('success','Material created successfully.');
    }

    public function show(Material $material)
    {
        return view('materials.show', compact('material'));
    }

    public function edit(Material $material)
    {
        return view('materials.edit', compact('material'));
    }

    public function update(Request $request, Material $material)
    {
        $request->validate([
            'nome' => 'required',
            'preco' => 'required',
        ]);
        $material -> update($request->all());
        return redirect()->route('materials.index')->with('sucess','User Update sucessfull');
    }

    public function destroy(Material $material)
    {
        $material->delete();
        return redirect()->route('materials.index')->with('success', 'Material removido com sucesso!');
    }
}
