<?php

namespace App\Http\Controllers\Operador;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Noticias;
use App\Models\Categorias;
use App\Models\Imagen;
class NoticiasController extends Controller
{

    public function index() {

        $data = Noticias::join('categorias', 'noticias.id_categorias', '=', 'categorias.id_categorias')
                        ->where('noticias.estado', 'AC')
                        ->select('noticias.*', 'categorias.nombre_categoria')
                        ->get();

                        $categorias = Categorias::where([
                            ['estado', '=', 'AC'],
                            ['id_categorias', '>', 3],
                        ])->get();
        $heads = [
            'ID',
            'Titulo Noticia',
            'Categoria',
            'Estado',
            'Opciones'
        ];

        return view('noticias', compact('data', 'heads', 'categorias'));
    }


    public function get(){

        try {
            $data = Noticias::join('categorias', 'noticias.id_categorias', '=', 'categorias.id_categorias')
            ->where('noticias.estado', 'AC')
            ->select('noticias.*', 'categorias.nombre_categoria')
            ->get();
            $categorias = Categorias::where([
                ['estado', '=', 'AC'],
                ['id_categorias', '>', 3],
            ])->get();
            return response()-> json($data, 200);

            // Si es una solicitud web, devuelve a la vista
            $heads = [
                'ID',
                'Titulo Noticias',
                'Categoria',
                'Estado',
                'Opciones'
            ];

            return view('/noticias', compact('data', 'heads', 'categorias'));
        } catch (\Throwable $th) {
            return response()->json(['error' => $th->getMessage()], 500);
        }

        }

        public function create (Request $request){
            try{
                $tituloNoticia = $request['titulo_noticia'];


                $noticiaExistente = Noticias::where('titulo_noticia', $tituloNoticia)
                ->where('estado', 'AC')
                ->first();

                if ($noticiaExistente) {

                    return response()->json(['error' => 'Ya existe una noticia con el mismo nombre.'], 400);
                }

                $data ['titulo_noticia'] =$request['titulo_noticia'];
                $data ['descripcion_noticia'] =$request['descripcion_noticia'];
                $data ['id_categorias'] =$request['id_categorias'];
                $data ['id_noticias'] =$request['id_noticias'];
                $data ['me_gustas'] =$request['me_gustas'];
                $data ['visitas'] =$request['visitas'];
                $data['fecha_registro'] = now();
                $data ['estado'] = 'AC';
                $res = Noticias::create($data);
                return response()->json($res, 200);
            } catch (\Throwable $th)
            {
                return response()->json(['error' => $th->getMessage()], 500);
            }
        }

        public function getById($id){
            try {

                $noticia = Noticias::find($id);

                if(!$noticia) {
                    return response()->json(['error' => 'Registro no encontrado'], 404);
                }

                $imagenes_asociadas = Imagen::where([
                    ['id_noticias', '=', $id],
                    ['estado', '=', 'AC'],
                ])->get();

                return response()->json([
                    'noticia' => $noticia,
                    'imagenes_asociadas' => $imagenes_asociadas
                ], 200);
            } catch (\Throwable $th) {
                return response()->json(['error' => $th->getMessage()], 500);
            }
        }

        public function update (Request $request,$id){
            try{
                $data ['titulo_noticia'] =$request->input('titulo_noticia');
                $data ['descripcion_noticia'] =$request->input('descripcion_noticia');
                $data ['id_categorias'] =$request->input('id_categorias');
                $data ['id_noticias'] =$request->input('id_noticias');
                //$data ['me_gustas'] =$request->('me_gustas');
                //$data ['visitas'] =$request->('visitas');
                $data['fecha_registro'] = now();
                Noticias::find($id)->update($data);
                $res= Noticias::find($id);
                return response()->json(['success' => true, 'message' => 'Noticia actualizada con éxito'], 200);
    } catch (\Throwable $th) {
        return response()->json(['success' => false, 'error' => $th->getMessage()], 500);
    }

        }

        public function delete($id){
            try {
                $noticia = Noticias::find($id);

                if ($noticia) {
                    // Cambia el estado del registro a 'DC'
                    $noticia->update(['estado' => 'DC']);

                    return response()->json(["deleted" => $noticia], 200);
                } else {
                    return response()->json(['error' => 'Recurso no encontrado'], 404);
                }
            } catch (\Throwable $th) {
                return response()->json(['error' => $th->getMessage()], 500);
            }
        }

        public function obtenerUltimoIdNoticias() {
            try {

                $ultimoNoticia = Noticias::orderBy('id_noticias', 'desc')->first();

                if(!$ultimoNoticia) {
                    $ultimoId = 0;
                } else {
                    $ultimoId = $ultimoNoticia->id_noticias;
                }
                return $ultimoId;
            } catch (\Throwable $th) {

                return response()->json(['error' => $th->getMessage()], 500);
            }
        }




}
