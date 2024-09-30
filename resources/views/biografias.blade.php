@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')
    <h1 class="m-0 text-dark">Llenado de la Biografia</h1>
@stop

@section('content')
<x-adminlte-card title="Biografia Manfred Reyes Villa">
    <div class="card-body">
       
        <x-adminlte-datatable id="table_biografia" :heads="$heads" striped head-theme="dark" with-buttons>
            @foreach($data as $biografia)
                <tr>
                    <td>{{ $biografia->id_biografia }}</td>
                    <td><button class="btn btn-info btn-editar-es" data-id="{{ $biografia->id_biografia }}" data-bioes="{{ $biografia->biografia_spanish }}">
                        Editar Biografia Español
                    </button></td>
                    <td><button class="btn btn-info btn-editar-in" data-id="{{ $biografia->id_biografia }}" data-bioin="{{ $biografia->biografia_english }}">
                        Editar Biografia Ingles
                    </button></td>
                    <td>{{ $biografia->estado }}</td>
                    <td>
                            <button class="btn btn-danger btn-eliminar" data-id="{{ $biografia->id_categorias }}">
                                Eliminar
                            </button>
                    </td>
                </tr>
            @endforeach
        </x-adminlte-datatable>
    </div>
</x-adminlte-card>

<div class="modal fade" id="modalEditarBiografiaEs" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Editar Biografia Español</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="formEditarBiografiaEs" method="POST">
                    @csrf
                    @method('PUT')
                    <input type="hidden" id="idBiografiaEditar" name="id_biografia">
                    <div class="form-group">
                        <label for="biografiaEspañolEditar">Biografía en Español:</label>
                        <textarea class="form-control" id="biografiaEspañolEditar" name="biografia_espanol" rows="5"></textarea>
                    </div>
                    <!-- Otros campos y controles del formulario de edición -->
                    <button type="submit" class="btn btn-primary">Guardar</button>
                </form>

            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="modalEditarBiografiaEn" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Editar Biografia Ingles</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="formEditarBiografiaEn" method="POST">
                    @csrf
                    @method('PUT')
                    <input type="hidden" id="idBiografiaEditar" name="id_biografia">
                    <div class="form-group">
                        <label for="biografiaInglesEditar">Biografía en Ingles:</label>
                        <textarea class="form-control" id="biografiaInglesEditar" name="biografia_ingles" rows="5"></textarea>
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


$(document).on('click', '.btn-editar-es', function() {

    var idBiografia = $(this).data('id');
    var biografiaEspañol = $(this).data('bioes');
    $('#formEditarBiografiaEs').attr('action', 'api/v1/biografia/' + idBiografia);

    $('#modalEditarBiografiaEs').modal('show');
    $('#idBiografiaEditar').val(idBiografia);
    $('#biografiaEspañolEditar').val(biografiaEspañol);
});
$(document).ready(function() {
    $('#formEditarBiografiaEs').on('submit', function(event) {
        event.preventDefault();

        var idBiografia = $('#idBiografiaEditar').val();
        var biografiaEspañol = $('#biografiaEspañolEditar').val();

        $.ajax({
            type: 'PUT',
            url: 'api/v1/biografia/' + idBiografia,
            data: {
                biografia_spanish: biografiaEspañol,
                _token: $('meta[name="csrf-token"]').attr('content')
            },
            success: function (response) {
                if (response.success) {
                    Swal.fire({
                        icon: 'success',
                        title: response.message,
                        showConfirmButton: false,
                        timer: 1000
                        }).then(() => {
                            location.reload();
                        });

                    $('#formEditarBiografiaEs').modal('hide');
                    cargarTabla();
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
                    text: 'Error al actualizar la categoría'
                });
                console.error(error);
            }
        });
    });
});

$(document).on('click', '.btn-editar-in', function() {

var idBiografia = $(this).data('id');
var biografiaIngles = $(this).data('bioin');
$('#formEditarBiografiaEs').attr('action', 'api/v1/biografia/' + idBiografia);

$('#modalEditarBiografiaEn').modal('show');
$('#idBiografiaEditar').val(idBiografia);
$('#biografiaInglesEditar').val(biografiaIngles);
});
$(document).ready(function() {
$('#formEditarBiografiaEn').on('submit', function(event) {
    event.preventDefault();

    var idBiografia = $('#idBiografiaEditar').val();
    var biografiaIngles = $('#biografiaInglesEditar').val();

    $.ajax({
        type: 'PUT',
        url: 'api/v1/biografia/' + idBiografia,
        data: {
            biografia_english: biografiaIngles,
            _token: $('meta[name="csrf-token"]').attr('content')
        },
        success: function (response) {
            if (response.success) {
                Swal.fire({
                    icon: 'success',
                    title: response.message,
                    showConfirmButton: false,
                    timer: 1000
                        }).then(() => {
                            location.reload();
                        });

                $('#formEditarBiografiaEs').modal('hide');
                cargarTabla();
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
                text: 'Error al actualizar la categoría'
            });
            console.error(error);
        }
    });
});
});

$(document).on('click', '.btn-eliminar', function() {
    var idCategoria = $(this).data('id');

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
                url: '/api/v1/categorias/' + idCategoria,
                success: function(response) {
                    console.log('Respuesta exitosa:', response);

                    if (response.deleted) {
                        // Elimina la fila de la tabla
                        $('#fila-' + idCategoria).remove();

                        // Muestra un mensaje de éxito
                        Swal.fire({
                            icon: 'success',
                            title: 'Categoría eliminada con éxito',
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
                        text: 'Error al intentar eliminar la categoría'
                    });
                }
            });
        }
    });
});


</script>


