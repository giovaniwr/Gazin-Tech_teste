<?php

namespace App\Http\Controllers;

use App\Http\Requests\DesenvolvedorRequest;
use App\Models\Desenvolvedor;

class DesenvolvedorController extends Controller
{
    public function index()
    {
        $desenvolvedores = Desenvolvedor::query()
            ->with("nivel")
            ->get();

        return response()->json($desenvolvedores);
    }

    public function create(DesenvolvedorRequest $request)
    {
        $desenvolvedor = new Desenvolvedor;
        $desenvolvedor->nome = $request->nome;
        $desenvolvedor->nivelId = $request->nivelId;
        $desenvolvedor->sexo = $request->sexo;
        $desenvolvedor->datanascimento = $request->datanascimento;
        $desenvolvedor->idade = $request->idade;
        $desenvolvedor->hobby = $request->hobby;
        $desenvolvedor->save();
        return response()->json($desenvolvedor, 201);
    }

    public function show($id)
    {
        $desenvolvedor = Desenvolvedor::findOrFail($id);
        return response()->json($desenvolvedor);
    }

    public function update(DesenvolvedorRequest $request, $id)
    {
        $desenvolvedor = Desenvolvedor::findOrFail($id);
        $desenvolvedor->nome = $request->nome;
        $desenvolvedor->nivelId = $request->nivelId;
        $desenvolvedor->sexo = $request->sexo;
        $desenvolvedor->datanascimento = $request->datanascimento;
        $desenvolvedor->idade = $request->idade;
        $desenvolvedor->hobby = $request->hobby;
        $desenvolvedor->save();
        return response()->json($desenvolvedor);
    }

    public function destroy($id)
    {
        $desenvolvedor = Desenvolvedor::findOrFail($id);
        $desenvolvedor->delete();
        return response()->json(null, 204);
    }
}
