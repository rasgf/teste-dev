<?php

namespace App\Http\Controllers;

use App\Models\Contato;
use Illuminate\Http\Request;

class UsuarioController extends Controller
{
    public function listarContatos()
    {
        try {
            $contatos = Contato::all();
            return response()->json($contatos);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Erro ao listar contatos'], 500);
        }
    }

    public function registrarContato(Request $request)
    {
        try {
            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'telefone' => 'required|string|max:20',
                'idade' => 'required|integer',
                'cep' => 'required|string|max:9',
                'rua' => 'required|string|max:255',
                'numero' => 'required|string|max:10',
                'complemento' => 'nullable|string|max:255',
                'cidade' => 'required|string|max:255',
                'estado' => 'required|string|max:2'
            ]);

            $contato = Contato::create($validated);
            return response()->json($contato, 201);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Erro ao registrar contato'], 500);
        }
    }

    public function atualizarContato(Request $request, Contato $contato)
    {
        try {
            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'telefone' => 'required|string|max:20',
                'idade' => 'required|integer',
                'cep' => 'required|string|max:9',
                'rua' => 'required|string|max:255',
                'numero' => 'required|string|max:10',
                'complemento' => 'nullable|string|max:255',
                'cidade' => 'required|string|max:255',
                'estado' => 'required|string|max:2'
            ]);

            $contato->update($validated);
            return response()->json($contato);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Erro ao atualizar contato'], 500);
        }
    }

    public function deletarContato(Contato $contato)
    {
        try {
            $contato->delete();
            return response()->json(null, 204);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Erro ao deletar contato'], 500);
        }
    }
}