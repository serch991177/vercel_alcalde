@include('head')
@include('navbar')
@include('sweetalert::alert', ['cdn' => "https://cdn.jsdelivr.net/npm/sweetalert2@9"])
<!--Incluye el archivo CSS de Bootstrap-->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
<!--Font awesome-->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.2/css/all.min.css">
<!--carga la hoja de estilos del plugin Owl Carousel-->
<link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/owl-carousel/1.3.3/owl.carousel.min.css'>
<!--carga el estilo de font awesome-->
<link rel='stylesheet' href='https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css'>
<!--Incluye la biblioteca jQuery-->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<!--Incluye la biblioteca Popper.js, que es utilizada por Bootstrap para manejar el posicionamiento de los elementos emergentes (popovers) y tooltips-->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<!--Incluye el archivo JavaScript de Bootstrap-->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
<!--Script para cargar el javascript de Owl Carousel-->
<script src='https://cdnjs.cloudflare.com/ajax/libs/owl-carousel/1.3.3/owl.carousel.min.js'></script>
<!--Incluye la biblioteca jQuery-->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!--Incluye la libreria de swal fire-->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<!--libreria del recaptcha-->
<script src="https://www.google.com/recaptcha/api.js"></script>
<link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
<style>
    body {
        font-family: 'Poppins';font-size: 18px;
        text-align: justify;
    }
</style>
<!--formulario de contacto-->
<div class="container">
    <div class="text-center">
        <button type="button" class="btn btn-lila-outline btn-oval" onclick="mostrarFormulario('mensaje')">MENSAJE</button>
        <button type="button" class="btn btn-lila-outline btn-oval" onclick="mostrarFormulario('propuesta')">PROPUESTA</button>
    </div>
   <div class="row">
    <div class="col-12">
        <!--first form-->
        <form action="{{route('enviar-mensaje')}}" id="formMensaje" method="post">
            @csrf
            <div class="mb-3">
                <label class="form-label-mensaje" >Nombre Completo</label>
                <input class="form-control input-mensaje"  id="nombre_completo_mensaje" name="nombre_completo_mensaje" value="{{old('nombre_completo_mensaje')}}" placeholder="" type="text"/>
                @error('nombre_completo_mensaje')
                    <p class='text-danger inputerror'>{{ $message }} </p>
                @enderror
            </div>
            <div class="mb-3">
                <label class="form-label-mensaje" >Cédula de Identidad</label>
                <input class="form-control input-mensaje"   id="ci_mensaje" name="ci_mensaje" value="{{old('ci_mensaje')}}" placeholder="" type="text"/>
                @error('ci_mensaje')
                    <p class='text-danger inputerror'>{{ $message }} </p>
                @enderror
            </div>
            <div class="mb-3">
                <label class="form-label-mensaje" >Celular</label>
                <input class="form-control input-mensaje" id="celular_mensaje" name="celular_mensaje" value="{{old('celular_mensaje')}}" placeholder="" type="text" onkeypress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;"/>
                @error('celular_mensaje')
                    <p class='text-danger inputerror'>{{ $message }} </p>
                @enderror
            </div>
            <div class="mb-3">
                <label class="form-label-mensaje" >Correo</label>
                <input class="form-control input-mensaje"  id="correo_mensaje" name="correo_mensaje" value="{{old('correo_mensaje')}}" placeholder="" type="email"/>
                @error('correo_mensaje')
                    <p class='text-danger inputerror'>{{ $message }} </p>
                @enderror
            </div>
            <div class="mb-3">
                <label class="form-label-mensaje" >Mensaje</label>
                <textarea class="form-control input-mensaje"  id="mensaje" name="mensaje" rows="3">{{old('mensaje')}}</textarea>
                @error('mensaje')
                    <p class='text-danger inputerror'>{{ $message }} </p>
                @enderror
            </div>
            <div class="mb-3">    
                {!! NoCaptcha::renderJs() !!}
                {!! NoCaptcha::display() !!}
                @if ($errors->has('g-recaptcha-response'))
                    <p class='text-danger inputerror'>{{ $errors->first('g-recaptcha-response') }}</p>
                @endif
            </div>
            <div class="text-center">
                <button class="btn-enviar" type="submit">Enviar</button>
            </div>
        </form>
        <!--second form-->
        <form action="" id="formPropuesta" style="display: none;" method="post">
            @csrf
            <div class="mb-3">
                <label class="form-label-mensaje" for="fullName">Nombre Completo</label>
                <input class="form-control input-mensaje"  id="fullName_propuesta" name="fullName_propuesta" placeholder="" type="text"/>
                <p class="text-danger inputerror" id="nombre_completo_error"></p>
            </div>
            <div class="mb-3">
                <label class="form-label-mensaje" for="identityCard">Cédula de Identidad</label>
                <input class="form-control input-mensaje"   id="identityCard_propuesta" name="identityCard_propuesta" placeholder="" type="text"/>
                <p class="text-danger inputerror" id="ci_error"></p>
            </div>
            <div class="mb-3">
                <label class="form-label-mensaje" for="cellphone">Celular</label>
                <input class="form-control input-mensaje" id="cellphone_propuesta" name="cellphone_propuesta" placeholder="" type="text" onkeypress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;"/>
                <p class="text-danger inputerror" id="celular_error"></p>
            </div>
            <div class="mb-3">
                <label class="form-label-mensaje" for="email">Correo</label>
                <input class="form-control input-mensaje"  id="email_propuesta" name="email_propuesta" placeholder="" type="email"/>
                <p class="text-danger inputerror" id="correo_error"></p>
            </div>
            <style>
                .input-genero {
                    border-radius: 25px;
                    /*padding: 1rem;*/
                    border: 2px solid #7C4DFF;
                    margin-bottom: 1.5rem;
                }
                .input-genero:focus {
                    box-shadow: none;
                    border-color: #7C4DFF;
                }
            </style>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="genero" class="form-label-mensaje">Género</label>
                    <select class="form-control input-genero" name="genero" id="genero">
                        <option value="">Seleccione Un Genero</option>
                        <option value="Masculino">Masculino</option>
                        <option value="Femenino">Femenino</option>
                    </select>
                    <p class="text-danger inputerror" id="genero_error"></p>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="edad" class="form-label-mensaje">Edad</label>
                    <input type="text" class="form-control input-mensaje" id="edad" name="edad" onkeypress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;" maxlength="2">
                    <p class="text-danger inputerror" id="edad_error"></p>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="location" class="form-label">UBICACIÓN</label>
                    <textarea class="form-control input-mensaje" id="location_propuesta" name="location_propuesta" rows="3"></textarea>
                    <p class="text-danger inputerror" id="ubicacion_error"></p>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="projectDocs" class="form-label">DOCUMENTOS DE PROYECTO (link google drive)</label>
                    <textarea class="form-control input-mensaje" id="projectDocs_propuesta" name="projectDocs_propuesta" rows="3"></textarea>
                    <p class="text-danger inputerror" id="documento_proyecto_error"></p>
                    <a href="#" data-toggle="modal" data-target="#exampleModal">Como subir un archivo a Google Drive</a>
                </div>
            </div>
            <!-- Modal de Tutorial-->
            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title col-11 text-center" id="exampleModalLabel">Tutorial de como subir un archivo a Google Drive</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                    <!--Contenido-->
                        <iframe width="100%" height="315" src="https://www.youtube.com/embed/Su633B9eAMI" frameborder="0" allowfullscreen></iframe>
                    <!--fin contenido-->
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                    </div>
                </div>
            </div>
            {{--<div class="mb-3">    
                {!! NoCaptcha::renderJs() !!}
                {!! NoCaptcha::display() !!}
                <p class="text-danger inputerror" id="g-recaptcha-response_error"></p>
            </div>--}}
            <div class="text-center">
                <button class="btn-enviar" type="button" onclick="guardarpropuesta();">Enviar</button>
            </div>

        </form>
    </div>
   </div>
</div>
<script>
    function guardarpropuesta(){
        var nombrecompleto = document.getElementById("fullName_propuesta").value;
        var ci = document.getElementById("identityCard_propuesta").value;
        var celular = document.getElementById("cellphone_propuesta").value;
        var correo = document.getElementById("email_propuesta").value;
        var genero = document.getElementById("genero").value;
        var edad = document.getElementById("edad").value;
        var ubicacion = document.getElementById("location_propuesta").value;
        var documento_proyecto = document.getElementById("projectDocs_propuesta").value; 
        var dataToSend = {nombre_completo:nombrecompleto,ci:ci,celular:celular,correo:correo,ubicacion:ubicacion,documento_proyecto:documento_proyecto,genero:genero,edad:edad} 
        $.ajax({
            type:"POST",
            headers:{'Content-Type' : 'application/json','X-CSRF-TOKEN':'{{csrf_token()}}'},
            url: "{{route('guardar-propuesta')}}",
            async:false,
            data:JSON.stringify(dataToSend),
            success:function(data){
                if(data.state == false){
                    var errors = data.errors;
                    const fieldsToCheck = ["nombre_completo","ci","celular","correo","ubicacion","documento_proyecto","g-recaptcha-response","genero","edad"];
                    fieldsToCheck.forEach(field => {
                        if (!errors[field]) {
                            $("#" + field + "_error").text("");
                        } else {
                            $("#" + field + "_error").text(errors[field][0]);
                        }
                    });
                }else{
                    Swal.fire({title: 'Propuesta Enviada Correctamente', icon: 'success', timer:1500,showConfirmButton: false, focusConfirm: false}).then(function() {window.location = "/contacto";});
                }
            }
        });
    }
</script>
<style>
    .btn-lila-outline {
        color: #6c1b74;
        background-color: transparent;
        border: 2px solid #6c1b74; /* Color lila */
        border-radius: 25px;
        padding: 0.75rem 2rem;
        font-weight: 600;
        text-transform: uppercase;
    }
    .btn-lila-outline:hover {
        background-color: #6c1b74; /* Color lila al pasar el ratón (hover) */
        color: #fff; /* Cambia el color del texto al pasar el ratón (hover) */
    }
    .btn-oval {
        border-radius: 50px; 
    }
    .container {
        max-width: 600px;
        margin: 3rem auto;
        padding: 2rem;
        background-color: #fff;
        color: #000;
        border-radius: 16px;
        box-shadow: 0 4px 16px rgba(0,0,0,0.1);
    }
    .form-label-mensaje {
        font-weight: 600;
        margin-bottom: 0.5rem;
    }
    .input-mensaje {
        border-radius: 25px;
        padding: 1rem;
        border: 2px solid #7C4DFF;
        margin-bottom: 1.5rem;
    }
    .input-mensaje:focus {
        box-shadow: none;
        border-color: #7C4DFF;
    }
    .btn-enviar {
        background-color: #6c1b74;
        border: none;
        padding: 0.75rem 2rem;
        border-radius: 25px;
        font-weight: 600;
        text-transform: uppercase;
        color: #ffffff; 
    }
    .form-check-label {
        margin-left: 0.5rem;
    }
    .form-check-input {
        accent-color: #7C4DFF;
    }
</style>
<script>
    function mostrarFormulario(tipo) {
        if (tipo === 'mensaje') {
            document.getElementById('formMensaje').style.display = 'block';
            document.getElementById('formPropuesta').style.display = 'none';
        } else if (tipo === 'propuesta') {
            document.getElementById('formMensaje').style.display = 'none';
            document.getElementById('formPropuesta').style.display = 'block';
        }
    }
</script>
<!--script de recaptcha-->

<!--end formulario de contacto-->
@include('footer')