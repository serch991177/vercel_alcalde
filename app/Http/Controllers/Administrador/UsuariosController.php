<?php

namespace App\Http\Controllers\Administrador;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Usuarios;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
class UsuariosController extends Controller
{
    public function index() {

        $data = Usuarios::where('estado', 'AC')->get();
        $heads = [
            'ID',
            'Nombre Completo',
            'Correo',
            'Estado',
            'Opciones'
        ];

        return view('usuarios', compact('data', 'heads'));
    }

public function get(){

try{
    $data = Usuarios::where('estado', 'AC')->get();
    return response()-> json($data, 200);

} catch (\Throwable $th){
    return response()->json(['error' => $th->getMessage()], 500);
}

}

public function create(Request $request) {
    try {

        $validatedData = $request->validate([
            'nombre_completo' => 'required|string|max:255',
            'ci' => 'required|string|max:20|unique:usuarios,ci',
            'password' => 'required|string|min:5',
            'email' => 'required|string|email|max:255|unique:usuarios,email',
        ]);

        $ciUsuario = $request['ci'];
        $usuarioExistente = Usuarios::where('ci', $ciUsuario)->first();

        if ($usuarioExistente) {

            return response()->json(['error' => 'Ya existe un usuario con el mismo ci'], 400);
        }
        $data['nombre_completo'] = $validatedData['nombre_completo'];
        $data['ci'] = $validatedData['ci'];
        $data['contrasena_real'] = $validatedData['password'];
        $data['password'] = Hash::make($validatedData['password']);
        $data['estado'] = 'AC';
        $data['email'] = $validatedData['email'];
        $data['created_at'] = now();


        $res = Usuarios::create($data);


        return response()->json($res, 200);
    } catch (\Throwable $th) {

        return response()->json(['error' => $th->getMessage()], 500);
    }
}

public function getById($id){
    try {
          $data = Usuarios::find($id);
          return response()->json($data,200);
    } catch (\Throwable $th)
    {
        return response()->json(['error' => $th->getMessage()], 500);
    }
}

public function update (Request $request,$id){
    try{
        $data ['nombre_completo'] =$request['nombre_completo'];
        $data ['ci'] =$request['ci'];
        $data ['contrasena'] =$request['contrasena'];
        $data ['email'] =$request['email'];
        Usuarios::find($id)->update($data);
        $res= Usuarios::find($id);
        return response()->json(['success' => true, 'message' => 'Usuario actualizado con éxito'], 200);
    }catch (\Throwable $th)
    {
        return response()->json(['error' => $th->getMessage()], 500);
    }

}

public function delete($id){
    try{
        $data ['estado'] ='DC';
        Usuarios::find($id)->update($data);
        $res= Usuarios::find($id);
        return response()->json(["deleted" =>$res],200);
    }catch (\Throwable $th)
    {
        return response()->json(['error' => $th->getMessage()], 500);
    }
}


}
