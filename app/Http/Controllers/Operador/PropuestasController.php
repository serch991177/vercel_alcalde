<?php

namespace App\Http\Controllers\Operador;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Propuestas;
use App\Models\Categorias;

class PropuestasController extends Controller
{

    public function index() {

        $data = $data = Propuestas::where('estado', 'AC')->get();

        $heads = [
            'ID',
            'Nombre Completo',
            'CI',
            'Estado',
            'Opciones'
        ];

        return view('propuestas', compact('data', 'heads'));
    }


    public function get(){

        try{
            $data = Propuestas::where('estado', 'AC')->get();
            return response()-> json($data, 200);

            $heads = [
                'ID',
                'Nombre Completo',
                'CI',
                'Estado',
                'Opciones'
            ];

            return view('/imagenes', compact('data', 'heads'));
        } catch (\Throwable $th) {
            return response()->json(['error' => $th->getMessage()], 500);
        }

        }

        public function create (Request $request){
            try{
                $data ['nombre_completo'] =$request['nombre_completo'];
                $data ['dni'] =$request['dni'];
                $data ['celular'] =$request['celular'];
                $data ['correo'] = $request['correo'];
                $data ['ubicacion'] =$request['ubicacion'];
                $data ['documento_propuesta'] =$request['documento_propuesta'];
                $data ['mensaje'] =$request['mensaje'];
                $data ['me_gustas'] =$request['me_gustas'];
                $data ['visitas'] =$request['visitas'];
                $data ['id_categorias'] =$request['id_categorias'];
                $data ['estado'] ='AC';
                $data['fecha_registro'] = now();
                $res = Propuestas::create($data);
                return response()->json($res, 200);
            } catch (\Throwable $th)
            {
                return response()->json(['error' => $th->getMessage()], 500);
            }
        }

        public function getById($id){
            try {
                $data = Propuestas::find($id);
                return response()->json($data,200);
          } catch (\Throwable $th)
          {
              return response()->json(['error' => $th->getMessage()], 500);
          }
        }


        public function update (Request $request,$id){
            try{
                $data ['nombre_completo'] =$request['nombre_completo'];
                $data ['dni'] =$request['dni'];
                $data ['celular'] =$request['celular'];
                $data ['correo'] = $request['correo'];
                $data ['ubicacion'] =$request['ubicacion'];
                $data ['documento_propuesta'] =$request['documento_propuesta'];
                $data ['mensaje'] =$request['mensaje'];
                $data ['me_gustas'] =$request['me_gustas'];
                $data ['visitas'] =$request['visitas'];
                $data ['id_categorias'] =$request['id_categorias'];
                $data ['estado'] ='AC';
                Propuestas::find($id)->update($data);
                $res= Propuestas::find($id);
                return response()->json($res,200);
            }catch (\Throwable $th)
            {
                return response()->json(['error' => $th->getMessage()], 500);
            }

        }

        public function delete($id){
            try{
                $data ['estado'] ='DC';
                $res = Propuestas::find($id);
                return response()->json(["deleted" =>$res],200);
            }catch (\Throwable $th)
            {
                return response()->json(['error' => $th->getMessage()], 500);
            }
        }
}
