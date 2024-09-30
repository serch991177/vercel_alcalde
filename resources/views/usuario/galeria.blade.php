@include('head')
@include('navbar')
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
<!--Banner galeria fotografica-->
<link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<style>
    body {
        font-family: 'Poppins';font-size: 18px;
        text-align: justify;
    }
</style>
<div class="banner">
    <div class="banner-text">
        <span class="galeria-text" style="font-size: 85px;">GALERÍA</span> <br>
        <span class="fotografica" >FOTOGRÁFICA</span>
    </div>
</div>
<style>
    .galeria-text{
        color: rgba(255, 255, 255, 0.5); /* Texto blanco con opacidad */
    }
    .fotografica {
        display: inline-block;
            font-size: 3vw;
            position: relative;
            left: 40%;
            margin-top: -4vw;
    }
    .banner {
        position: relative;
        color: white;
        background-image: url('img/banner.jpg');
        background-size: cover;
        background-position: center;
        height: 500px;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    .banner::before{
        content: "";
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: linear-gradient(rgba(128, 0, 128, 0.5), rgba(128, 0, 128, 0.5)); /* Color lila */
    }
    .banner-text {
        /*background: rgba(0, 0, 0, 0.5);*/
        padding: 10px;
        font-weight: bold;
        margin-top: 338px;
    }
    @media (max-width: 768px) {
        /* Estilos adicionales para pantallas más pequeñas */
        .fotografica {
            margin-left: 0; /* Quitar el margen a la izquierda en dispositivos más pequeños */
            font-size: 9vw;
            left: 25%;
        }
    }
</style>
<!--end banner galeria fotografica-->
<!--buscador-->
<style>
    .input-mensaje {
        border-radius: 30px;
        padding: 1rem;
        margin: 0 auto 1.5rem auto; /* Establecer el margen izquierdo y derecho a "auto" */
        text-align: center;
        width:700px;
        height: 20px;
    }
    .search-button {
        background-color: transparent; /* Color de fondo transparente */
        border: none; /* Sin borde */
        cursor: pointer;
    }
    .search-button i {
      color: white; /* Color blanco del icono */
      font-size: 30px; /* Tamaño del icono (ajustado para mayor tamaño) */
    }
    .input-mensaje:focus {
        box-shadow: none;
        border-color: #7C4DFF;
    }
    @media (max-width: 768px) {
        /* Estilos adicionales para pantallas más pequeñas */
        .input-mensaje {
            width: 90%;
            font-size: 14px;
        }
    }
</style>
<div class="search-bar text-center" style="background-color: #473878;"><br>
  <input class="input-mensaje" type="text" placeholder="" name="input_galeria" id="input_galeria" >
  <button class=" search-button" type="button" onclick="buscarfoto()"><i class="fas fa-search"></i></button>
</div>
<!--end buscador-->
<!-- Gallery -->
<br>
<!-- Gallery -->
<!-- Incluye los estilos de Lightbox2 -->
<!-- Estilos de Lightbox2 -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/css/lightbox.min.css"  />
<div class="container" id="div_galeria">
    <div class="row">
        @php($chunks = $galeria->chunk(3))
        @php( $urlraiz = \URL::to('/'))
        @foreach ($chunks as $chunk)
            <div class="col-lg-4  mb-4 mb-lg-0 content-section">
                @foreach ($chunk as $galerias)
                    <a href="{{ $galerias->url }}" data-lightbox="gallery" data-title="{{ $galerias->descripcion_imagen }} <br><br><a href='https://www.facebook.com/sharer/sharer.php?u={{$galerias->url}}' target='_blank'><img src='https://upload.wikimedia.org/wikipedia/commons/thumb/b/b9/2023_Facebook_icon.svg/2048px-2023_Facebook_icon.svg.png' width='40px' alt='Facebook Icon'></a><a href='https://twitter.com/intent/tweet?url={{$galerias->url}}' target='_blank'><img src='https://upload.wikimedia.org/wikipedia/commons/thumb/5/57/X_logo_2023_%28white%29.png/480px-X_logo_2023_%28white%29.png' width='40px' alt='Twitter Icon'></a> <a href='https://api.whatsapp.com/send?text={{ $galerias->descripcion_imagen }} {{$galerias->url}}' target='_blank'><img src='https://upload.wikimedia.org/wikipedia/commons/thumb/6/6b/WhatsApp.svg/767px-WhatsApp.svg.png' width='40px' alt='Whatsap Icon'></a>" data-alt="{{ $galerias->titulo_imagen }}">
                        <img src="{{ $galerias->url }}" class="w-100 shadow-1-strong rounded mb-4" alt="{{ $galerias->titulo_imagen }}" />
                    </a>
                @endforeach
            </div>    
        @endforeach
    </div>
</div>
<div class="container">
    <div class="row" id="contenido_div_galeria">

    </div>
</div>

<div class="container">
    <div class="row justify-content-center">
        <ul class="pagination" id="pagination"></ul>
    </div>
</div>
<!-- Incluye el script de Lightbox2 -->
<!-- Asegúrate de incluir jQuery antes del script de Lightbox2 -->
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<!-- Script de Lightbox2 -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/js/lightbox.min.js" ></script>
<script>
    lightbox.option({'resizeDuration': 200,'wrapAround': true})
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twbs-pagination/1.4.2/jquery.twbsPagination.min.js"></script>
<!--paginacion con twbs-pagination-->
<script>
    $(document).ready(function(){
        var itemsPerPage = 3;
        // Ocultar todos los de videos
        $('.content-section').hide();
        // Mostrar las primeras 'itemsPerPage' de videos
        $('.content-section:lt(' + itemsPerPage + ')').show();
        // Inicializar el plugin de paginación
        $('#pagination').twbsPagination({
            totalPages: Math.ceil($('.content-section').length / itemsPerPage),
            visiblePages: 3,
            onPageClick: function (event, page) {
                var start = (page - 1) * itemsPerPage;
                var end = start + itemsPerPage;
                // Ocultar todas las tarjetas de videos
                $('.content-section').hide();
                // Mostrar los videos correspondientes a la página actual
                $('.content-section').slice(start,end).show();
            },
            first: false, // Deshabilitar la opción "first"
            last: false,   // Deshabilitar la opción "last"
            prev: '<', // Texto para la opción "Previous"
            next: '>' // Texto para la opción "Next"
        });
    });
</script>
<!--recuperar fotos buscadas-->
<script>
    function buscarfoto(){
        var valor_input_galeria = document.getElementById("input_galeria").value;
        if(valor_input_galeria.length == 0){
            swal.fire('Error','Por favor ingrese alguna palabra clave','error')
        }else{
            $.ajax({
                type:'POST',
                url:'{{route("busqueda-galeria")}}',
                headers:{'Content-Type':'application/json','X-CSRF-TOKEN':'{{csrf_token()}}'},
                data:JSON.stringify({'input_galeria':valor_input_galeria}),
                success:function(data){
                    if(data.data.length == 0){
                        swal.fire('Error','No existen fotografias con la palabra ingresada','error');
                    }else{
                        document.getElementById("div_galeria").style.display = 'none';
                        document.getElementById("pagination").style.display = 'none';
                        let divBusquedaGaleria = "";
                        var chunks = data.chunks;
                        var urlRaiz = data.urlRaiz;
                        data.data.forEach(function(galeria) {
                            divBusquedaGaleria += '<div class="col-lg-4 mb-4 mb-lg-0 content-section">';
                            divBusquedaGaleria += '<a href="' + galeria.url + '" data-lightbox="gallery" data-title="' + galeria.descripcion_imagen + '<br><br><a href=\'https://www.facebook.com/sharer/sharer.php?u=' + urlRaiz + galeria.url + '\' target=\'_blank\'><img src=\'https://upload.wikimedia.org/wikipedia/commons/thumb/b/b9/2023_Facebook_icon.svg/2048px-2023_Facebook_icon.svg.png\' width=\'40px\' alt=\'Facebook Icon\'></a><a href=\'https://twitter.com/intent/tweet?url=' + urlRaiz + galeria.url + '\' target=\'_blank\'><img src=\'https://upload.wikimedia.org/wikipedia/commons/thumb/5/57/X_logo_2023_%28white%29.png/480px-X_logo_2023_%28white%29.png\' width=\'40px\' alt=\'Twitter Icon\'></a> <a href=\'https://api.whatsapp.com/send?text=' + galeria.descripcion_imagen + ' ' + urlRaiz + galeria.url + '\' target=\'_blank\'><img src=\'https://upload.wikimedia.org/wikipedia/commons/thumb/6/6b/WhatsApp.svg/767px-WhatsApp.svg.png\' width=\'40px\' alt=\'Whatsapp Icon\'></a>" data-alt="' + galeria.titulo_imagen + '">';
                            divBusquedaGaleria += '<img src="' + galeria.url + '" class="w-100 shadow-1-strong rounded mb-4" alt="' + galeria.titulo_imagen + '" />';
                            divBusquedaGaleria += '</a>';
                            divBusquedaGaleria += '</div>';
                        });

                        document.getElementById('contenido_div_galeria').innerHTML = divBusquedaGaleria;
                    }
                },
                error:function(error){
                    console.log(error);
                }
            });
        }
    }
</script>
@include('footer')
