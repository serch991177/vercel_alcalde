@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')
    <h1 class="m-0 text-dark">Llenado de Usuarios</h1>
@stop

@section('content')
<x-adminlte-card title="Lista de Usuarios">
    <div class="card-body">
        <x-adminlte-button label="Crear Usuario" data-toggle="modal" data-target="#modalCrearUsuario" theme="success" icon="fas fa-plus"/>

        <x-adminlte-datatable id="table_usuarios" :heads="$heads" striped head-theme="dark" with-buttons>
            @foreach($data as $usuario)
                <tr>
                    <td>{{ $usuario->id_usuarios }}</td>
                    <td>{{ $usuario->nombre_completo }}</td>
                    <td>{{ $usuario->email }}</td>
                    <td>{{ $usuario->estado }}</td>
                    <td>
                            <button class="btn btn-warning btn-editar" data-id="{{ $usuario->id_usuarios }}" data-nombre="{{ $usuario->nombre_completo }}" data-email="{{ $usuario->email }}" data-ci="{{ $usuario->ci }}">
                                Editar
                            </button>
                            <button class="btn btn-danger btn-eliminar" data-id="{{ $usuario->id_usuarios }}">
                                Eliminar
                            </button>
                    </td>
                </tr>
            @endforeach
        </x-adminlte-datatable>
    </div>
</x-adminlte-card>

<div class="modal" id="modalCrearUsuario">
    <div class="modal-dialog">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Crear Usuario</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal Body -->
            <div class="modal-body">
                <div id="message" class="alert" style="display: none;"></div>
                <form id="formCrearUsuario">
                    <div class="form-group">
                        <label for="nombre_completo">Nombre Completo</label>
                        <input type="text" class="form-control" id="nombre_completo" name="nombre_completo">

                        <label for="ci">Carnet de Identidad</label>
                        <input type="text" class="form-control" id="ci" name="ci">

                        <label for="email">Correo</label>
                        <input type="email" class="form-control" id="email" name="email">

                        <label for="password">Contraseña</label>
                        <input type="text" class="form-control" id="password" name="password">
                    </div>
                    <button type="button" class="btn btn-success" onclick="guardarusuario()">Guardar</button>
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
<div class="modal fade" id="modalEditarusuario" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Editar Usuario</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="formEditarUsuario" method="POST">
                    @csrf
                    <input type="hidden" name="_method" value="PUT">
                    <input type="hidden" id="idusuarioEditar" name="id_usuario">
                    <div class="form-group">
                        <label for="nombreusuarioEditar">Nombre del Usuario:</label>
                        <input type="text" class="form-control" id="nombreusuarioEditar" name="nombre_usuario">
                    </div>
                    <div class="form-group">
                        <label for="emailusuarioEditar">Correo:</label>
                        <input type="text" class="form-control" id="emailusuarioEditar" name="email_usuario">
                    </div>
                    <div class="form-group">
                        <label for="ciusuarioEditar">Ci:</label>
                        <input type="text" class="form-control" id="ciusuarioEditar" name="ci_usuario">
                    </div>
                    <button type="submit" class="btn btn-primary">Guardar</button>
                </form>
            </div>
        </div>
    </div>
</div>





@endsection
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

        <script>
    function guardarusuario() {
    // Desactivar el botón para evitar clics múltiples
    $('#btnGuardarUsuario').prop('disabled', true);

    // Obtener el nombre de la categoría desde el campo de entrada
    var nombre_completo = $('#nombre_completo').val();
    var ci = $('#ci').val();
    var correo = $('#email').val();
    var contraseña = $('#password').val();
    var mensaje = '';


    if (!nombre_completo) mensaje += 'El nombre completo es obligatorio.\n';
    if (!ci) mensaje += 'El carnet de identidad es obligatorio.\n';
    if (!correo) mensaje += 'El correo es obligatorio.\n';
    if (!contraseña) mensaje += 'La contraseña es obligatoria.\n';

    if (mensaje) {
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: mensaje
        });
        return;
    }

    $('#btnGuardarUsuario').prop('disabled', true);

    // Realizar la llamada AJAX para crear la categoría
    $.ajax({
        type: 'POST',
        url: 'api/v1/usuarios',
        data: {
            nombre_completo: nombre_completo,
            ci: ci,
            email: correo,
            password: contraseña

            // Otros datos si es necesario
        },
        success: function (response) {
            Swal.fire({
                icon: 'success',
                title: 'Usuario creado con éxito',
                showConfirmButton: false,
                timer: 1500
            });
            $('#modalCrearusuario').modal('hide');
            cargarTabla(); // Llama a la función para recargar la tabla
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
            $('#btnGuardarusuario').prop('disabled', false);
        }
    });
}


</script>



<script>

$('[data-target="#modalCrearusuario"]').on('click', function () {
        $('#modalCrearusuario').modal();
    });

    function cargarTabla() {
    $.ajax({
        type: 'GET',
        url: '/api/v1/usuarios',
        success: function (data) {

            // Limpia la tabla actual
            $('#table_usuarios tbody').empty();

            // Verifica si data es un array
            if (Array.isArray(data)) {
                // Llena la tabla con los nuevos datos
                data.forEach(function (usuario) {
                    var newRow = '<tr>' +
                        '<td>' + usuario.id_usuarios + '</td>' +
                        '<td>' + usuario.nombre_completo + '</td>' +
                        '<td>' + usuario.email + '</td>' +
                        '<td>' + usuario.estado + '</td>' +
                        '<td>' +
                            '<button class="btn btn-warning btn-editar" data-id="' + usuario.id_usuarios + '" data-nombre="' + usuario.nombre_completo + '" data-email="' + usuario.email + '" data-ci="' + usuario.ci + '">Editar</button>' +
                            '<button class="btn btn-danger btn-eliminar" data-id="' + usuario.id_usuarios+ '">Elminar</button>' +
                        '</td>' +
                        '</tr>';

                    $('#table_usuarios tbody').append(newRow);
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
    var idUsuario = $(this).data('id');
    var nombreUsuario = $(this).data('nombre');
    var emailUsuario = $(this).data('email');
    var ciUsuario = $(this).data('ci');

    $('#formEditarUsuario').attr('action', '/api/v1/usuarios/' + idUsuario);
    $('#modalEditarusuario').modal('show');
    $('#idusuarioEditar').val(idUsuario);
    $('#nombreusuarioEditar').val(nombreUsuario);
    $('#emailusuarioEditar').val(emailUsuario);
    $('#ciusuarioEditar').val(ciUsuario);
});

$(document).ready(function() {
    $('#formEditarUsuario').on('submit', function(event) {
        event.preventDefault();

        var idusuario = $('#idusuarioEditar').val();
        var nombreusuario = $('#nombreusuarioEditar').val();
        var emailusuario = $('#emailusuarioEditar').val();
        var ciusuario = $('#ciusuarioEditar').val();

        $.ajax({
            type: 'POST',
            url: '/api/v1/usuarios/' + idusuario,
            data: {
                _method: 'PUT',
                nombre_completo: nombreusuario,
                email: emailusuario,
                ci: ciusuario,
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

                    $('#modalEditarusuario').modal('hide');
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
                    text: 'Error al actualizar el usuario'
                });
                console.error(error);
            }
        });
    });
});




$(document).on('click', '.btn-eliminar', function() {
    var idusuario = $(this).data('id');

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
                url: '/api/v1/usuarios/' + idusuario,
                success: function(response) {
                    console.log('Respuesta exitosa:', response);

                    if (response.deleted) {
                        // Elimina la fila de la tabla
                        $('#fila-' + idusuario).remove();

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


