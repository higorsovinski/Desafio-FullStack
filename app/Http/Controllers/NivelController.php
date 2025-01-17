<?php

namespace App\Http\Controllers;

use App\Models\Nivel;
use App\Models\Desenvolvedor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class NivelController extends Controller
{

    public function view()
    {
        return view('niveis');
    }

    public function index()
    {
        $niveis = Nivel::all();
        return response()->json($niveis, 200);
    }

    public function show($id)
    {
        return Nivel::findOrFail($id);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nivel' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        try {
            $nivel = Nivel::create($request->only('nivel'));
            return response()->json($nivel, 201);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Erro ao criar nível.', 'error' => $e->getMessage()], 500);
        }
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'nivel' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        try {
            $nivel = Nivel::findOrFail($id);
            $nivel->update($request->only('nivel'));
            return response()->json($nivel, 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Erro ao atualizar nível.', 'error' => $e->getMessage()], 500);
        }
    }


    public function destroy($id)
    {
        $nivel = Nivel::findOrFail($id);

        $desenvolvedores = Desenvolvedor::where('nivel_id', $id)->get();
        if ($desenvolvedores->isNotEmpty()) {
            return response()->json(['message' => 'Não é possível excluir o nível pois existem desenvolvedores associados a ele.'], 400);
        }

        $nivel->delete();
        return response()->json(['message' => 'Nível excluído com sucesso.'], 200);
    }

}
