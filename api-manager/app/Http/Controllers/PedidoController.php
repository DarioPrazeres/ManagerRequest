<?php

namespace App\Http\Controllers;

use App\Models\Pedido;
use App\Models\Material;
use Illuminate\Http\Request;

class PedidoController extends Controller
{
    public function index()
    {
        //$pedidos = Pedido::where('status', '!=', 'Rejeitado')->get();
        //$pedidos = Pedido::all();
        $pedidos = Pedido::with('grupo')->where('status', '!=', 'Rejeitado')->get();
        return view('pedidos.index', compact('pedidos'));
    }

    public function create()
    {
        $materiais = Material::all();
        return view('pedidos.create', compact('materiais'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'materiais' => 'required|array',
            'materiais.*.quantidade' => 'required|integer|min:0',
        ]);

        // Criar o pedido
        $pedido = new Pedido();
        $pedido->solicitante_id = auth()->user()->solicitante->id;
        $pedido->grupo_id = auth()->user()->solicitante->grupo->id;
        $pedido->status = 'Novo';
        $pedido->total = $this->calcularTotal($request->materiais);
        $pedido->save();

        // Vincular materiais ao pedido
        foreach ($request->materiais as $material_id => $detalhes) {
            $pedido->materiais()->attach($material_id, [
                'quantidade' => $detalhes['quantidade'],
                'subtotal' => $detalhes['quantidade'] * Material::find($material_id)->preco,
            ]);
        }

        return redirect()->route('pedidos.index')->with('success', 'Pedido criado com sucesso!');
    }

    // Calcula o total do pedido
    private function calcularTotal($materiais)
    {
        $total = 0;
        foreach ($materiais as $material_id => $detalhes) {
            $material = Material::find($material_id);
            $total += $detalhes['quantidade'] * $material->preco;
        }
        return $total;
    }

    public function show(Pedido $pedido)
    {
        return view('pedidos.show', compact('pedido'));
    }


    public function edit(Pedido $pedido)
    {
        return view('pedidos.edit', compact('pedido'));
    }

    public function update(Request $request, Pedido $pedido)
    {
        //
    }

    public function destroy(Pedido $pedido)
    {
        //
    }

    public function aprovar(Pedido $pedido, Request $request)
    {
        // Verificar se o pedido tem um grupo associado
        $grupo = $pedido->grupo;
    
        if (!$grupo) {
            return redirect()->route('pedidos.index')
                ->with('error', 'Este pedido não está associado a um grupo.');
        }
    
        // Verificar saldo permitido do grupo
        if ($pedido->total <= $request->saldoPermitido) {
            $pedido->status = 'Aprovado';
    
            $grupo->saldoPermitido -= $pedido->total;    
            
            //$pedido->update([
            //'status' => $pedido->status,]);
            $pedido->save();
            $grupo->save();
    
            return redirect()->route('pedidos.index')
                ->with('success', 'Pedido aprovado com sucesso');
        } else {
            $pedido->status = 'Aprovado';
            $pedido->save();
            return redirect()->route('pedidos.index')
                ->with('error', 'Saldo insuficiente para aprovar o pedido');
        }
    }
    

    public function solicitarAlteracoes(Pedido $pedido, Request $request)
    {
        // Validação dos dados do pedido
        $validated = $request->validate([
            'comentario' => 'nullable|string',
            'total' => 'nullable|numeric',
            'grupo_id' => 'required|exists:grupos,id',
            'solicitante_id' => 'required|exists:solicitantes,id',
        ]);
    
        if (!$pedido) {
            return redirect()->route('pedidos.index')
                ->with('error', 'Pedido não encontrado.');
        }

        // Atualizando os atributos do pedido com os dados do request
        $pedido->status = 'Alterações Solicitadas';
        $pedido->comentario_aprovador = $request->comentario;
        $pedido->total = $request->total ?: 0;
        $pedido->grupo_id = $request->grupo_id;
        $pedido->solicitante_id = $request->solicitante_id;
    
        // Salvando a instância do pedido com as alterações
        $pedido-> update($request->all());
    
        // Redirecionar para a lista de pedidos com mensagem de sucesso
        return redirect()->route('pedidos.index')
            ->with('success', 'Alterações solicitadas com sucesso');
    }
    

    public function rejeitar(Pedido $pedido)
    {
        $pedido->status = 'Rejeitado';
        $pedido->update([
            'status' => $pedido->status,]);

        return redirect()->route('pedidos.index')
            ->with('success', 'Pedido rejeitado');
    }
}
