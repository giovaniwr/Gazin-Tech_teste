<?php

namespace App\Http\Controllers;

use App\Http\Requests\NivelRequest;
use App\Models\Desenvolvedor;
use App\Models\Nivel;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Throwable;

class NivelController extends Controller
{
    public function index(Request $request)
    {
        $data = Nivel::all();
        return response()->json([
            'data' => $data,
            'message' => 'Data retrieved successfully'
        ]);
    }
    public function show(Request $request, int $id)
    {
        $nivel = Nivel::find($id);

        if (!$nivel) {
            return response()->json(['error' => 'Nivel não encontrado'], 404);
        }

        return response()->json([
            "data"=>$nivel
        ]);

    }

    public function create(NivelRequest $request)
    {
        $data = $request->only([
            'nivel'
        ]);
        try {

            $nivelDesenv = new nivel();
            $nivelDesenv->nivel = $data['nivel'];
            $nivelDesenv->save();

            return response()->json($nivelDesenv, 201);
        }catch (Throwable $exception) {
            $this->handleErrorResponse($exception);
        }
        return $this->errorResponse();

    }

    public function update(NivelRequest $request, $id)
    {
        $data = $request->only([
            'nivel'
        ]);
        try {
            $nivelDesenv = Nivel::find($id);

            if (!$nivelDesenv) {
                return response()->json(['error' => 'Nivel não encontrado'], 400);
            }

            $nivelDesenv->nivel = $data['nivel'];
            $nivelDesenv->save();

            return response()->json([
                'data' => $nivelDesenv,
                'message' => 'Data updated successfully',
            ], $status = 200);
        }catch (Throwable $exception) {
            $this->handleErrorResponse($exception);
        }
        return $this->errorResponse();

    }

    public function destroy($id)
    {
        $nivel = Nivel::find($id);

        if (!$nivel) {
            return response()->json(['error' => 'Nivel não encontrado'], 404);
        }
        $denvolvedoresNoNivel = Desenvolvedor::query()
        ->where('nivelId','=',$nivel->id)
        ->count();

        if($denvolvedoresNoNivel > 0) {
            return response()->json(['error'=> 'Já existe um desenvolvedor neste Nivel'],400);
        }

        $nivel->delete();

        return response()->json([
            'message' => 'Data deleted successfully'
        ]);
    }


}
