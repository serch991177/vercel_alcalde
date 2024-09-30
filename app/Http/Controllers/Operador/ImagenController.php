<?php

namespace App\Http\Controllers\Operador;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Imagen;

use Illuminate\Support\Facades\Storage;

class ImagenController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.imagens.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.imagens.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'imagen' => 'required|image'
        ]);

        $file = $request->file('imagen');

        $filename = time() . '_' . $file->getClientOriginalName();
        $file->move(public_path('img'), $filename);

        $url = url('img/' . $filename);

        $imagen = new Imagen();
        $imagen->url = $url;
        $imagen->estado = 'AC';
        $imagen->id_imagenes = $request->id_imagenes;
        $imagen->id_noticias = $request->id_noticias;
        $imagen->id_entrevistas = $request->id_entrevistas;
        $imagen->save();

        return response()->json(['url_file' => $url]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($imagen)
    {
        return view('admin.imagens.show');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        $request->validate([
            'imagen' => 'required|image'
        ]);

        $imagen = Imagen::findOrFail($request->id_asociada);


        if ($imagen->url) {

            $oldFilename = basename($imagen->url);

            $oldFilePath = public_path('img/' . $oldFilename);

            if (file_exists($oldFilePath)) {
                unlink($oldFilePath);
            }
        }

        $file = $request->file('imagen');
        $filename = time() . '_' . $file->getClientOriginalName();

        $file->move(public_path('img'), $filename);

        $url = url('img/' . $filename);

        $imagen->url = $url;
        $imagen->updated_at = now();
        $imagen->save();

        return response()->json(['url_file' => $url]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $imagen)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($request)
    {
        try {
            $imagen = Imagen::find($request);
            if ($imagen) {
                $imagen->update(['estado' => 'DC']);
                return response()->json(["deleted" => $imagen], 200);
            } else {
                return response()->json(['error' => 'Recurso no encontrado'], 404);
            }
        } catch (\Throwable $th) {
            return response()->json(['error' => $th->getMessage()], 500);
        }
    }
}
