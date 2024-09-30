<?php

namespace App\Http\Controllers\Usuario;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Http;     
use App\Models\Propuestas;   
use Illuminate\Pagination\LengthAwarePaginator;
use App\Models\Imagenes;
use App\Models\Imagen;
class UsuarioController extends Controller
{
    public function home(){
        $carousel = DB::table('imagenes')
        ->join('imagen', 'imagenes.id_imagenes', '=', 'imagen.id_imagenes')
        ->select('imagenes.descripcion_imagen', 'imagen.url')
        ->where('imagenes.id_categorias','=','1')
        ->where('imagen.estado','=','AC')
        ->get();

        $seccion = DB::table('imagenes')
        ->join('imagen', 'imagenes.id_imagenes', '=', 'imagen.id_imagenes')
        ->select('imagenes.descripcion_imagen', 'imagen.url','imagenes.fecha_registro','imagenes.titulo_imagen','imagenes.id_imagenes')
        ->where('imagenes.id_categorias','=','3')
        ->where('imagen.estado','=','AC')
        ->orderbydesc('imagenes.id_imagenes')
        ->get();
        //dd($seccion);
        $noticias_destacadas = DB::table('destacados as d')
        ->join('noticias as n','n.id_noticias','=','d.id_noticias')
        ->join('imagen as i','i.id_noticias','=','n.id_noticias')
        ->where('d.estado','=','AC')
        ->orderby('d.id_destacados','desc')
        ->limit(5)
        ->get();
        
        return view('welcome', ['carousel' => $carousel,'seccion' => $seccion,'noticias_destacadas'=>$noticias_destacadas]);
    }
    public function propuesta(Request $request){
        $validator = Validator::make($request->all(),[
            'nombre_completo'=>'required',
            'ci'=>'required',
            'celular' => ['required', 'regex:/^[67][0-9]{7}$/'],
            //'celular'=>'required',
            'correo'=>'required|email',
            'ubicacion'=>'required',
            'documento_proyecto'=>'required',
            'genero'=>'required',
            'edad'=>'required'
            //'g-recaptcha-response' => 'required'
        ]);
        if($validator->fails()){
            return response()->json(['state'=>false,'errors'=> $validator->errors()]);
        }else{
            $propuesta = new Propuestas;
            $propuesta->nombre_completo =$request->input('nombre_completo');
            $propuesta->dni =$request->input('ci');
            $propuesta->celular =$request->input('celular');
            $propuesta->correo =$request->input('correo');
            $propuesta->ubicacion =$request->input('ubicacion');
            $propuesta->documento_propuesta =$request->input('documento_proyecto');
            $propuesta->genero = $request->input('genero');
            $propuesta->edad = $request->input('edad');
            $propuesta->mensaje ='';
            $propuesta->me_gustas ='0';
            $propuesta->visitas = '0';
            $propuesta->id_categorias = null;
            $propuesta->estado = 'AC';
            $propuesta->fecha_registro = now();
            $propuesta->save();
        }
    }
    public function galeria(){
        $galeria = DB::table('imagenes')
        ->join('imagen','imagenes.id_imagenes','=','imagen.id_imagenes')
        ->select('imagenes.descripcion_imagen','imagen.url','imagenes.fecha_registro','imagenes.titulo_imagen','imagen.id_imagen')
        ->where('imagenes.id_categorias','=','2')
        ->where('imagen.estado','=','AC')
        ->get();
        //dd($galeria);
        return view('usuario.galeria',['galeria' => $galeria]);
    }
    public function prensa(){
        $noticias = DB::table('imagen')
        ->join('noticias','imagen.id_noticias','=','noticias.id_noticias')
        ->join('categorias','noticias.id_categorias','=','categorias.id_categorias')
        ->select('noticias.titulo_noticia','noticias.descripcion_noticia','imagen.url','imagen.id_noticias','categorias.id_categorias','categorias.nombre_categoria')
        ->where('noticias.estado','=','AC')
        ->orderbydesc('noticias.id_noticias')
        ->get();
        $videos = DB::table('videos')
        ->join('categorias','categorias.id_categorias','=','videos.id_categorias')
        ->where('videos.estado','=','AC')
        ->select('videos.titulo_video','videos.descripcion_video','videos.url','categorias.id_categorias','categorias.nombre_categoria')
        ->orderbydesc('id_videos')
        ->get();
        $categorias = DB::table('categorias')
        ->where('categorias.estado','=','AC')
        ->offset(3)
        ->get();
        return view('usuario.prensa',['noticias'=>$noticias,'videos'=>$videos,'categorias'=>$categorias]);
    }
    public function biografia(){
        $entrevistas = DB::table('imagen')
        ->join('entrevistas','entrevistas.id_entrevistas','=','imagen.id_entrevistas')
        ->join('categorias','categorias.id_categorias','=','entrevistas.id_categorias')
        ->select('entrevistas.titulo_entrevista','entrevistas.link_entrevista','entrevistas.descripcion_entrevista','imagen.url','imagen.id_entrevistas','categorias.id_categorias','categorias.nombre_categoria')
        ->where('entrevistas.estado','=','AC')
        ->orderbydesc('id_entrevistas')
        ->get();
        //dd($entrevistas);
        $biografia = DB::table('biografia')->where('estado','=','AC')->first();
        return view('usuario.biografia',['entrevistas'=>$entrevistas,'biografia'=>$biografia]);
    }
    public function recuperar_entrevista(Request $request){
        $recuperar_entrevista = DB::table('imagen')
        ->join('entrevistas','entrevistas.id_entrevistas','=','imagen.id_entrevistas')
        ->join('categorias','categorias.id_categorias','=','entrevistas.id_categorias')
        ->select('entrevistas.titulo_entrevista','entrevistas.descripcion_entrevista','imagen.url','imagen.id_entrevistas','categorias.id_categorias','categorias.nombre_categoria','entrevistas.link_entrevista')
        ->where('entrevistas.id_entrevistas',$request->id_entrevista)
        ->first();
        //dd($recuperar_entrevista->link_entrevista);
        if (!empty($recuperar_entrevista) || $recuperar_entrevista !=null) {
            return response(['status' => true, 'data'=>$recuperar_entrevista],200);
        }else{
            return response(['status' => false, 'message' => 'La entrevista no existe!'],201);
        }
    }
    public function recuperar_noticia(Request $request){
        $recuperar_noticia = DB::table('imagen')
        ->join('noticias','noticias.id_noticias','=','imagen.id_noticias')
        ->join('categorias','noticias.id_categorias','=','categorias.id_categorias')
        ->select('noticias.titulo_noticia','noticias.descripcion_noticia','imagen.url','imagen.id_noticias','categorias.id_categorias','categorias.nombre_categoria')
        ->where('noticias.id_noticias',$request->id_noticia)
        ->first();
        if(!empty($recuperar_noticia) || $recuperar_noticia != null){
            return response(['status'=>true,'data'=>$recuperar_noticia],200);
        }else{
            return response(['status'=>false,'message'=>'La noticia no existe!'],201);
        }
    }
    public function filtrar_categoria(Request $request){
        $busqueda = DB::table('noticias')
        ->join('categorias','categorias.id_categorias','=','noticias.id_categorias')
        ->join('imagen','imagen.id_noticias','=','noticias.id_noticias')
        ->where('noticias.estado','=','AC')
        ->where('noticias.id_categorias','=',$request->id_categoria)
        ->get();
        return response(['status'=>true,'data'=>$busqueda],200);
    }
    public function busqueda(Request $request){
        $keyword = $request->input_texto;
        $busqueda_texto = DB::table('noticias as n')
        ->select('n.*', 'c.*', 'i.url')
        ->join('categorias as c', 'c.id_categorias', '=', 'n.id_categorias')
        ->join('imagen as i', 'i.id_noticias', '=', 'n.id_noticias')
        ->where('n.estado', 'AC')
        ->where(function ($query) use ($keyword) {
            //$query->where('n.titulo_noticia', 'like', '%' . $keyword . '%')
            //->orWhere('n.descripcion_noticia', 'like', '%' . $keyword . '%');
            $query->whereRaw('LOWER(n.titulo_noticia) LIKE ?', ['%' . strtolower($keyword) . '%'])
              ->orWhereRaw('LOWER(n.descripcion_noticia) LIKE ?', ['%' . strtolower($keyword) . '%']);
        })
        ->get(); 
        return response(['status'=>true,'data'=>$busqueda_texto],200);
    }
    public function busquedagaleria(Request $request){
        $input = $request->input_galeria;
        $busqueda_galeria = DB::table('imagenes as i')
        ->select('i.titulo_imagen','i.descripcion_imagen','i2.url')
        ->join('imagen as i2','i2.id_imagenes','=','i.id_imagenes')
        ->where('i.id_categorias','=','2')
        ->where('i.estado','=','AC')
        ->where(function ($query) use ($input) {
            $query->where('i.titulo_imagen', 'like', '%' . $input . '%')
                ->orWhere('i.descripcion_imagen', 'like', '%' . $input . '%');
        })
        ->get();
        $chunks = $busqueda_galeria->chunk(3);
        $urlRaiz = \URL::to('/');

        return response(['status'=>true,'data'=>$busqueda_galeria,'chunks' => $chunks, 'urlRaiz' => $urlRaiz],200);
    }
    //funciones para consumir los servicios de prensa
    public function noticiasprensa(Request $request){
        if($request->ajax()){
            $page = $request->input('start') / $request->input('length') + 1;
            $url = "https://cochabamba.bo/api/posts?page=" . $page;
            $response = Http::get($url);
            $datas = $response->json();
    
            $items = $datas['data'];
            $total = $datas['total'];
    
            return response()->json([
                'draw' => $request->input('draw'),
                'recordsTotal' => $total,
                'recordsFiltered' => $total,
                'data' => $items,
            ]);
        }
        $heads = [
            'Titulo',
            'Resumen',
            'Fecha',
            'Opciones'
        ];
        return view('noticias-prensa',['heads'=>$heads]);
    }
    public function recuperarprensa(Request $request){
        $url = "https://cochabamba.bo/api/posts/" . $request->slug;
        $response = Http::get($url);
        $datas = $response->json();
        $statusCode = $response->getStatusCode();
        if($statusCode == 200 || $statusCode == 201){
            return response()->json(["state"=>true,"datas"=>$datas]);
        }else{
            return response()->json(["state"=>false]);
        }
    }
    public function recpuerar_seccion(Request $request){
        $recuperar_seccion = DB::table('imagenes')
        ->join('imagen','imagen.id_imagenes','=','imagenes.id_imagenes')
        ->select('imagenes.titulo_imagen','imagenes.descripcion_imagen','imagen.url')
        ->where('imagenes.id_imagenes',$request->id_imagenes)
        ->first();
        if(!empty($recuperar_seccion) || $recuperar_seccion != null){
            return response(['status'=>true,'data'=>$recuperar_seccion],200);
        }else{
            return response(['status'=>false],201);
        }
    }
    public function guardarnoticiaprensa(Request $request){
        $imagenes = new Imagenes;
        $imagenes->titulo_imagen = $request->titulo_imagen;
        $imagenes->descripcion_imagen = $request->descripcion_imagen;
        $imagenes->id_categorias = $request->id_categorias;
        $imagenes->estado = $request->estado;
        $imagenes->fecha_registro=$request->fecha;
        $imagenes->save();
        return response(['status'=>true,'data'=>$imagenes,'url'=>$request->url],200);
        //dd($imagenes);
    }
    public function guardarimagenprensa(Request $request){
        $imagen = new Imagen;
        $imagen->url = $request->url;
        $imagen->id_imagenes = $request->id_imagenes;
        $imagen->created_at = $request->created_at;
        $imagen->updated_at = $request->updated_at;
        $imagen->estado = $request->estado;
        $imagen->save();
        return response(['status'=>true]);
    }
}
