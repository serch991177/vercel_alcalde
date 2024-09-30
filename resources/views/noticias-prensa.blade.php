@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')
    <h1 class="m-0 text-dark">Noticias de Prensa</h1>
@stop

@section('content')
<x-adminlte-card title="Noticias de Prensa">
    <div class="card-body">
        <table id="example" class="display" style="width:100%">
            <thead>
                <tr>
                    @foreach($heads as $head)
                        <th>{{ $head }}</th>
                    @endforeach
                </tr>
            </thead>
        </table>
    </div>
</x-adminlte-card>
<!--estilos de modal de imagenes-->
<style>
    .imagen_responsive_modal {
        width: 700px;
    }
    /* Responsive styles */
    @media (max-width: 768px) {
        .imagen_responsive_modal {
            width:320px;
        }
    }
</style>
<!-- Modal -->
<div class="modal fade" id="ModalNoticia" tabindex="-1" role="dialog" aria-labelledby="ModalNoticiaTitle" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title col-11 text-center" id="ModalNoticiaTitle" ></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <!--Contenido-->
        <div class="text-center">
            <img src="" alt="imagen de la noticia" id="imagen_noticia_url" class="imagen_responsive_modal">
        </div>
        <div class="text-center">
            <p id="descripcion_noticia_modal"></p>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" onclick="guardarnotica()">Destacar Noticia</button>
      </div>
    </div>
  </div>
</div>

@endsection

@section('css')
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css">
@stop

@section('js')
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
<script>
    $(document).ready(function() {
        $('#example').DataTable({
            "processing": true,
            "serverSide": true,
            "ajax": {
                "url": "{{ route('noticiasprensa') }}",
                "type": "GET"
            },
            "columns": [
                { "data": "titulo" },
                { "data": "resumen" },
                { "data": "fecha" },
                { 
                    "data": null,
                    "render": function(data, type, row) {
                        return '<button class="btn btn-info btn-editar-es" data-id="' + data.slug + '" onclick="vernoticia(\'' + data.slug + '\')" type="button" data-toggle="modal" data-target="#ModalNoticia">Ver Noticia</button>';
                    }
                }
            ],
            "paging": true,
            "lengthChange": false,
            "searching": false,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": true
        });
    });
</script>
<script>
    function vernoticia(slug){
        var dataToSend = {
            slug:slug
        }
        $.ajax({
            type:"POST",
            headers: {'Content-Type':'application/json','X-CSRF-TOKEN':'{{ csrf_token() }}'},
            url: "{{route('recuperar_noticia_prensa')}}",
            async:false,
            data:JSON.stringify(dataToSend),
            success:function(data)
            {
                if(data.state == true){
                    var url_imagen = "https://cochabamba.bo/"+data.datas.archivo;
                    document.getElementById("ModalNoticiaTitle").innerText = data.datas.titulo;
                    document.getElementById("imagen_noticia_url").src = url_imagen;
                    var contenidoHTML = data.datas.contenido;
                    $('#descripcion_noticia_modal').html(contenidoHTML);
                }else{
                    swal.fire("Error","Ocurrio un Imprevisto al recuperar la noticia","error");
                    setTimeout(function() {location.reload();},1500);
                }
            }
        });
    }
</script>
<!---Script Guardar noticia--->
<script>
    function guardarnotica(){
        var titulo_imagen = document.getElementById("ModalNoticiaTitle").textContent;
        var descripcion_imagen = document.getElementById("descripcion_noticia_modal").textContent;
        var url = document.getElementById("imagen_noticia_url").src;
        var id_categorias = 3;
        var estado = "AC";
        const fecha = new Date();
        var dataToSend = {
            titulo_imagen:titulo_imagen,
            descripcion_imagen:descripcion_imagen,
            url:url,
            id_categorias:id_categorias,
            estado:estado,
            fecha:fecha
        }
        $.ajax({
            type:"POST",
            headers: {'Content-Type':'application/json','X-CSRF-TOKEN':'{{ csrf_token() }}'},
            url: "{{route('guardar_noticia_prensa')}}",
            async:false,
            data:JSON.stringify(dataToSend),
            success:function(data)
            {
                if(data.status == true){
                    var dataToImage = {
                        id_imagenes:data.data.id_imagenes,
                        url:data.url,
                        estado:data.data.estado,
                        created_at:data.data.fecha_registro,
                        updated_at:data.data.fecha_registro
                    }
                    $.ajax({
                        type:"POST",
                        headers: {'Content-Type':'application/json','X-CSRF-TOKEN':'{{ csrf_token() }}'},
                        url: "{{route('guardar_imagen_prensa')}}",
                        async:false,
                        data:JSON.stringify(dataToImage),
                        success:function(data)
                        {
                            if(data.status == true){
                                swal.fire('Destacado','Noticia Destacada Correctamente','success');
                                setTimeout(function() {location.reload();},1500);
                            }
                        }
                    });
                }
            }
        })
    }
</script>
@stop

