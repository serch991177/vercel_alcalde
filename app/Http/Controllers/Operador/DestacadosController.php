<?php

namespace App\Http\Controllers\Operador;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Destacados;
use App\Models\Entrevistas;
use App\Models\Imagenes;
use App\Models\Propuestas;
use Illuminate\Support\Facades\DB;


class DestacadosController extends Controller
{

    public function index() {

        $data = Destacados::leftJoin('imagenes', 'destacados.id_imagenes', '=', 'imagenes.id_imagenes')
                        ->leftJoin('entrevistas', 'destacados.id_entrevistas', '=', 'entrevistas.id_entrevistas')
                        ->leftJoin('propuestas', 'destacados.id_propuesta', '=', 'propuestas.id_propuesta')
                        ->leftJoin('noticias', 'destacados.id_noticias', '=', 'noticias.id_noticias')
                        ->where('destacados.estado', 'AC')
                        ->select('destacados.id_destacados','destacados.nombre_destacado',
                        DB::raw('(CASE
            WHEN destacados.id_imagenes IS NOT NULL THEN imagenes.me_gustas
            WHEN destacados.id_entrevistas IS NOT NULL THEN entrevistas.me_gustas
            WHEN destacados.id_propuesta IS NOT NULL THEN propuestas.me_gustas
            WHEN destacados.id_noticias IS NOT NULL THEN noticias.me_gustas
            ELSE NULL
        END) AS me_gustas'),
        DB::raw('(CASE
            WHEN destacados.id_imagenes IS NOT NULL THEN imagenes.visitas
            WHEN destacados.id_entrevistas IS NOT NULL THEN entrevistas.visitas
            WHEN destacados.id_propuesta IS NOT NULL THEN propuestas.visitas
            WHEN destacados.id_noticias IS NOT NULL THEN noticias.visitas
            ELSE NULL
        END) AS visitas')
                        )
                        ->get();


        $heads = [
            'ID',
            'Titulo Destacado',
            'Me Gustas',
            'Visitas',
            'Opciones'
        ];

        return view('destacados', compact('data', 'heads'));
    }

    public function get()
    {
        try {
            $data = Destacados::leftJoin('imagenes', 'destacados.id_imagenes', '=', 'imagenes.id_imagenes')
                ->leftJoin('entrevistas', 'destacados.id_entrevistas', '=', 'entrevistas.id_entrevistas')
                ->leftJoin('propuestas', 'destacados.id_propuesta', '=', 'propuestas.id_propuesta')
                ->leftJoin('noticias', 'destacados.id_noticias', '=', 'noticias.id_noticias')
                ->where('destacados.estado', 'AC')
                ->select('destacados.id_destacados', 'destacados.nombre_destacado',
                    DB::raw('(CASE
                        WHEN destacados.id_imagenes IS NOT NULL THEN imagenes.me_gustas
                        WHEN destacados.id_entrevistas IS NOT NULL THEN entrevistas.me_gustas
                        WHEN destacados.id_propuesta IS NOT NULL THEN propuestas.me_gustas
                        WHEN destacados.id_noticias IS NOT NULL THEN noticias.me_gustas
                        ELSE NULL
                        END) AS me_gustas'),
                    DB::raw('(CASE
                        WHEN destacados.id_imagenes IS NOT NULL THEN imagenes.visitas
                        WHEN destacados.id_entrevistas IS NOT NULL THEN entrevistas.visitas
                        WHEN destacados.id_propuesta IS NOT NULL THEN propuestas.visitas
                        WHEN destacados.id_noticias IS NOT NULL THEN noticias.visitas
                        ELSE NULL
                        END) AS visitas')
                )->get();

            return response()->json($data, 200);
        } catch (\Throwable $th) {
            return response()->json(['error' => $th->getMessage()], 500);
        }
    }


        public function create (Request $request){
            try {

                $data = $request->only(['nombre_destacado', 'id_imagenes', 'id_entrevistas', 'id_propuesta', 'id_noticias', 'id_tipo_destacado']);


                $fieldsToCheck = [];


                if ($request->has('id_imagenes')) {
                    $fieldsToCheck['id_imagenes'] = $data['id_imagenes'];
                }


                if ($request->has('id_entrevistas')) {
                    $fieldsToCheck['id_entrevistas'] = $data['id_entrevistas'];
                }


                if ($request->has('id_propuesta')) {
                    $fieldsToCheck['id_propuesta'] = $data['id_propuesta'];
                }


                if ($request->has('id_noticias')) {
                    $fieldsToCheck['id_noticias'] = $data['id_noticias'];
                }


                $existingRecord = Destacados::where($fieldsToCheck)->exists();


                if ($existingRecord) {
                    return response()->json(['error' => 'Ya existe un registro con los mismos valores'], 400);
                }


                $data['estado'] = 'AC';
                $newRecord = Destacados::create($data);


                return response()->json($newRecord, 200);
            } catch (\Throwable $th) {

                return response()->json(['error' => $th->getMessage()], 500);
            }
        }

        public function getById($id){
            try {
                  $data = Destacados::find($id);
                  return response()->json($data,200);
            } catch (\Throwable $th)
            {
                return response()->json(['error' => $th->getMessage()], 500);
            }
        }

        public function update (Request $request,$id){
            try{
                $data ['nombre_destacado'] =$request['nombre_destacado'];
                $data ['id_imagenes'] =$request['id_imagenes'];
                $data ['nombre_destacado'] =$request['nombre_destacado'];
                $data ['id_entrevistas'] =$request['id_entrevistas'];
                $data ['id_proyectos'] =$request['id_proyectos'];
                $data ['id_tipo_destacado'] =$request['id_tipo_destacado'];
                Destacados::find($id)->update($data);
                $res= Destacados::find($id);
                return response()->json($res,200);
            }catch (\Throwable $th)
            {
                return response()->json(['error' => $th->getMessage()], 500);
            }

        }

        public function delete($id){
            try {
                $destacado = Destacados::find($id);

                if ($destacado) {
                    // Cambia el estado del registro a 'DC'
                    $destacado->update(['estado' => 'DC']);

                    return response()->json(["deleted" => $destacado], 200);
                } else {
                    return response()->json(['error' => 'Recurso no encontrado'], 404);
                }
            } catch (\Throwable $th) {
                return response()->json(['error' => $th->getMessage()], 500);
            }
        }
}
