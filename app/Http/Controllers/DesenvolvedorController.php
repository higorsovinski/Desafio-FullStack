<?php

namespace App\Http\Controllers;

use App\Models\Desenvolvedor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DesenvolvedorController extends Controller
{

    public function view()
    {
        return view('desenvolvedores');
    }

    public function index()
    {
        $desenvolvedores = Desenvolvedor::with('nivel')->get();
        return response()->json($desenvolvedores, 200);
    }

    public function show($id)
    {
        $desenvolvedor = Desenvolvedor::with('nivel')->findOrFail($id);
        return response()->json($desenvolvedor, 200);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nivel_id' => 'required|exists:niveis,id',
            'nome' => 'required|string',
            'sexo' => 'required|string|in:M,F',
            'datanascimento' => 'required|date',
            'hobby' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        try {
            $desenvolvedor = Desenvolvedor::create($request->all());
            return response()->json($desenvolvedor, 201);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Erro ao criar desenvolvedor.', 'error' => $e->getMessage()], 500);
        }
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'nivel_id' => 'exists:niveis,id',
            'nome' => 'string',
            'sexo' => 'string|in:M,F',
            'datanascimento' => 'date',
            'hobby' => 'string',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        try {
            $desenvolvedor = Desenvolvedor::findOrFail($id);
            $desenvolvedor->update($request->all());
            return response()->json($desenvolvedor, 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Erro ao atualizar desenvolvedor.', 'error' => $e->getMessage()], 500);
        }
    }

    public function destroy($id)
    {
        try {
            $desenvolvedor = Desenvolvedor::findOrFail($id);
            $desenvolvedor->delete();
            return response()->json(['message' => 'Desenvolvedor excluído com sucesso.'], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Erro ao excluir desenvolvedor.', 'error' => $e->getMessage()], 500);
        }
    }
}
