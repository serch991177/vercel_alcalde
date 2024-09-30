<?php

namespace App\Http\Controllers\Operador;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Videos;
use App\Models\Categorias;

class VideosController extends Controller
{

    public function index() {

        $data = Videos::join('categorias', 'videos.id_categorias', '=', 'categorias.id_categorias')
        ->where('videos.estado', 'AC')
        ->select('videos.*', 'categorias.nombre_categoria')
        ->get();

        $categorias = Categorias::where([
            ['estado', '=', 'AC'],
            ['id_categorias', '>', 3],
        ])->get();
        $heads = [
            'ID',
            'Titulo Video',
            'Categoria',
            'Estado',
            'Opciones'
        ];

        return view('videos', compact('data', 'heads','categorias'));
    }

    public function get(Request $request){

        try {
            $data = Videos::join('categorias', 'videos.id_categorias', '=', 'categorias.id_categorias')
            ->where('videos.estado', 'AC')
            ->select('videos.*', 'categorias.nombre_categoria')
            ->get();
            $categorias = Categorias::where([
                ['estado', '=', 'AC'],
                ['id_categorias', '>', 3],
            ])->get();
            return response()-> json($data, 200);

            // Si es una solicitud web, devuelve a la vista
            $heads = [
                'ID',
                'Titulo Video',
                'Categoria',
                'Estado',
                'Opciones'
            ];

            return view('/videos', compact('data', 'heads', 'categorias'));
        } catch (\Throwable $th) {
            return response()->json(['error' => $th->getMessage()], 500);
        }

        }

        public function create(Request $request) {
            try {

                $tituloVideo = $request['titulo_video'];

                // Verificar si ya existe una categoría con el mismo nombre
                $videoExistente = Videos::where('titulo_video', $tituloVideo)
                ->where('estado', 'AC')
                ->first();

                if ($videoExistente) {
                    // Si ya existe, devolver un mensaje de error
                    return response()->json(['error' => 'Ya existe una video con el mismo nombre.'], 400);
                }

                // Si no existe, proceder con la creación
                $data ['titulo_video'] =$request['titulo_video'];
                $data ['descripcion_video'] =$request['descripcion_video'];
                $data ['url'] =$request['url'];
                $data['url'] = htmlspecialchars($data['url'], ENT_QUOTES, 'UTF-8');
                $data ['id_categorias'] =$request['id_categorias'];
                $data['fecha_registro'] = now();
                $data ['estado'] = 'AC';
                $res = Videos::create($data);

                return response()->json($res, 200);
            } catch (\Throwable $th) {
                return response()->json(['error' => $th->getMessage()], 500);
            }
        }


        public function getById($id){
            try {
                  $data = Videos::find($id);
                  return response()->json($data,200);
            } catch (\Throwable $th)
            {
                return response()->json(['error' => $th->getMessage()], 500);
            }
        }

        public function update(Request $request, $id)
{
    try{
                $data ['titulo_video'] =$request->input('titulo_video');
                $data ['descripcion_video'] =$request->input('descripcion_video');
                $data ['url'] =$request->input('url');
                $data ['id_categorias'] =$request->input('id_categorias');
                Videos::find($id)->update($data);
                $res= Videos::find($id);
                return response()->json(['success' => true, 'message' => 'Video actualizado con éxito'], 200);
            }catch (\Throwable $th)
        {
            return response()->json(['success' => false, 'error' => $th->getMessage()], 500);
        }
}

public function delete($id){
    try {
        $video = Videos::find($id);

        if ($video) {
            // Cambia el estado del registro a 'DC'
            $video->update(['estado' => 'DC']);

            return response()->json(["deleted" => $video], 200);
        } else {
            return response()->json(['error' => 'Recurso no encontrado'], 404);
        }
    } catch (\Throwable $th) {
        return response()->json(['error' => $th->getMessage()], 500);
    }
}
}
