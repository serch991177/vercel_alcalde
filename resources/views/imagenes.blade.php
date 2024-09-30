@extends('adminlte::page')

@section('title', 'AdminLTE')
@section('plugins.dropzone', true)
@section('content_header')
    <h1 class="m-0 text-dark">Llenado de imagenes</h1>
@stop

@section('content')
<x-adminlte-card title="Lista de Imagenes">
    <div class="card-body">
        <x-adminlte-button label="Crear Imagenes" data-toggle="modal" data-target="#modalCrearImagenes" theme="success" icon="fas fa-plus"/>

        <x-adminlte-datatable id="table_imagenes" :heads="$heads" striped head-theme="dark" with-buttons>
            @foreach($data as $imagen)
                <tr>
                    <td>{{ $imagen->id_imagenes }}</td>
                    <td>{{ $imagen->titulo_imagen }}</td>
                    <td>{{ $imagen->nombre_categoria }}</td>
                    <td>{{ $imagen->estado }}</td>
                    <td>
                        <x-adminlte-button label="Editar" class="btn btn-warning btn-editar" data-id="{{ $imagen->id_imagenes }}" data-toggle="modal" data-target="#modalEditarImagenes" theme="success" icon="fas fa-pen"/>

                            <button class="btn btn-danger btn-eliminar" data-id="{{ $imagen->id_imagenes }}">
                                Eliminar
                            </button>
                    </td>
                </tr>
            @endforeach
        </x-adminlte-datatable>
    </div>
</x-adminlte-card>

<div class="modal" id="modalCrearImagenes">
    <div class="modal-dialog">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Crear imagen</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal Body -->
            <div class="modal-body">
                <form id="formImagen" enctype="multipart/form-data" method="post" >
                    {{csrf_field()}}

                    <div class="form-group">
                        <label for="nombreCategoria">Titulo de la imagen</label>
                        <input type="text" class="form-control" id="tituloimagen" name="tituloimagen">

                        <label for="descripcionimagen">Descripción imagen</label>
                        <input type="text" class="form-control" id="descripcionimagen" name="descripcionimagen">

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

                    <!-- Botón para guardar imágenes -->
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


<div class="modal fade" id="modalEditarImagenes" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Editar imagen</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="formEditarimagenes" enctype="multipart/form-data" method="POST">
                    @csrf
                    @method('PUT')
                    <input type="hidden" id="idImagenesEditar" name="id_imagenes">
                    <div class="form-group">
                        <label for="tituloimagenesEditar">Titulo de la imagen</label>
                        <input type="text" class="form-control" id="tituloImagenesEditar" name="titulo_imagen" value="{{ $imagen->titulo_imagen }}">

                        <label for="descripcionimagenesEditar">Descripción imagen</label>
                        <input type="text" class="form-control" id="descripcionImagenesEditar" name="descripcion_imagen" value="{{ $imagen->descripcion_imagen }}">

                        <label for="categoriaImagenesEditar">Categoria</label>
                        <select class="form-control" id="categoriaImagenesEditar" name="id_categorias">
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
    var idImagenes;

    function obtenerUltimoIdImagenes(callback) {
        $.ajax({
            type: 'GET',
            url: '/imagenes/ultimo_id',
            success: function(response) {
                idImagenes = parseInt(response) + 1;
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
                    formData.append('id_imagenes', idImagenes);
                    console.log(idImagenes);
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

        $("#formImagen .btn-success").on("click", function(event) {
            event.preventDefault();
            event.stopPropagation();

            myDropzone.processQueue();

            myDropzone.on("queuecomplete", function() {
                guardarimagenes();
            });
        });
    }

    obtenerUltimoIdImagenes(initDropzone);
});

function guardarimagenes() {
    $('#btnGuardarimagenes').prop('disabled', true);

    var tituloimagen = $('#tituloimagen').val();
    var descripcionimagen = $('#descripcionimagen').val();
    var linkimagen = $('#linkimagen').val();
    var id_categorias = $('#idcategorias').val();

    $.ajax({
        type: 'POST',
        url: '/api/v1/imagenes',
        data: {
            titulo_imagen: tituloimagen,
            descripcion_imagen: descripcionimagen,
            link_imagen: linkimagen,
            id_categorias: id_categorias
        },
        success: function(response) {
            Swal.fire({
                icon: 'success',
                title: 'imagen creada con éxito',
                showConfirmButton: false,
                timer: 1500
            });
            $('#modalCrearImagenes').modal('hide');
            cargarTabla();

        },
        error: function(error) {
            $('#btnGuardarimagenes').prop('disabled', false);
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
            $('#btnGuardarimagenes').prop('disabled', false);
        }
    });
}

</script>

<script>

    function cargarTabla() {
    $.ajax({
        type: 'GET',
        url: '/api/v1/imagenes',
        success: function (data) {


            $('#table_imagenes tbody').empty();


            if (Array.isArray(data)) {

                data.forEach(function (imagen) {
                    var newRow = '<tr>' +
                        '<td>' + imagen.id_imagenes + '</td>' +
                        '<td>' + imagen.titulo_imagen + '</td>' +
                        '<td>' + imagen.id_categorias + '</td>' +
                        '<td>' + imagen.estado + '</td>' +
                        '<td>' +
                            '<button icon="fas fa-pen" class="btn btn-warning btn-editar" data-id="' + imagen.id_imagenes + '" data-titulo="' + imagen.titulo_imagen+ '" data-descripcion="' + imagen.descripcion_imagen+ '" data-categoria="' + imagen.id_categorias + '">' + '<i class="fas fa-pen"></i> Editar</button>' +
                            '<button class="btn btn-danger btn-eliminar" data-id="' + imagen.id_imagenes+ '">Elminar</button>' +
                        '</td>' +
                        '</tr>';

                    $('#table_imagenes tbody').append(newRow);
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

    var idimagen = $(this).data('id');
    $.ajax({
        url: 'api/v1/imagenes/' + idimagen,
        type: 'GET',
        success: function(response) {

            $('#idImagenesEditar').val(response.imagen.id_imagenes);
            $('#tituloImagenesEditar').val(response.imagen.titulo_imagen);
            $('#descripcionImagenesEditar').val(response.imagen.descripcion_imagen);
            $('#categoriaImagenesEditar').val(response.imagen.id_categorias);

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

                            }).html('<i class="fas fa-pen"></i> Editar');

                var delBtn = $('<button>').addClass('btn btn-danger btn-eliminar-imagen').attr('data-id', imagen.id_imagen).text('Eliminar');
                imgContainer.append(img, editarBtn,delBtn);


                $('#contenedor-imagenes').append(imgContainer);
            });

            $('#modalEditarImagenes').modal('show');
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
        dictResponseError: 'Server responded with code.',
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
    var submitButton = document.querySelector("#formEditarimagenes .btn-primary");
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

    var idimagen = $('#idImagenesEditar').val();
    var tituloimagen = $('#tituloImagenesEditar').val();
    var descripcionimagen = $('#descripcionImagenesEditar').val();
    var idCategorias = $('#categoriaImagenesEditar').val();
    console.log(idimagen);
    $.ajax({
        type: 'PUT',
        url: '/api/v1/imagenes/' + idimagen,
        data: {
            titulo_imagen: tituloimagen,
            descripcion_imagen: descripcionimagen,
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

                $('#modalEditarImagenes').modal('hide');
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
    var idimagen = $(this).data('id');

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
                url: '/api/v1/imagenes/' + idimagen,
                success: function(response) {
                    console.log('Respuesta exitosa:', response);

                    if (response.deleted) {
                        // Elimina la fila de la tabla
                        $('#fila-' + idimagen).remove();

                        // Muestra un mensaje de éxito
                        Swal.fire({
                            icon: 'success',
                            title: 'imagen eliminada con éxito',
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
                        text: 'Error al intentar eliminar la imagen'
                    });
                }
            });
        }
    });
});

</script>


