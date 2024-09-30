<?php

namespace App\Http\Controllers\Usuario;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Mail\MyTestEmail;
use Illuminate\Support\Facades\Mail;
use RealRashid\SweetAlert\Facades\Alert;


class EmailController extends Controller
{
    public function GetMessage(Request $request){
        $request->validate([
            'nombre_completo_mensaje'=>'required',
            'ci_mensaje'=>'required',
            'celular_mensaje' => ['required', 'regex:/^[67][0-9]{7}$/'],
            'correo_mensaje'=>'required|email',
            'mensaje'=>'required',
            'g-recaptcha-response' => 'required|captcha'           
        ]);
        $nombre = $request->input('nombre_completo_mensaje');
        $ci = $request->input('ci_mensaje');
        $celular = $request->input('celular_mensaje');
        $correo = $request->input('correo_mensaje');
        $mensaje = $request->input('mensaje');
        Mail::to('udemy77412318@gmail.com')->send(new MyTestEmail($nombre,$ci,$celular,$correo,$mensaje));
        Alert::success('Mensaje Enviado Correctamente'); 
        return redirect('/contacto');
    }
}
