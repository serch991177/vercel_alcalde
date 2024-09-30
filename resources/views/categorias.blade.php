@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')
    <h1 class="m-0 text-dark">Llenado de Categorias</h1>
@stop

@section('content')
<x-adminlte-card title="Lista de Categorias">
    <div class="card-body">
        <x-adminlte-button label="Crear Categoría" data-toggle="modal" data-target="#modalCrearCategoria" theme="success" icon="fas fa-plus"/>

        <x-adminlte-datatable id="table_categorias" :heads="$heads" striped head-theme="dark" with-buttons>
            @foreach($data as $categoria)
                <tr>
                    <td>{{ $categoria->id_categorias }}</td>
                    <td>{{ $categoria->nombre_categoria }}</td>
                    <td>{{ $categoria->estado }}</td>
                    <td>
                            <button class="btn btn-warning btn-editar" data-id="{{ $categoria->id_categorias }}" data-nombre="{{ $categoria->nombre_categoria }}">
                                Editar
                            </button>
                            <button class="btn btn-danger btn-eliminar" data-id="{{ $categoria->id_categorias }}">
                                Eliminar
                            </button>
                    </td>
                </tr>
            @endforeach
        </x-adminlte-datatable>
    </div>
</x-adminlte-card>

<div class="modal" id="modalCrearCategoria">
    <div class="modal-dialog">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Crear Categoría</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal Body -->
            <div class="modal-body">
                <form>
                    <div class="form-group">
                        <label for="nombreCategoria">Nombre de la Categoría:</label>
                        <input type="text" class="form-control" id="nombreCategoria" name="nombreCategoria">
                    </div>
                    <button type="button" class="btn btn-success" onclick="guardarCategoria()">Guardar</button>
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
<div class="modal fade" id="modalEditarCategoria" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Editar Categoría</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="formEditarCategoria" method="POST">
                    @csrf
                    @method('PUT')
                    <input type="hidden" id="idCategoriaEditar" name="id_categoria">
                    <div class="form-group">
                        <label for="nombreCategoriaEditar">Nombre de la Categoría:</label>
                        <input type="text" class="form-control" id="nombreCategoriaEditar" name="nombre_categoria">
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
    function guardarCategoria() {
    // Desactivar el botón para evitar clics múltiples
    $('#btnGuardarCategoria').prop('disabled', true);

    // Obtener el nombre de la categoría desde el campo de entrada
    var nombreCategoria = $('#nombreCategoria').val();

    // Realizar la llamada AJAX para crear la categoría
    $.ajax({
        type: 'POST',
        url: 'api/v1/categorias',
        data: {
            nombre_categoria: nombreCategoria,
            // Otros datos si es necesario
        },
        success: function (response) {
            Swal.fire({
                icon: 'success',
                title: 'Categoría creada con éxito',
                showConfirmButton: false,
                timer: 1500
            });
            $('#modalCrearCategoria').modal('hide');
            cargarTabla(); // Llama a la función para recargar la tabla
            setTimeout(function() {location.reload();}, 1500);
        },
        error: function (error) {
            if (error.responseJSON && error.responseJSON.error) {
                // Muestra un mensaje de error utilizando SweetAlert2
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: error.responseJSON.error
                });
            } else {
                // Si no hay un mensaje de error específico, muestra un mensaje genérico
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Error al crear la categoría'
                });
            }
            console.error(error);
        },
        complete: function () {
            // Volver a activar el botón después de que la solicitud AJAX se haya completado
            $('#btnGuardarCategoria').prop('disabled', false);
        }
    });
}


</script>



<script>

$('[data-target="#modalCrearCategoria"]').on('click', function () {
        $('#modalCrearCategoria').modal();
    });

    function cargarTabla() {
    $.ajax({
        type: 'GET',
        url: '/api/v1/categorias',
        success: function (data) {

            // Limpia la tabla actual
            $('#table_categorias tbody').empty();

            // Verifica si data es un array
            if (Array.isArray(data)) {
                // Llena la tabla con los nuevos datos
                data.forEach(function (categoria) {
                    var newRow = '<tr>' +
                        '<td>' + categoria.id_categorias + '</td>' +
                        '<td>' + categoria.nombre_categoria + '</td>' +
                        '<td>' + categoria.estado + '</td>' +
                        '<td>' +
                            '<button class="btn btn-warning btn-editar" data-id="' + categoria.id_categorias + '" data-nombre="' + categoria.nombre_categoria + '">' + '<i class="fas fa-pen"></i> Editar</button>'
                            '<button class="btn btn-danger btn-eliminar" data-id="' + categoria.id_categorias+ '">Elminar</button>' +
                        '</td>' +
                        '</tr>';

                    $('#table_categorias tbody').append(newRow);
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

    var idCategoria = $(this).data('id');
    var nombreCategoria = $(this).data('nombre');
    $('#formEditarCategoria').attr('action', 'api/v1/categorias/' + idCategoria);

    $('#modalEditarCategoria').modal('show');
    $('#idCategoriaEditar').val(idCategoria);
    $('#nombreCategoriaEditar').val(nombreCategoria);
});
$(document).ready(function() {
    $('#formEditarCategoria').on('submit', function(event) {
        event.preventDefault();

        var idCategoria = $('#idCategoriaEditar').val();
        var nombreCategoria = $('#nombreCategoriaEditar').val();

        $.ajax({
            type: 'PUT',
            url: 'api/v1/categorias/' + idCategoria,
            data: {
                nombre_categoria: nombreCategoria,
                _token: $('meta[name="csrf-token"]').attr('content')
            },
            success: function (response) {
                if (response.success) {
                    Swal.fire({
                        icon: 'success',
                        title: response.message,
                        showConfirmButton: false,
                        timer: 1500
                    });

                    $('#modalEditarCategoria').modal('hide');
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


