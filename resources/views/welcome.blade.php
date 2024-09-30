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
<!--<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>-->
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<!--Incluye la biblioteca Popper.js, que es utilizada por Bootstrap para manejar el posicionamiento de los elementos emergentes (popovers) y tooltips-->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<!--Incluye el archivo JavaScript de Bootstrap-->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
<!--Script para cargar el javascript de Owl Carousel-->
<script src='https://cdnjs.cloudflare.com/ajax/libs/owl-carousel/1.3.3/owl.carousel.min.js'></script>
<link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
<style>
    body {
        font-family: 'Poppins';font-size: 18px;
        text-align: justify;
    }
    .news-image{
        border-radius: 10px; /* You can adjust the value to control the roundness */
    }
</style>
<!--carousel-->
<style>
    /* Estilo para hacer los indicadores redondos */
    .carousel-indicators li {
        background-color: #777; /* Color de fondo de los indicadores inactivos */
        border-radius: 50%; /* Hace que los indicadores sean redondos */
        width: 12px; /* Tamaño del indicador */
        height: 12px;
        margin-right: 5px; /* Espaciado entre los indicadores */
    }
    .carousel-indicators .active {
        background-color: #fff; /* Color de fondo del indicador activo */
    }
    .carousel-item {
        position: relative;
    }
    .carousel-caption {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        text-align: center;
        color: white; /* Set the text color as needed */
    }
    .carousel-color::before{
        content: "";
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: linear-gradient(rgba(128, 0, 128, 0.5), rgba(128, 0, 128, 0.5)); /* Color lila */
    }
    .red-quotes{
        color: red;
        font-size: 2.2em; /* Adjust the font size as needed */
    }
    
    .social-icons {
        position: absolute;
        top: 300px; /* Adjust the top margin as needed */
        left: 20px;
        color: white;
        font-size: 24px;
        display: flex;
        flex-direction: column;
        align-items: center;
    }
    .social-icons i,.icon_tiktok  {
        margin-bottom: 30px; /* Adjust the spacing between icons as needed */
    }
    /* Responsive styles */
    @media (max-width: 768px) {
        .social-icons {
            display:none;
            top: 1px; /* Adjust the top margin for smaller screens */
            font-size: 18px; /* Adjust the font size for smaller screens */
            left: 10px; /* Adjust the left margin for smaller screens */
        }
    }
    /* Girar las flechas hacia abajo */
    .carousel-control-prev,
    .carousel-control-next {
        transform: rotate(90deg);
        position: absolute;
        top: 50%;
        transform: translateY(-50%);
        background: none;
        border: none;
        font-size: 24px;
        color: white;
        cursor: pointer;
    }

    .carousel-control-prev {
        left: 40px;
        top: 800px;
    }

    .carousel-control-next {
        right: -1px;
        top: 800px;
    }


    @media (max-width: 768px) {
        .responsive-caption {
            padding: 5px;
        }
        
        .responsive-logo {
            width: 10px;
        }
        
        .responsive-text {
            font-size: 8px;
        }
        
        .responsive-firma {    
            display: none; /* Inicialmente oculto */
        }
    }

</style>
<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel" >
    <div class="carousel-inner" >
        @foreach ($carousel as $carouseles)
            <div class="carousel-color carousel-item{{ $loop->first ? ' active' : '' }}">
                <img class="d-block w-100" src="{{ asset($carouseles->url) }}" alt="{{ $carouseles->descripcion_imagen }}">
                <div class="social-icons">
                    <!-- Add social media icons (Font Awesome) -->
                    <a href="https://www.facebook.com/ManfredReyesVillaOficial " target="_blank" class="text-white"><i class="fab fa-facebook" ></i></a>
                    <a href="https://www.instagram.com/manfred_oficial/" target="_blank" class="text-white" ><i class="fab fa-instagram"></i></a>
                    <a href="https://x.com/ManfredBolivia" target="_blank" class="text-white" style="margin-bottom:15px"><img src="img/X_logo_2023_(white).png" width="25px" alt="icon_twitter"></a>
                    <a href="https://www.linkedin.com/in/manfredreyesvillab/" target="_blank" class="text-white" style="margin-bottom:15px"><img src="img/linkedin_icon.png" alt="icon_linkedin" width="30px"></a>
                    <a href="https://www.threads.net/@manfred_oficial" target="_blank" class="text-white" style="margin-bottom:15px"><img src="img/threads.png" alt="icon_threads" width="50px"></a>
                    <a href="https://www.tiktok.com/@manfredbolivia" target="_blank" class="text-white" ><svg class="icon_tiktok" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="29pt"  viewBox="0 0 256 256" version="1.1"><g id="surface2796506"><path style=" stroke:none;fill-rule:evenodd;fill:rgb(100%,100%,100%);fill-opacity:1;" d="M 155.96875 97.703125 C 166.894531 105.507812 180.285156 110.097656 194.742188 110.097656 L 194.742188 88.210938 C 186.667969 86.488281 179.527344 82.273438 174.15625 76.414062 C 164.960938 70.683594 158.339844 61.226562 156.398438 50.152344 L 136.132812 50.152344 L 136.132812 161.210938 C 136.085938 174.15625 125.574219 184.636719 112.609375 184.636719 C 104.96875 184.636719 98.179688 181 93.882812 175.363281 C 86.207031 171.492188 80.945312 163.539062 80.945312 154.359375 C 80.945312 141.375 91.476562 130.847656 104.46875 130.847656 C 106.957031 130.847656 109.355469 131.238281 111.609375 131.953125 L 111.609375 109.835938 C 83.710938 110.410156 61.273438 133.191406 61.273438 161.21875 C 61.273438 175.210938 66.863281 187.890625 75.929688 197.152344 C 84.113281 202.644531 93.964844 205.847656 104.558594 205.847656 C 132.957031 205.847656 155.984375 182.835938 155.984375 154.449219 Z M 155.96875 97.703125 "/></g></svg></a>
                    <a href="https://whatsapp.com/channel/0029VabqAxhCMY09UGFHdF2w"  target="_blank" class="text-white" style="margin-bottom:15px"><i class="fa fa-whatsapp"></i></a>
                </div>
                <div class="carousel-caption responsive-caption">
                    <img class="responsive-logo" src="{{ asset('img/logo.png') }}" alt="logo" style="width: 100px;">
                    <p class="responsive-text"><span class="red-quotes">"</span> {{ $carouseles->descripcion_imagen }} <span class="red-quotes">"</span></p>
                    <img class="responsive-firma" src="{{ asset('img/firma.png') }}" alt="firma" style="width:300px;">
                </div>
            </div>
        @endforeach
    </div>
    <ol class="carousel-indicators">
        @foreach ($carousel as $key => $carouseles)
            <li data-target="#carouselExampleIndicators" data-slide-to="{{ $key }}"{{ $loop->first ? ' class="active"' : '' }}></li>
        @endforeach
    </ol>
    <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
    </a>
</div>
<!--end carousel-->
<!--cards type carousel-->
    <br>
    <h2 class="text-2xl font-bold text-center mb-6 " style="color: #8a2be2;">Noticias Destacadas</h2>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div id="news-slider" class="owl-carousel">
                    @foreach ($seccion as $secciones)
                        <div class="post-slide">
                            <div class="post-img">
                                <img src="{{ $secciones->url }}" alt="">
                                <!--<a href="#" class="over-layer"><i class="fa fa-link"></i></a>-->
                            </div>
                            <div class="post-content">
                                <h3 class="post-title">
                                    <div class="text-center">
                                        {{--<a href="#" style="color: #8a2be2;">{{ $secciones->titulo_imagen }}</a>--}}
                                        <a href="#" class="recuperar_id_seccion"  style="color: #8a2be2;" data-id="{{$secciones->id_imagenes}}" data-toggle="modal" data-target="#exampleModal">{{ $secciones->titulo_imagen }}</a>
                                    </div>
                                </h3>
                                @php
                                    $descripcionLimpia = preg_replace('/\s+/', ' ', trim($secciones->descripcion_imagen));
                                @endphp
                                <p class="post-description">{{ Str::limit($descripcionLimpia, 200) }}</p>
                                <span class="post-date"><i class="fa fa-clock-o"></i>{{ $secciones->fecha_registro }}</span>
                                <!--<a href="#" class="read-more">read more</a>-->
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    <!-- Modal de secciones-->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title col-11 text-center" id="exampleModalLabel"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
            <!--Contenido-->
            <div class="text-center">
                <img src="" alt="" id="imagen_seccion_url" class="imagen_responsive_modal">
            </div>
            <div class="text-center">
                <p id="descripcion_seccion_modal"></p>
            </div>
            <!--fin contenido-->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
            </div>
        </div>
    </div>
    <style>
        #news-slider {
            margin-top: 80px;
        }
        .post-slide {
            background: #fff;
            margin: 20px 15px 20px;
            border-radius: 15px;
            padding-top: 1px;
            box-shadow: 0px 14px 22px -9px #bbcbd8;
        }
        .post-slide .post-img {
            position: relative;
            overflow: hidden;
            border-radius: 10px;
            margin: -12px 15px 8px 15px;
            margin-left: -10px;
        }
        .post-slide .post-img img {
            width: 100%;
            height: auto;
            transform: scale(1, 1);
            transition: transform 0.2s linear;
        }
        .post-slide:hover .post-img img {
            transform: scale(1.1, 1.1);
        }
        .post-slide .over-layer {
            width: 100%;
            height: 100%;
            position: absolute;
            top: 0;
            left: 0;
            opacity: 0;
            background: linear-gradient(-45deg, rgba(6, 190, 244, 0.75) 0%, rgba(45, 112, 253, 0.6) 100%);
            transition: all 0.50s linear;
        }
        .post-slide:hover .over-layer {
            opacity: 1;
            text-decoration: none;
        }
        .post-slide .over-layer i {
            position: relative;
            top: 45%;
            text-align: center;
            display: block;
            color: #fff;
            font-size: 25px;
        }
        .post-slide .post-content {
            background: #fff;
            padding: 2px 20px 40px;
            border-radius: 15px;
        }
        .post-slide .post-title a {
            font-size: 15px;
            font-weight: bold;
            color: #333;
            display: inline-block;
            text-transform: uppercase;
            transition: all 0.3s ease 0s;
        }
        .post-slide .post-title a:hover {
            text-decoration: none;
            color: #3498db;
        }
        .post-slide .post-description {
            line-height: 24px;
            color: #808080;
            margin-bottom: 25px;
        }
        .post-slide .post-date {
            color: #a9a9a9;
            font-size: 14px;
        }
        .post-slide .post-date i {
            font-size: 20px;
            margin-right: 8px;
            color: #CFDACE;
        }
        .post-slide .read-more {
            padding: 7px 20px;
            float: right;
            font-size: 12px;
            background: #2196F3;
            color: #ffffff;
            box-shadow: 0px 10px 20px -10px #1376c5;
            border-radius: 25px;
            text-transform: uppercase;
        }
        .post-slide .read-more:hover {
            background: #3498db;
            text-decoration: none;
            color: #fff;
        }

        .owl-controls .owl-buttons {
            text-align: center;
            margin-top: 20px;
        }
        .owl-controls .owl-buttons .owl-prev {
            background: #fff;
            position: absolute;
            top: 50%;
            left: -30px;
            padding: 0 18px 0 15px;
            border-radius: 50px;
            box-shadow: 3px 14px 25px -10px #92b4d0;
            transition: background 0.5s ease 0s;
        }
        .owl-controls .owl-buttons .owl-next {
            background: #fff;
            position: absolute;
            top: 50%;/**-13% */
            right: -30px;/**-30 */
            padding: 0 15px 0 18px;
            border-radius: 50px;
            box-shadow: -3px 14px 25px -10px #92b4d0;
            transition: background 0.5s ease 0s;
        }
        .owl-controls .owl-buttons .owl-prev:after,
        .owl-controls .owl-buttons .owl-next:after {
            content: "\f104";
            font-family: FontAwesome;
            color: #333;
            font-size: 30px;
        }
        .owl-controls .owl-buttons .owl-next:after {
            content: "\f105";
        }
        /* Responsive styles */
        @media (max-width: 768px) {
            .owl-controls .owl-buttons .owl-prev {
            background: #fff;
            position: absolute;
            top: -13%;
            left: 15px;
            padding: 0 18px 0 15px;
            border-radius: 50px;
            box-shadow: 3px 14px 25px -10px #92b4d0;
            transition: background 0.5s ease 0s;
        }
        .owl-controls .owl-buttons .owl-next {
            background: #fff;
            position: absolute;
            top: -13%;/**-13% */
            right: 15px;/**-30 */
            padding: 0 15px 0 18px;
            border-radius: 50px;
            box-shadow: -3px 14px 25px -10px #92b4d0;
            transition: background 0.5s ease 0s;
        }
        }
        
        @media only screen and (max-width:1280px) {
            .post-slide .post-content {
                padding: 0px 15px 25px 15px;
            }
        }
    </style>
    <script>
        $(document).ready(function () {
            $("#news-slider").owlCarousel({
            items: 3,
            itemsDesktop: [1199, 3],
            itemsDesktopSmall: [980, 2],
            itemsMobile: [600, 1],
            navigation: true,
            navigationText: ["", ""],
            pagination: true,
            autoPlay: true });
        });
    </script>
<!--end cards type carousel-->
<!--Noticias destacadas-->
<style>
    .highlight {
        border-right: 1px solid #000000; /* Línea vertical entre divs */
    }
    .highlight:last-child {
        border-right: none; /* Elimina la línea vertical en el último div */
    }
    .highlight-title {
        font-size: 18px;
        font-weight: bold;
        margin-bottom: 10px;
    }
    .highlight-text {
        font-size: 14px;
    }
    /* Ajustes para dispositivos móviles */
    @media (max-width: 767px) {
        .highlight {
            padding-right: 0;
            margin-right: 0;
            border-right: none; /* Elimina la línea vertical en dispositivos móviles */
            border-bottom: 1px solid #ddd; /* Elimina la línea horizontal en dispositivos móviles */
        }
    }
</style>
<div class="container" style="background-color: #f1efef; border-radius: 15px; margin-top: 30px; padding: 20px;">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="highlighted-news">
                    <h2 class="text-center" style="color: #8a2be2;">Ultimas Noticias</h2>
                    <!--noticia destacada 1-->
                    @if(isset($noticias_destacadas[0]))
                    <div class="row">
                        <div class="col-md-6">
                            <img  src="{{$noticias_destacadas[0]->url}}" alt="{{$noticias_destacadas[0]->titulo_noticia}}" class="news-image img-fluid">
                        </div>
                        <div class="col-md-6">
                        <div class="news-header" style="color: #8a2be2;">{{ucwords(mb_strtoupper($noticias_destacadas[0]->titulo_noticia,"UTF-8"))}}</div>
                            <p id="descripcionnoticiadestacada1" data-target="descripcionnoticiadestacada1" class="texto-recortado">{{$noticias_destacadas[0]->descripcion_noticia}}</p>
                            <a type="button" class="text-black read-more recuperar_id" data-id="{{$noticias_destacadas[0]->id_noticias}}" data-toggle="modal" data-target="#ModalNoticia">LEER MÁS<i class="fas fa-arrow-right"></i></a>
                            <!--<p class="news-source">Nombre fuente de la noticia</p>-->
                        </div>
                    </div><br>
                    <div  style="border-top: 1px solid #000000; height: 20px; max-width: 2000px; padding: 0; margin: 0px auto 0 auto;"></div>
                    @endif
                    <br>
                    <!--noticia destacada 2-->
                    @if(isset($noticias_destacadas[1]))
                    <div class="row">
                        <div class="col-md-6">
                            <img src="{{$noticias_destacadas[1]->url}}" alt="{{$noticias_destacadas[1]->titulo_noticia}}" class="news-image img-fluid">
                        </div>
                        <div class="col-md-6">
                        <div class="news-header" style="color: #8a2be2;">{{ucwords(mb_strtoupper($noticias_destacadas[1]->titulo_noticia,"UTF-8"))}}</div>
                            <p id="descripcionnoticiadestacada2" data-target="descripcionnoticiadestacada2" class="texto-recortado">{{$noticias_destacadas[1]->descripcion_noticia}}</p>
                            <a type="button" class="text-black read-more recuperar_id" data-id="{{$noticias_destacadas[1]->id_noticias}}" data-toggle="modal" data-target="#ModalNoticia">LEER MÁS<i class="fas fa-arrow-right"></i></a>
                            <!--<p class="news-source">Nombre fuente de la noticia</p>-->
                        </div>
                    </div>
                    @endif<br>
                    <div  style="border-top: 1px solid #000000; height: 20px; max-width: 2000px; padding: 0; margin: 0px auto 0 auto;"></div>
                </div>
            </div>
        </div>
    </div>
    <br>
    <div class="container">
        <div class="row">
            <!--noticia destacada 3-->
            @if(isset($noticias_destacadas[2]))
            <div class="col-md-4 highlight">
                <div class="highlight-title" style="color: #8a2be2;">{{ucwords(mb_strtoupper($noticias_destacadas[2]->titulo_noticia,"UTF-8"))}}</div>
                <div class="highlight-text">
                    <p id="descripcionnoticiadestacada3" data-target="descripcionnoticiadestacada3" class="texto-recortado">{{$noticias_destacadas[2]->descripcion_noticia}}</p>
                    <a type="button" class="text-black read-more recuperar_id" data-id="{{$noticias_destacadas[2]->id_noticias}}" data-toggle="modal" data-target="#ModalNoticia">LEER MÁS<i class="fas fa-arrow-right"></i></a>
                </div>
            </div>
            @endif
            <!--noticia destacada 4-->
            @if(isset($noticias_destacadas[3]))
            <div class="col-md-4 highlight">
                <div class="highlight-title" style="color: #8a2be2;">{{ucwords(mb_strtoupper($noticias_destacadas[3]->titulo_noticia,"UTF-8"))}}</div>
                <div class="highlight-text">
                    <p id="descripcionnoticiadestacada4" data-target="descripcionnoticiadestacada4" class="texto-recortado">{{$noticias_destacadas[3]->descripcion_noticia}}</p>
                    <a type="button" class="text-black read-more recuperar_id" data-id="{{$noticias_destacadas[3]->id_noticias}}" data-toggle="modal" data-target="#ModalNoticia">LEER MÁS<i class="fas fa-arrow-right"></i></a>
                </div>
            </div>
            @endif
            <!--noticia destacada 5-->
            @if(isset($noticias_destacadas[4]))
            <div class="col-md-4 highlight">
                <div class="highlight-title" style="color: #8a2be2;">{{ucwords(mb_strtoupper($noticias_destacadas[4]->titulo_noticia,"UTF-8"))}}</div>
                <div class="highlight-text">
                    <p id="descripcionnoticiadestacada5" data-target="descripcionnoticiadestacada5" class="texto-recortado">{{$noticias_destacadas[4]->descripcion_noticia}}</p>
                    <a type="button" class="text-black read-more recuperar_id" data-id="{{$noticias_destacadas[4]->id_noticias}}" data-toggle="modal" data-target="#ModalNoticia">LEER MÁS<i class="fas fa-arrow-right"></i></a>
                </div>
            </div>
            @endif
        </div>
    </div>
</div>
<!--end noticias destacadas -->
<!--estilos de modal de imagenes-->
<style>
    .imagen_responsive_modal {
        width: 700px;
    }
    /* Responsive styles */
    @media (max-width: 768px) {
        .imagen_responsive_modal {
            width:320px;
        }
    }
</style>
<!-- Modal de ver noticia destacada completa-->
<div class="modal fade" id="ModalNoticia" tabindex="-1" role="dialog" aria-labelledby="ModalNoticiaTitle" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title col-11 text-center" id="ModalNoticiaTitle"></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <!--Contenido-->
        <div class="text-center">
            <img src="" alt="" id="imagen_noticia_url" class="imagen_responsive_modal">
        </div>
        <div class="text-center">
            <p id="descripcion_noticia_modal"></p>
        </div>
        <!--Fin Contenido-->
      </div>
      <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
      </div>    
    </div>
  </div>
</div>
<!--Fin modal de ver noticia destacada completa-->
<!-- Script JavaScript para manejar el recorte -->
<script>
    document.addEventListener("DOMContentLoaded", function () {
        var verMenos = document.querySelectorAll('.texto-recortado');
        var maxCaracteres = 450; 
        verMenos.forEach(function (btn) {
            var targetId = btn.getAttribute('data-target');
            var descripcionEntrevista = document.getElementById(targetId);
            if (descripcionEntrevista.innerHTML.length > maxCaracteres) {
                var textoRecortado = descripcionEntrevista.innerHTML.slice(0, maxCaracteres);
                descripcionEntrevista.innerHTML = textoRecortado + '...';
            }
        });
    });
</script>
<!--Script para recuperar datos en los modales-->
<script>
    $(document).ready(function(){
        $(document).on('click','.recuperar_id',function(){
            var id = $(this).data('id');
            $.ajax({
                type:"POST",
                headers: {'Content-Type':'application/json','X-CSRF-TOKEN':'{{ csrf_token() }}'},
                url: "{{route('recuperar-noticia')}}",
                async:false,
                data:JSON.stringify({'id_noticia':id}),
                success:function (data){
                    if(data.status==true){
                        document.getElementById("ModalNoticiaTitle").innerText = data.data.titulo_noticia;
                        document.getElementById("descripcion_noticia_modal").innerText = data.data.descripcion_noticia;
                        document.getElementById("imagen_noticia_url").src = data.data.url;
                    }
                }
            });
        });
    });
</script>
<!--Script para recuperar datos de la seccion en los modales-->
<script>
    $(document).ready(function(){
        $(document).on('click','.recuperar_id_seccion',function(){
            var id = $(this).data('id');
            $.ajax({
                type:"POST",
                headers: {'Content-Type':'application/json','X-CSRF-TOKEN':'{{ csrf_token() }}'},
                url: "{{route('recuperar-seccion-info')}}",
                async:false,
                data:JSON.stringify({'id_imagenes':id}),
                success:function(data){
                    if(data.status==true){
                        document.getElementById("exampleModalLabel").innerText = data.data.titulo_imagen;
                        document.getElementById("descripcion_seccion_modal").innerText = data.data.descripcion_imagen; 
                        document.getElementById("imagen_seccion_url").src = data.data.url; 
                    }
                }
            });
        })
    })
</script>
@include('footer')
