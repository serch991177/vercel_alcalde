@extends('adminlte::page')

@section('title', 'AdminLTE')
@section('plugins.dropzone', true)
@section('content_header')
    <h1 class="m-0 text-dark">Llenado de Entrevistas</h1>
@stop

@section('content')
<x-adminlte-card title="Lista de Entrevistas">
    <div class="card-body">
        <x-adminlte-button label="Crear Entrevistas" data-toggle="modal" data-target="#modalCrearEntrevista" theme="success" icon="fas fa-plus"/>

        <x-adminlte-datatable id="table_entrevistas" :heads="$heads" striped head-theme="dark" with-buttons>
            @foreach($data as $entrevista)
                <tr>
                    <td>{{ $entrevista->id_entrevistas }}</td>
                    <td>{{ $entrevista->titulo_entrevista }}</td>
                    <td>{{ $entrevista->nombre_categoria }}</td>
                    <td>{{ $entrevista->estado }}</td>
                    <td>

                            <x-adminlte-button label="Editar" class="btn btn-warning btn-editar" data-id="{{ $entrevista->id_entrevistas }}" data-toggle="modal" data-target="#modalEditarEntrevistas" theme="success" icon="fas fa-pen"/>

                            <button class="btn btn-danger btn-eliminar" data-id="{{ $entrevista->id_entrevistas }}">
                                Eliminar
                            </button>
                    </td>
                </tr>
            @endforeach
        </x-adminlte-datatable>
    </div>
</x-adminlte-card>

<div class="modal" id="modalCrearEntrevista">
    <div class="modal-dialog">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Crear Entrevista</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal Body -->
            <div class="modal-body">
                <form id="formEntrevista" enctype="multipart/form-data" method="post">
                    {{csrf_field()}}
                    <div class="form-group">
                        <label for="nombreCategoria">Titulo de la Entrevista</label>
                        <input type="text" class="form-control" id="tituloEntrevista" name="tituloEntrevista">

                        <label for="nombreCategoria">Descripción Entrevista</label>
                        <input type="text" class="form-control" id="descripcionEntrevista" name="descripcionEntrevista">

                        <label for="nombreCategoria">Link Entrevista</label>
                        <input type="text" class="form-control" id="linkEntrevista" name="tituloEntrevista">

                        <label for="nombreCategoria">Categoria</label>
                        <select class="form-control" id="idcategorias" name="id_categorias">
                            @foreach($categorias as $categoria)
                                <option value="{{ $categoria->id_categorias }}">{{ $categoria->nombre_categoria }}</option>
                            @endforeach
                        </select>

                        <label for="cargaImagen">Cargado de Imagen</label>
                        <div id="img_imagenes" class="dropzone">
                            <div class="dz-message" data-dz-message>
                                Arrastra y suelta las imágenes aquí o haz clic para seleccionarlas.
                            </div>
                        </div>

                    </div>
                    <button type="button" class="btn btn-success">Guardar</button>
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
<div class="modal fade" id="modalEditarEntrevistas" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Editar Entrevista</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="formEditarEntrevistas" enctype="multipart/form-data" method="POST">
                    @csrf
                    @method('PUT')
                    <input type="hidden" id="idEntrevistasEditar" name="id_entrevistas">
                    <div class="form-group">
                        <label for="tituloEntrevistasEditar">Titulo de la Entrevista</label>
                        <input type="text" class="form-control" id="tituloEntrevistasEditar" name="titulo_entrevista">

                        <label for="descripcionEntrevistasEditar">Descripción Entrevista</label>
                        <input type="text" class="form-control" id="descripcionEntrevistasEditar" name="descripcion_entrevista">

                        <label for="linkEntrevistasEditar">Link Entrevista</label>
                        <input type="text" class="form-control" id="linkEntrevistasEditar" name="link_entrevista">

                        <label for="categoriaEntrevistasEditar">Categoria</label>
                        <select class="form-control" id="categoriaEntrevistasEditar" name="id_categorias">
                            @foreach($categorias as $categoria)
                                <option value="{{ $categoria->id_categorias }}">{{ $categoria->nombre_categoria }}</option>
                            @endforeach
                        </select>

                        <label for="cargaImagen">Cargado de Imagen</label>
                        <div id="img_asociadas" class="dropzone" hidden>
                            <div class="dz-message" data-dz-message>
                                Arrastra y suelta las imágenes aquí o haz clic para seleccionarlas.
                            </div>
                        </div>
                        <div id="contenedor-imagenes">

                        </div>
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

$(document).ready(function() {
    var img_imagenes = new Array();
    var idEntrevista;

    function obtenerUltimoIdImagenes(callback) {
        $.ajax({
            type: 'GET',
            url: '/entrevistas/ultimo_id',
            success: function(response) {
                idEntrevista = parseInt(response) + 1;
                if (callback) callback();
            },
            error: function(error) {
                console.error('Error al obtener el último ID de imágenes:', error);
            }
        });
    }

    function initDropzone() {
        if (Dropzone.instances.length > 0) {
            Dropzone.instances.forEach(dz => dz.destroy());
        }
        Dropzone.autoDiscover = false;

        var myDropzone = new Dropzone("#img_imagenes", {
            autoProcessQueue: false,
            dictDefaultMessage: "Arrastre y suelte aquí la foto …<br>(o haga clic para seleccionar archivos)",
            dictRemoveFile: 'Remover Archivo',
            dictCancelUpload: 'Cancelar carga',
            dictResponseError: 'Server responded with code.',
            dictCancelUploadConfirmation: '¿Estás seguro/a de que deseas cancelar esta carga?',
            url: "/imagen/store",
            paramName: "imagen",
            addRemoveLinks: true,
            acceptedFiles: 'image/*',
            parallelUploads: 1,
            maxFiles: 1,
            init: function() {
                this.on("complete", function(file) {
                    if (!file.type.match('image.*')) {
                        this.removeFile(file);
                        Swal.fire('No se puede subir el archivo ' + file.name);
                        return false;
                    }
                });

                this.on("removedfile", function(file) {
                    img_imagenes.splice($.inArray(file._removeLink.id, img_imagenes), 1);
                    $('#img_imagenes_value').val(img_imagenes);
                    console.log(img_imagenes);
                });

                this.on("maxfilesexceeded", function(file) {
                    file.previewElement.classList.add("dz-error");
                    $('.dz-error-message').text('No se puede subir más archivos!');
                });

                this.on("sending", function(file, xhr, formData) {
                    formData.append('sistema_id', '00e8a371-8927-49b6-a6aa-0c600e4b6a19');
                    formData.append('collector', 'upload files events');
                    formData.append('id_entrevistas', idEntrevista);
                    console.log(idEntrevista);
                });

                this.on("success", function(file, response) {
                    file.previewElement.classList.add("dz-success");
                    $(file._removeLink).attr('id', response.url_file);
                    img_imagenes.push(response.url_file);
                    $('#img_imagenes_value').val(img_imagenes);
                });

                this.on("error", function(file, response) {
                    file.previewElement.classList.add("dz-error");
                    $('.dz-error-message').text('No se pudo subir el archivo ' + file.name);
                });
            }
        });

        $("#formEntrevista .btn-success").on("click", function(event) {
            event.preventDefault();
            event.stopPropagation();

            myDropzone.processQueue();

            myDropzone.on("queuecomplete", function() {
                guardarentrevistas();
            });
        });
    }

    obtenerUltimoIdImagenes(initDropzone);
});

function guardarentrevistas() {
    $('#btnGuardarEntrevistas').prop('disabled', true);

    var tituloEntrevista = $('#tituloEntrevista').val();
    var descripcionEntrevista = $('#descripcionEntrevista').val();
    var linkEntrevista = $('#linkEntrevista').val();
    var id_categorias = $('#idcategorias').val();

    $.ajax({
        type: 'POST',
        url: '/api/v1/entrevistas',
        data: {
            titulo_entrevista: tituloEntrevista,
            descripcion_entrevista: descripcionEntrevista,
            link_entrevista: linkEntrevista,
            id_categorias: id_categorias
        },
        success: function(response) {
            Swal.fire({
                icon: 'success',
                title: 'Entrevista creada con éxito',
                showConfirmButton: false,
                timer: 1500
            });
            $('#modalCrearEntrevista').modal('hide');
            cargarTabla();

        },
        error: function(error) {
            $('#btnGuardarEntrevistas').prop('disabled', false);
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
                    text: 'Error al crear la Imagen'
                });
            }
            console.error(error);
        },
        complete: function() {
            $('#btnGuardarEntrevistas').prop('disabled', false);
        }
    });
}

</script>



<script>

    function cargarTabla() {
    $.ajax({
        type: 'GET',
        url: '/api/v1/entrevistas',
        success: function (data) {


            $('#table_entrevistas tbody').empty();


            if (Array.isArray(data)) {

                data.forEach(function (entrevista) {
                    var newRow = '<tr>' +
                        '<td>' + entrevista.id_entrevistas + '</td>' +
                        '<td>' + entrevista.titulo_entrevista + '</td>' +
                        '<td>' + entrevista.nombre_categoria + '</td>' +
                        '<td>' + entrevista.estado + '</td>' +
                        '<td>' +
                        '<button class="btn btn-warning btn-editar" data-id="' + entrevista.id_entrevistas + '" data-titulo="' + entrevista.titulo_entrevista + '" data-descripcion="' + entrevista.descripcion_entrevista + '" data-categoria="' + entrevista.id_categorias + '">' +
                         '<i class="fas fa-pen"></i> Editar</button>' +
                        '<button class="btn btn-danger btn-eliminar" data-id="' + entrevista.id_entrevistas+ '">Elminar</button>' +
                        '</td>' +
                        '</tr>';

                    $('#table_entrevistas tbody').append(newRow);
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

    var myDropzone;

$(document).on('click', '.btn-editar', function() {

    Swal.fire({
        icon: 'info',
        title: 'Seleccione la imagen que desea editar',
        text: 'Por favor, para cada imagen debe seleccionar cual sera modificada',
    });

    var idEntrevista = $(this).data('id');
    $.ajax({
        url: 'api/v1/entrevistas/' + idEntrevista,
        type: 'GET',
        success: function(response) {
            $('#idEntrevistasEditar').val(response.entrevista.id_entrevistas);
            $('#tituloEntrevistasEditar').val(response.entrevista.titulo_entrevista);
            $('#descripcionEntrevistasEditar').val(response.entrevista.descripcion_entrevista);
            $('#linkEntrevistasEditar').val(response.entrevista.link_entrevista);
            $('#categoriaEntrevistasEditar').val(response.entrevista.id_categorias);

            $('#contenedor-imagenes').empty();


            response.imagenes_asociadas.forEach(function(imagen) {
                var imgContainer = $('<div>').addClass('imagen-container');
                var img = $('<img>').addClass('img-thumbnail').attr({
                    'src': imagen.url,
                    'alt': 'Imagen'
                });

                img.css({
                    'max-width': '450px',
                    'max-height': '450px'
                });


                var editarBtn = $('<button>').addClass('btn btn-warning btn-editar-imagen').attr({
                                'data-id': imagen.id_imagen,
                                'data-toggle': 'modal',
                                'data-target': '#modalEditarImagenes'
                            }).html('<i class="fas fa-pen"></i> Editar');

                var delBtn = $('<button>').addClass('btn btn-danger btn-eliminar-imagen').attr('data-id', imagen.id_imagen).text('Eliminar');
                imgContainer.append(img, editarBtn,delBtn);


                $('#contenedor-imagenes').append(imgContainer);
            });

            $('#modalEditarEntrevistas').modal('show');
        },
        error: function(xhr, status, error) {
            console.error(error);
            alert('Ocurrió un error al obtener los datos de la imagen.');
        }
    });
});

$(document).on('click', '.btn-editar-imagen', function(event) {

event.preventDefault();
event.stopPropagation();
$('#img_asociadas').removeAttr('hidden');

var img_imagenes = new Array();
var idImagenAsociada = $(this).data('id');
console.log('Editar imagen asociada con ID:', idImagenAsociada);

if (Dropzone.instances.length > 0) {
        Dropzone.instances.forEach(dz => dz.destroy());
    }
Dropzone.autoDiscover = false;

var myDropzone = new Dropzone("#img_asociadas", {
    autoProcessQueue: false,
    dictDefaultMessage: "Arrastre y suelte aquí la foto …<br>(o haga clic para seleccionar archivos)",
    dictRemoveFile: 'Remover Archivo',
    dictCancelUpload: 'Cancelar carga',
    dictResponseError: 'Server responded with  code.',
    dictCancelUploadConfirmation: '¿Estás seguro/a de que deseas cancelar esta carga?',
    url: "/imagen/edit",
    paramName: "imagen",
    addRemoveLinks: true,
    acceptedFiles: 'image/*',
    parallelUploads: 1,
    maxFiles: 1,
    init: function() {
            this.on("complete", function(file) {
                if (!file.type.match('image.*')) {
                    this.removeFile(file);
                    Swal.fire('No se puede subir el archivo ' + file.name);
                    return false;
                }
            });

            this.on("removedfile", function(file) {
                img_imagenes.splice($.inArray(file._removeLink.id, img_imagenes), 1);
                $('#img_imagenes_value').val(img_imagenes);
                console.log(img_imagenes);
            });

            this.on("maxfilesexceeded", function(file) {
                file.previewElement.classList.add("dz-error");
                $('.dz-error-message').text('No se puede subir más archivos!');
            });

            this.on("sending", function(file, xhr, formData) {
                formData.append('sistema_id', '00e8a371-8927-49b6-a6aa-0c600e4b6a19');
                formData.append('collector', 'upload files events');
                formData.append('id_asociada', idImagenAsociada);
                console.log(idImagenAsociada);
                formData.append('_token', $('meta[name="csrf-token"]').attr('content'));
            });

            this.on("success", function(file, response) {
                file.previewElement.classList.add("dz-success");
                $(file._removeLink).attr('id', response.url_file);
                img_imagenes.push(response.url_file);
                $('#img_imagenes_value').val(img_imagenes);
            });

            this.on("error", function(file, response) {
                file.previewElement.classList.add("dz-error");
                $('.dz-error-message').text('No se pudo subir el archivo ' + file.name);
            });
        }
    });
    var submitButton = document.querySelector("#formEditarEntrevistas .btn-primary");
            submitButton.addEventListener("click", function(event) {
                event.preventDefault();
                event.stopPropagation();
                myDropzone.processQueue();
            });
            myDropzone.on("queuecomplete", function() {
        guardarImagenEditada();
    });
});

$(document).on('click', '.btn-eliminar-imagen', function() {

event.preventDefault();
var idimagen = $(this).data('id');

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
        $.ajax({
            type: 'DELETE',
            url: '/imagen/destroy/' + idimagen,
            data: {
            _token: $('meta[name="csrf-token"]').attr('content')
        },
            success: function(response) {
                console.log('Respuesta exitosa:', response);

                if (response.deleted) {
                    Swal.fire({
                        icon: 'success',
                        title: 'imagen eliminada con éxito',
                        showConfirmButton: false,
                        timer: 1500
                    });
                    cargarTabla();
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'No se pudo eliminar la categoría'
                    });
                }
            },
            error: function(error) {
                console.error('Error en la solicitud AJAX:', error);

                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Error al intentar eliminar la imagen'
                });
            }
        });
    }
});
});

function guardarImagenEditada() {

    var idEntrevista = $('#idEntrevistasEditar').val();
    var tituloEntrevista = $('#tituloEntrevistasEditar').val();
    var descripcionEntrevista = $('#descripcionEntrevistasEditar').val();
    var linkEntrevista = $('#linkEntrevistasEditar').val();
    var idCategorias = $('#categoriaEntrevistasEditar').val();

$.ajax({
    type: 'PUT',
    url: '/api/v1/entrevistas/' + idEntrevista,
    data: {
        titulo_entrevista: tituloEntrevista,
        descripcion_entrevista: descripcionEntrevista,
        link_entrevista: linkEntrevista,
        id_categorias: idCategorias,
        _token: $('meta[name="csrf-token"]').attr('content')
    },
    success: function(response) {
        if (response.success) {
            Swal.fire({
                icon: 'success',
                title: response.message,
                showConfirmButton: false,
                timer: 1500
            });

            $('#modalEditarEntrevistas').modal('hide');
            cargarTabla();
        } else {
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: response.error
            });
        }
    },
    error: function(error) {
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: 'Error al actualizar la Imagen'
        });
        console.error(error);
    }
});
}


$(document).on('click', '.btn-eliminar', function() {
    var idEntrevista = $(this).data('id');

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
                url: '/api/v1/entrevistas/' + idEntrevista,
                success: function(response) {
                    console.log('Respuesta exitosa:', response);

                    if (response.deleted) {
                        // Elimina la fila de la tabla
                        $('#fila-' + idEntrevista).remove();

                        // Muestra un mensaje de éxito
                        Swal.fire({
                            icon: 'success',
                            title: 'Entrevista eliminada con éxito',
                            showConfirmButton: false,
                            timer: 1500
                        });
                        cargarTabla();
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
                        text: 'Error al intentar eliminar la Entrevista'
                    });
                }
            });
        }
    });
});

</script>


