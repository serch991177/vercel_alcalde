<?php

namespace App\Http\Controllers\Operador;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Biografia;

class BiografiaController extends Controller
{

    public function index() {

        $data = Biografia::where('estado', 'AC')->get();
        $heads = [
            'ID',
            'Biografia español',
            'Biografia ingles',
            'Estado',
            'Opciones'
        ];

        return view('biografias', compact('data', 'heads'));
    }

    public function get(Request $request){

        try {
            $data = Biografia::where('estado', 'AC')->get();

            return response()-> json($data, 200);

            // Si es una solicitud web, devuelve a la vista
            $heads = [
                'ID',
                'Biografia español',
                'Biografia ingles',
                'Estado',
                'Opciones'
            ];

            return view('/biografias', compact('data', 'heads'));
        } catch (\Throwable $th) {
            return response()->json(['error' => $th->getMessage()], 500);
        }

        }


        public function getById($id){
            try {
                  $data = Biografia::find($id);
                  return response()->json($data,200);
            } catch (\Throwable $th)
            {
                return response()->json(['error' => $th->getMessage()], 500);
            }
        }

        public function update(Request $request, $id)
{
    try {
        $biografia_spanish = $request->input('biografia_spanish');
        $biografia_english = $request->input('biografia_english');

        if (!empty($biografia_spanish)) {
            Biografia::find($id)->update(['biografia_spanish' => $biografia_spanish]);
        }
        
        if (!empty($biografia_english)) {
            Biografia::find($id)->update(['biografia_english' => $biografia_english]);
        }
        $res = Biografia::find($id);

        return response()->json(['success' => true, 'message' => 'Biografia actualizada con éxito'], 200);
    } catch (\Throwable $th) {
        return response()->json(['success' => false, 'error' => $th->getMessage()], 500);
    }
}

public function delete($id){
    try {
        $biografia = Biografia::find($id);

        if ($biografia) {
            // Cambia el estado del registro a 'DC'
            $biografia->update(['estado' => 'DC']);

            return response()->json(["deleted" => $biografia], 200);
        } else {
            return response()->json(['error' => 'Recurso no encontrado'], 404);
        }
    } catch (\Throwable $th) {
        return response()->json(['error' => $th->getMessage()], 500);
    }
}
}
