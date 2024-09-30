@extends('adminlte::page')

@section('title', 'AdminLTE')
@section('content_header')
    <h1 class="m-0 text-dark">Llenado de Videos</h1>
@stop

@section('content')
<x-adminlte-card title="Lista de Videos">
    <div class="card-body">
        <x-adminlte-button label="Crear Videos" data-toggle="modal" data-target="#modalCrearvideo" theme="success" icon="fas fa-plus"/>

        <x-adminlte-datatable id="table_videos" :heads="$heads" striped head-theme="dark" with-buttons>
            @foreach($data as $video)
                <tr>
                    <td>{{ $video->id_videos }}</td>
                    <td>{{ $video->titulo_video }}</td>
                    <td>{{ $video->nombre_categoria }}</td>
                    <td>{{ $video->estado }}</td>
                    <td>
                            <button class="btn btn-warning btn-editar" data-id="{{ $video->id_videos }}" data-titulo="{{ $video->titulo_video }}" data-descripcion="{{ $video->descripcion_video }}" data-categoria="{{ $video->id_categorias }}" data-url="{{ $video->url }}">
                                Editar
                            </button>
                            <button class="btn btn-danger btn-eliminar" data-id="{{ $video->id_videos }}">
                                Eliminar
                            </button>
                    </td>
                </tr>
            @endforeach
        </x-adminlte-datatable>
    </div>
</x-adminlte-card>

<div class="modal" id="modalCrearvideo">
    <div class="modal-dialog">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Crear video</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal Body -->
            <div class="modal-body">
                <form>

                    <div class="form-group">
                        <label for="nombreCategoria">Titulo de la video</label>
                        <input type="text" class="form-control" id="tituloVideo" name="tituloVideo">

                        <label for="descripcionVideo">Descripción video</label>
                        <input type="text" class="form-control" id="descripcionVideo" name="descripcionVideo">

                        <label for="codigoVideo">Codigo del Video</label>
                        <input type="text" class="form-control" id="codigoVideo" name="codigoVideo">

                        <label for="nombreCategoria">Categoria</label>
                        <select class="form-control" id="idcategorias" name="id_categorias">
                            @foreach($categorias as $categoria)
                                <option value="{{ $categoria->id_categorias }}">{{ $categoria->nombre_categoria }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Botón para guardar imágenes -->
                    <button type="button" class="btn btn-success" onclick="guardarVideos()">Guardar</button>
                </form>
            </div>

            <!-- Modal Footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
            </div>

        </div>
    </div>
</div>

<!-- Agrega esto donde sea apropiado en tu vista para el modal de edición -->
<div class="modal fade" id="modalEditarVideos" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Editar Video</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="formEditarVideos" method="POST">
                    @csrf
                    @method('PUT')
                    <input type="hidden" id="idVideosEditar" name="id_videos">
                    <div class="form-group">
                        <label for="tituloVideosEditar">Titulo de la Video</label>
                        <input type="text" class="form-control" id="titulovideosEditar" name="titulo_video">

                        <label for="descripcionVideosEditar">Descripción Video</label>
                        <input type="text" class="form-control" id="descripcionvideosEditar" name="descripcion_video">

                        <label for="linkvideosEditar">Codigo del Video</label>
                        <input type="text" class="form-control" id="linkvideosEditar" name="url_video">


                        <label for="categoriaVideosEditar">Categoria</label>
                        <select class="form-control" id="categoriaVideosEditar" name="id_categorias">
                            @foreach($categorias as $categoria)
                                <option value="{{ $categoria->id_categorias }}">{{ $categoria->nombre_categoria }}</option>
                            @endforeach
                        </select>


                    </div>
                    <!-- Otros campos y controles del formulario de edición -->
                    <button type="submit" class="btn btn-primary">Guardar</button>
                </form>

            </div>
        </div>
    </div>
</div>



@endsection

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

        <script>
    function guardarVideos() {
    // Desactivar el botón para evitar clics múltiples
    $('#btnGuardarvideos').prop('disabled', true);

    // Obtener el nombre de la categoría desde el campo de entrada
    var titulovideo = $('#tituloVideo').val();
    var descripcionvideo = $('#descripcionVideo').val();
    var urlvideo = $('#codigoVideo').val();
    var id_categorias = $('#idcategorias').val();

    // Realizar la llamada AJAX para crear la categoría
    $.ajax({
        type: 'POST',
        url: '/api/v1/videos',
        data: {
            titulo_video: titulovideo,
            descripcion_video: descripcionvideo,
            url: urlvideo,
            id_categorias: id_categorias

        },
        success: function (response) {
            Swal.fire({
                icon: 'success',
                title: 'Video creado con éxito',
                showConfirmButton: false,
                timer: 1000
            }).then(() => {
                location.reload();
            });
            $('#modalCrearvideos').modal('hide');
        },
        error: function (error) {
            if (error.responseJSON && error.responseJSON.error) {

                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: error.responseJSON.error
                });
            } else {

                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Error al crear la video'
                });
            }
            console.error(error);
        },
        complete: function () {

            $('#btnGuardarvideos').prop('disabled', false);
        }
    });
}


</script>



<script>

$('[data-target="#modalCrearvideos"]').on('click', function () {
        $('#modalCrearvideos').modal();
    });

    function cargarTabla() {
    $.ajax({
        type: 'GET',
        url: '/api/v1/videos',
        success: function (data) {


            $('#table_videos tbody').empty();


            if (Array.isArray(data)) {

                data.forEach(function (video) {
                    var newRow = '<tr>' +
                        '<td>' + video.id_videos + '</td>' +
                        '<td>' + video.titulo_video + '</td>' +
                        '<td>' + video.id_categorias + '</td>' +
                        '<td>' + video.estado + '</td>' +
                        '<td>' +
                            '<button class="btn btn-warning btn-editar" data-id="' + video.id_videos + '" data-titulo="' + video.titulo_video+ '" data-descripcion="' + video.descripcion_video+ '" data-url="' + video.url+'" data-categoria="' + video.id_categorias + '">' + '<i class="fas fa-pen"></i> Editar</button>' +
                            '<button class="btn btn-danger btn-eliminar" data-id="' + video.id_videos+ '">Elminar</button>' +
                        '</td>' +
                        '</tr>';

                    $('#table_videos tbody').append(newRow);
                });
            } else {
                console.error('Los datos recibidos no son un array:', data);
            }
        },
        error: function (error) {
            console.error(error);
        }
    });
    }




</script>
<script>

$(document).on('click', '.btn-editar', function() {

    var idvideo = $(this).data('id');
    var titulovideo = $(this).data('titulo');
    var descripcionvideo = $(this).data('descripcion');
    var linkvideo = $(this).data('url');
    var idCategorias = $(this).data('categoria');
    $('#formEditarVideos').attr('action', 'api/v1/videos/' + idvideo);

    $('#modalEditarVideos').modal('show');
    $('#idVideosEditar').val(idvideo);
    $('#titulovideosEditar').val(titulovideo);
    $('#descripcionvideosEditar').val(descripcionvideo);
    $('#linkvideosEditar').val(linkvideo);
    $('#categoriaVideosEditar').val(idCategorias);
});

$(document).ready(function() {
    $('#formEditarVideos').on('submit', function(event) {
        event.preventDefault();

        var idvideo = $('#idVideosEditar').val();
        var titulovideo = $('#titulovideosEditar').val();
        var descripcionvideo = $('#descripcionvideosEditar').val();
        var linkvideo = $('#linkvideosEditar').val();
        var idCategorias = $('#categoriaVideosEditar').val();

        $.ajax({
            type: 'PUT',
            url: '/api/v1/videos/' + idvideo,
            data: {
                titulo_video: titulovideo,
                descripcion_video: descripcionvideo,
                url: linkvideo,
                id_categorias: idCategorias,
                _token: $('meta[name="csrf-token"]').attr('content')
            },
            success: function (response) {
                if (response.success) {
                    Swal.fire({
                        icon: 'success',
                        title: response.message,
                        showConfirmButton: false,
                        timer: 450
                    }).then(() => {
                location.reload();
            });

                    $('#modalEditarVideos').modal('hide');
                    //cargarTabla();

                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: response.error
                    });
                }
            },
            error: function (error) {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Error al actualizar la videos'
                });
                console.error(error);
            }
        });
    });
});


$(document).on('click', '.btn-eliminar', function() {
    var idvideo = $(this).data('id');
console.log(idvideo);
    // Pregunta al usuario si realmente quiere eliminar la categoría
    Swal.fire({
        title: '¿Estás seguro?',
        text: 'Esta acción no se puede deshacer',
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: 'Sí, eliminar'
    }).then((result) => {
        if (result.isConfirmed) {
            // Realiza la solicitud AJAX para eliminar la categoría
            $.ajax({
                type: 'DELETE',
                url: '/api/v1/videos/' + idvideo,
                success: function(response) {
                    console.log('Respuesta exitosa:', response);

                    if (response.deleted) {
                        // Elimina la fila de la tabla
                        $('#fila-' + idvideo).remove();

                        // Muestra un mensaje de éxito
                        Swal.fire({
                            icon: 'success',
                            title: 'video eliminado con éxito',
                            showConfirmButton: false,
                            timer: 450
                        }).then(() => {
                            location.reload();
                        });
                        //cargarTabla();
                    } else {
                        // Muestra un mensaje de error si no se puede eliminar
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: 'No se pudo eliminar la categoría'
                        });
                    }
                },
                error: function(error) {
                    console.error('Error en la solicitud AJAX:', error);

                    // Muestra un mensaje de error en caso de error en la solicitud
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Error al intentar eliminar la video'
                    });
                }
            });
        }
    });
});




</script>


