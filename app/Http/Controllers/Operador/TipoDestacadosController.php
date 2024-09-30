<?php

namespace App\Http\Controllers\Operador;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TipoDestacados;

class TipoDestacadosController extends Controller
{
    public function get(){

        try{
            $data = Tipodestacados::get();
            return response()-> json($data, 200);

        } catch (\Throwable $th){
            return response()->json(['error' => $th->getMessage()], 500);
        }

        }

        public function create (Request $request){
            try{
                $data ['nombre_tipo_destacado'] =$request['nombre_tipo_destacado'];
                $data ['estado'] = 'AC';
                $res = Tipodestacados::create($data);
                return response()->json($res, 200);
            } catch (\Throwable $th)
            {
                return response()->json(['error' => $th->getMessage()], 500);
            }
        }

        public function getById($id){
            try {
                  $data = Tipodestacados::find($id);
                  return response()->json($data,200);
            } catch (\Throwable $th)
            {
                return response()->json(['error' => $th->getMessage()], 500);
            }
        }

        public function update (Request $request,$id){
            try{
                $data ['nombre_tipo_destacado'] =$request['nombre_tipo_destacado'];
                $data ['estado'] = 'AC';
                Tipodestacados::find($id)->update($data);
                $res= Tipodestacados::find($id);
                return response()->json($res,200);
            }catch (\Throwable $th)
            {
                return response()->json(['error' => $th->getMessage()], 500);
            }

        }

        public function delete($id){
            try{
                $data ['estado'] ='DC';
                $res = Tipodestacados::find($id);
                return response()->json(["deleted" =>$res],200);
            }catch (\Throwable $th)
            {
                return response()->json(['error' => $th->getMessage()], 500);
            }
        }
}
