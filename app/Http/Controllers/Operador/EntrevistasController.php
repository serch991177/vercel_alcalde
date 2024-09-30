<?php

namespace App\Http\Controllers\Operador;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Entrevistas;
use App\Models\Categorias;
use App\Models\Imagen;

class EntrevistasController extends Controller
{

    public function index() {

        $data = Entrevistas::join('categorias', 'entrevistas.id_categorias', '=', 'categorias.id_categorias')
                        ->where('entrevistas.estado', 'AC')
                        ->select('entrevistas.*', 'categorias.nombre_categoria')
                        ->get();

        $categorias = Categorias::where([
                            ['estado', '=', 'AC'],
                            ['id_categorias', '>', 3],
                        ])->get();
        $heads = [
            'ID',
            'Titulo Entrevista',
            'Categoria',
            'Estado',
            'Opciones'
        ];

        return view('entrevistas', compact('data', 'heads', 'categorias'));
    }
    public function get(){

        try {
            $data = Entrevistas::join('categorias', 'entrevistas.id_categorias', '=', 'categorias.id_categorias')
            ->where('entrevistas.estado', 'AC')
            ->select('entrevistas.*', 'categorias.nombre_categoria')
            ->get();
            $categorias = Categorias::where([
                ['estado', '=', 'AC'],
                ['id_categorias', '>', 3],
            ])->get();
            return response()-> json($data, 200);

            // Si es una solicitud web, devuelve a la vista
            $heads = [
                'ID',
                'Titulo Entrevista',
                'Categoria',
                'Estado',
                'Opciones'
            ];

            return view('/entrevistas', compact('data', 'heads', 'categorias'));
        } catch (\Throwable $th) {
            return response()->json(['error' => $th->getMessage()], 500);
        }

        }

        public function create (Request $request){
            try{
                $tituloEntrevista = $request['titulo_entrevista'];

                // Verificar si ya existe una categoría con el mismo nombre
                $entrevistaExistente = Entrevistas::where('titulo_entrevista', $tituloEntrevista)
                ->where('estado', 'AC')
                ->first();

                if ($entrevistaExistente) {
                    // Si ya existe, devolver un mensaje de error
                    return response()->json(['error' => 'Ya existe una entrevista con el mismo nombre.'], 400);
                }

                $data ['titulo_entrevista']=$request['titulo_entrevista'];
                $data ['descripcion_entrevista'] =$request['descripcion_entrevista'];
                $data ['link_entrevista'] =$request['link_entrevista'];
                $data ['id_categorias'] =$request['id_categorias'];
                $data ['me_gustas'] =$request['me_gustas'];
                $data ['visitas'] =$request['visitas'];
                $data['fecha_registro'] = now();
                $data ['estado'] = 'AC';
                $res = Entrevistas::create($data);
                return response()->json($res, 200);
            } catch (\Throwable $th)
            {
                return response()->json(['error' => $th->getMessage()], 500);
            }
        }

        public function getById($id){
            try {

                $entrevista = Entrevistas::find($id);

                if(!$entrevista) {
                    return response()->json(['error' => 'Registro no encontrado'], 404);
                }

                $imagenes_asociadas = Imagen::where([
                    ['id_entrevistas', '=', $id],
                    ['estado', '=', 'AC'],
                ])->get();

                return response()->json([
                    'entrevista' => $entrevista,
                    'imagenes_asociadas' => $imagenes_asociadas
                ], 200);
            } catch (\Throwable $th) {
                return response()->json(['error' => $th->getMessage()], 500);
            }
        }

        public function update (Request $request,$id){
            try{
                $data ['titulo_entrevista'] =$request->input('titulo_entrevista');
                $data ['descripcion_entrevista'] =$request->input('descripcion_entrevista');
                $data ['link_entrevista'] =$request->input('link_entrevista');
                $data ['id_categorias'] =$request->input('id_categorias');
                //$data ['me_gustas'] =$request['me_gustas'];
                //$data ['visitas'] =$request['visitas'];
                $data['fecha_registro'] = now();
                Entrevistas::find($id)->update($data);
                $res= Entrevistas::find($id);

                return response()->json(['success' => true, 'message' => 'Entrevista actualizada con éxito'], 200);
    } catch (\Throwable $th) {
        return response()->json(['success' => false, 'error' => $th->getMessage()], 500);
    }

        }

        public function delete($id){
            try {
                $entrevista = Entrevistas::find($id);
                $imagenes_asociadas = Imagen::where('id_imagenes', $id)->get();
                if ($entrevista) {
                    $entrevista->update(['estado' => 'DC']);
                    foreach ($imagenes_asociadas as $imagen_asociada) {
                        $imagen_asociada->update(['estado' => 'DC']);
                        }
                    return response()->json(["deleted" => $entrevista], 200);
                } else {
                    return response()->json(['error' => 'Recurso no encontrado'], 404);
                }
            } catch (\Throwable $th) {
                return response()->json(['error' => $th->getMessage()], 500);
            }
        }

        public function obtenerUltimoIdEntrevistas() {
            try {
                // Busca el último registro en la tabla Imagenes
                $ultimoEntrevista = Entrevistas::orderBy('id_entrevistas', 'desc')->first();


                // Verifica si se encontró algún registro
                if(!$ultimoEntrevista) {
                    // Si no se encontró ningún registro, establece el último id en 0
                    $ultimoId = 0;
                } else {
                    // Si se encontró un registro, obtén su id_imagenes
                    $ultimoId = $ultimoEntrevista->id_entrevistas;
                }

                // Retorna el último id_imagenes encontrado
                return $ultimoId;
            } catch (\Throwable $th) {
                // Maneja cualquier excepción que pueda ocurrir durante la búsqueda
                return response()->json(['error' => $th->getMessage()], 500);
            }
        }
}
