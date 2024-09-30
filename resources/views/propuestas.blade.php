@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')
    <h1 class="m-0 text-dark">Lista de las Propuestas</h1>
@stop

@section('content')
<x-adminlte-card title="Lista de propuestas">
    <div class="card-body">

        <x-adminlte-datatable id="table_propuestas" :heads="$heads" striped head-theme="dark" with-buttons>
            @foreach($data as $propuesta)
                <tr>
                    <td>{{ $propuesta->id_propuesta }}</td>
                    <td>{{ $propuesta->nombre_completo }}</td>
                    <td>{{ $propuesta->dni }}</td>
                    <td>{{ $propuesta->estado }}</td>
                    <td>
                            <button class="btn btn-warning btn-editar" data-id="{{ $propuesta->id_porpuesta }}" data-nombre="{{ $propuesta->nombre_completo }}" data-dni="{{ $propuesta->dni }}"data-celular="{{ $propuesta->celular }}" data-correo="{{ $propuesta->correo }}" data-ubicacion="{{ $propuesta->ubicacion }}" data-documento="{{ $propuesta->documento_propuesta }}" data-genero="{{$propuesta->genero}}" data-edad="{{$propuesta->edad}}">
                                Ver Propuesta
                            </button>
                    </td>
                </tr>
            @endforeach
        </x-adminlte-datatable>
    </div>
</x-adminlte-card>

<!-- Agrega esto donde sea apropiado en tu vista para el modal de edición -->
<div class="modal fade" id="modalEditarpropuesta" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Ver Propuesta</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="formEditarpropuesta">
                    <input type="hidden" id="idpropuestaEditar" name="id_propuesta">
                    <div class="form-group">

                        <label for="nombrepropuestaEditar">Nombre Ciudadano:</label>
                        <input type="text" class="form-control" id="nombrepropuestaEditar" name="nombre_ciudadano">

                        <label for="cipropuestaEditar">CI:</label>
                        <input type="text" class="form-control" id="cipropuestaEditar" name="ci">

                        <label for="celularpropuestaEditar">Celular:</label>
                        <input type="text" class="form-control" id="celularpropuestaEditar" name="celular">

                        <label for="correopropuestaEditar">Correo:</label>
                        <input type="text" class="form-control" id="correopropuestaEditar" name="correo">

                        <label for="generopropuestaEditar">Genero:</label>
                        <input type="text" class="form-control" id="generopropuestaEditar" name="genero">

                        <label for="edadpropuestaEditar">Edad:</label>
                        <input type="text" class="form-control" id="edadpropuestaEditar" name="edad">
                        
                        <label for="ubicacionpropuestaEditar">Ubicacion:</label>
                        <input type="text" class="form-control" id="ubicacionpropuestaEditar" name="ubicacion">

                        <label for="documentopropuestaEditar">Documento propuesta:</label>
                        <input type="text" class="form-control" id="documentopropuestaEditar" name="documento_propuesta">

                    </div>
                </form>

            </div>
        </div>
    </div>
</div>



@endsection
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


<script>

$(document).on('click', '.btn-editar', function() {

    var idPropuesta = $(this).data('id');
    var nombrePropuesta = $(this).data('nombre');
    var dniPropuesta = $(this).data('dni');
    var celularPropuesta = $(this).data('celular');
    var correoPropuesta = $(this).data('correo');
    var ubicacionPropuesta = $(this).data('ubicacion');
    var documentoPropuesta = $(this).data('documento');
    var genero = $(this).data('genero');
    var edad = $(this).data('edad');

    $('#formEditarpropuesta').attr('action', 'api/v1/propuestas/' + idPropuesta);

    $('#modalEditarpropuesta').modal('show');
    $('#idpropuestaEditar').val(idPropuesta);
    $('#nombrepropuestaEditar').val(nombrePropuesta);
    $('#cipropuestaEditar').val(dniPropuesta);
    $('#celularpropuestaEditar').val(celularPropuesta);
    $('#correopropuestaEditar').val(correoPropuesta);
    $('#ubicacionpropuestaEditar').val(ubicacionPropuesta);
    $('#documentopropuestaEditar').val(documentoPropuesta);
    $('#generopropuestaEditar').val(genero);
    $('#edadpropuestaEditar').val(edad);

      

});

</script>


