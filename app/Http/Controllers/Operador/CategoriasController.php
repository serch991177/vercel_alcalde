<?php

namespace App\Http\Controllers\Operador;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Categorias;

class CategoriasController extends Controller
{

    public function index() {

        $data = Categorias::where([
            ['estado', '=', 'AC'],
            ['id_categorias', '>', 3],
        ])->get();
        $heads = [
            'ID',
            'Nombre Categoria',
            'Estado',
            'Opciones'
        ];

        return view('categorias', compact('data', 'heads'));
    }

    public function get(Request $request){

        try {
            $data = Categorias::where([
                ['estado', '=', 'AC'],
                ['id_categorias', '>', 3],
            ])->get();

            return response()-> json($data, 200);

            // Si es una solicitud web, devuelve a la vista
            $heads = [
                'ID',
                'Nombre Categoria',
                'Estado',
                'Opciones'
            ];

            return view('/categorias', compact('data', 'heads'));
        } catch (\Throwable $th) {
            return response()->json(['error' => $th->getMessage()], 500);
        }

        }

        public function create(Request $request) {
            try {
                // Obtener el nombre de la categoría desde la solicitud
                $nombreCategoria = $request['nombre_categoria'];

                // Verificar si ya existe una categoría con el mismo nombre
                $categoriaExistente = Categorias::where('nombre_categoria', $nombreCategoria)
                ->where('estado', 'AC')
                ->first();

                if ($categoriaExistente) {
                    // Si ya existe, devolver un mensaje de error
                    return response()->json(['error' => 'Ya existe una categoría con el mismo nombre.'], 400);
                }

                // Si no existe, proceder con la creación
                $data['nombre_categoria'] = $nombreCategoria;
                $data['estado'] = 'AC';
                $res = Categorias::create($data);

                return response()->json($res, 200);
            } catch (\Throwable $th) {
                return response()->json(['error' => $th->getMessage()], 500);
            }
        }


        public function getById($id){
            try {
                  $data = Categorias::find($id);
                  return response()->json($data,200);
            } catch (\Throwable $th)
            {
                return response()->json(['error' => $th->getMessage()], 500);
            }
        }

        public function update(Request $request, $id)
{
    try {
        $data['nombre_categoria'] = $request->input('nombre_categoria');
        Categorias::find($id)->update($data);
        $res = Categorias::find($id);

        return response()->json(['success' => true, 'message' => 'Categoría actualizada con éxito'], 200);
    } catch (\Throwable $th) {
        return response()->json(['success' => false, 'error' => $th->getMessage()], 500);
    }
}

public function delete($id){
    try {
        $categoria = Categorias::find($id);

        if ($categoria) {
            // Cambia el estado del registro a 'DC'
            $categoria->update(['estado' => 'DC']);

            return response()->json(["deleted" => $categoria], 200);
        } else {
            return response()->json(['error' => 'Recurso no encontrado'], 404);
        }
    } catch (\Throwable $th) {
        return response()->json(['error' => $th->getMessage()], 500);
    }
}
}
