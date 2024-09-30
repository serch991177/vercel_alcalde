<?php

namespace App\Http\Controllers\Operador;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Imagenes;
use App\Models\Imagen;
use App\Models\Categorias;

class ImagenesController extends Controller
{

    public function index() {

        $data = Imagenes::join('categorias', 'imagenes.id_categorias', '=', 'categorias.id_categorias')
                        ->where('imagenes.estado', 'AC')
                        ->select('imagenes.*', 'categorias.nombre_categoria')
                        ->get();

                        $categorias = Categorias::where([
                            ['estado', '=', 'AC'],
                            ['id_categorias', '<=', 3],
                        ])->get();
        $heads = [
            'ID',
            'Titulo imagen',
            'Categoria',
            'Estado',
            'Opciones'
        ];

        return view('imagenes', compact('data', 'heads', 'categorias'));
    }
    public function get(){

        try {
            $data = Imagenes::join('categorias', 'imagenes.id_categorias', '=', 'categorias.id_categorias')
            ->where('imagenes.estado', 'AC')
            ->select('imagenes.*', 'categorias.nombre_categoria')
            ->get();
            $categorias = Categorias::where([
                ['estado', '=', 'AC'],
                ['id_categorias', '<=', 3],
            ])->get();
            return response()-> json($data, 200);

            $heads = [
                'ID',
                'Titulo Entrevista',
                'Categoria',
                'Estado',
                'Opciones'
            ];

            return view('/imagenes', compact('data', 'heads', 'categorias'));
        } catch (\Throwable $th) {
            return response()->json(['error' => $th->getMessage()], 500);
        }

        }

        public function create (Request $request){
            try{

                $tituloImagen = $request['titulo_imagen'];

                $imagenExistente = Imagenes::where('titulo_imagen', $tituloImagen)
                ->where('estado', 'AC')
                ->first();

                if ($imagenExistente) {

                    return response()->json(['error' => 'Ya existe una imagen con el mismo nombre.'], 400);
                }

                $data ['titulo_imagen'] =$request['titulo_imagen'];
                $data ['descripcion_imagen'] =$request['descripcion_imagen'];
                $data ['id_categorias'] =$request['id_categorias'];
                $data['fecha_registro'] = now();
                $data ['estado'] = 'AC';
                $res = Imagenes::create($data);


                return response()->json($res, 200);
            } catch (\Throwable $th)
            {
                return response()->json(['error' => $th->getMessage()], 500);
            }
        }

        public function getById($id){
            try {

                $imagen = Imagenes::find($id);

                if(!$imagen) {
                    return response()->json(['error' => 'Registro no encontrado'], 404);
                }

                $imagenes_asociadas = Imagen::where([
                    ['id_imagenes', '=', $id],
                    ['estado', '=', 'AC'],
                ])->get();

                return response()->json([
                    'imagen' => $imagen,
                    'imagenes_asociadas' => $imagenes_asociadas
                ], 200);
            } catch (\Throwable $th) {
                return response()->json(['error' => $th->getMessage()], 500);
            }
        }

        public function update (Request $request,$id){
            try{
                $data ['titulo_imagen'] =$request->input('titulo_imagen');
                $data ['descripcion_imagen'] =$request->input('descripcion_imagen');
                $data ['id_categorias'] =$request->input('id_categorias');
                $data ['id_noticias'] =$request->input('id_noticias');
                $data ['me_gustas'] =$request->input('me_gustas');
                $data ['visitas'] =$request->input('visitas');
                $data['fecha_edicion'] = now();
                Imagenes::find($id)->update($data);
                $res= Imagenes::find($id);
                return response()->json(['success' => true, 'message' => 'Imagen actualizada con éxito'], 200);
                } catch (\Throwable $th) {
                    return response()->json(['success' => false, 'error' => $th->getMessage()], 500);
                }

        }

        public function delete($id){
            try {
                $imagen = Imagenes::find($id);
                $imagenes_asociadas = Imagen::where('id_imagenes', $id)->get();
                if ($imagen) {

                    $imagen->update(['estado' => 'DC']);
                    foreach ($imagenes_asociadas as $imagen_asociada) {
                    $imagen_asociada->update(['estado' => 'DC']);
                    }

                    return response()->json(["deleted" => $imagen], 200);
                } else {
                    return response()->json(['error' => 'Recurso no encontrado'], 404);
                }
            } catch (\Throwable $th) {
                return response()->json(['error' => $th->getMessage()], 500);
            }
        }

        public function obtenerUltimoIdImagenes() {
            try {
                $ultimoImagen = Imagenes::orderBy('id_imagenes', 'desc')->first();

                if(!$ultimoImagen) {
                    $ultimoId = 0;
                } else {
                    $ultimoId = $ultimoImagen->id_imagenes;
                }

                return $ultimoId;
            } catch (\Throwable $th) {

                return response()->json(['error' => $th->getMessage()], 500);
            }
        }

}
