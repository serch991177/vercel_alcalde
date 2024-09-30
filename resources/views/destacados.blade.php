@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')
    <h1 class="m-0 text-dark">Seleccion de Destacados</h1>
@stop

@section('content')
<x-adminlte-card title="Lista de Destacados">
    <div class="card-body">

        <x-adminlte-datatable id="table_destacados" :heads="$heads" striped head-theme="dark" with-buttons>
            @foreach($data as $destacado)
                <tr>
                    <td>{{ $destacado->id_destacados }}</td>
                    <td>{{ $destacado->nombre_destacado }}</td>
                    <td>{{ $destacado->me_gustas}}</td>
                    <td>{{ $destacado->visitas }}</td>
                    <td>
                        <button class="btn btn-danger btn-eliminar" data-id="{{ $destacado->id_destacados }}">
                            Eliminar
                        </button>
                    </td>
                </tr>
            @endforeach
        </x-adminlte-datatable>
    </div>
</x-adminlte-card>



            <!-- Modal Footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
            </div>

        </div>
    </div>
</div>

@endsection
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

       <script>


function cargarTabla() {
    $.ajax({
        type: 'GET',
        url: '/api/v1/destacados',
        success: function (data) {


            $('#table_destacados tbody').empty();


            if (Array.isArray(data)) {

                data.forEach(function (destacado) {
                    var newRow = '<tr>' +
                        '<td>' + destacado.id_destacados + '</td>' +
                        '<td>' + destacado.nombre_destacado + '</td>' +
                        '<td>' + destacado.me_gustas + '</td>' +
                        '<td>' + destacado.visitas + '</td>' +
                        '<td>' +
                            '<button class="btn btn-danger btn-eliminar" data-id="' + destacado.id_destacados+ '">Elminar</button>' +
                        '</td>' +
                        '</tr>';

                    $('#table_destacados tbody').append(newRow);
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

$(document).on('click', '.btn-eliminar', function() {
    var idDestacado = $(this).data('id');

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
                url: '/api/v1/destacados/' + idDestacado,
                success: function(response) {
                    console.log('Respuesta exitosa:', response);

                    if (response.deleted) {
                        // Elimina la fila de la tabla
                        $('#fila-' + idDestacado).remove();

                        // Muestra un mensaje de éxito
                        Swal.fire({
                            icon: 'success',
                            title: 'Destacado eliminada con éxito',
                            showConfirmButton: false,
                            timer: 1500
                        });
                        cargarTabla();
                    } else {
                        // Muestra un mensaje de error si no se puede eliminar
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: 'No se pudo eliminar el destacado'
                        });
                    }
                },
                error: function(error) {
                    console.error('Error en la solicitud AJAX:', error);

                    // Muestra un mensaje de error en caso de error en la solicitud
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Error al intentar eliminar el destacado'
                    });
                }
            });
        }
    });
});


</script>


