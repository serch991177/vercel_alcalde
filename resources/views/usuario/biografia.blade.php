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
<link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
<style>
    body {
        font-family: 'Poppins';font-size: 18px;
        text-align: justify;
    }
</style>
<!--Biografia-->
<div class="container hide_div">
    <div class="row justify-content-center">
        <img alt="image biography responsive" class="img-fluid" src="img/alcalde (16 cm y 200p).png" width="300" height="450">
    </div>
</div>
<div class="container">
    <div class="profile-container">
        <div class="profile-content">
            <div class="text-center">
                <button type="button" class="btn btn-lila-outline btn-oval" onclick="changeLanguage('es')">ESPAÑOL</button>
                <button type="button" class="btn btn-lila-outline btn-oval" onclick="changeLanguage('en')">ENGLISH</button>
            </div><br>
            <h2 class="text-center" id="biography-title">Capitán Manfred Reyes Villa Bacigalupi</h2>
            <p id="bio-paragraph-1">{{$biografia->biografia_spanish}}</P>
        </div>
        <div class="profile-image" >
            <img alt="image biography" class="img-fluid" src="img/alcalde (16 cm y 200p).png" width="300" height="450">
        </div>
        
    </div>
    <a href="https://www.cochabamba.bo/documents/pdf/Manfred-Reyes-Villa.pdf" target="_blank" download>Descargar Biografia</a>
</div>
<br>
<style>    
    .btn-lila-outline {
        color: #6c1b74;
        background-color: transparent;
        border: 2px solid #6c1b74; /* Color lila */
        border-radius: 25px;
        padding: 0.75rem 2rem;
        font-weight: 100;
        text-transform: uppercase;
    }
    .btn-lila-outline:hover {
        background-color: #6c1b74; /* Color lila al pasar el ratón (hover) */
        color: #fff; /* Cambia el color del texto al pasar el ratón (hover) */
    }
    .btn-oval {
        border-radius: 50px; 
    }
    .profile-container {
      display: flex;
      padding: 20px;
    }
    .profile-image {
      flex: 0 0 auto;
      width: 30%;
      padding-right: 20px;
    }
    .profile-content {
      flex: 1;
      background-color: #fff;
      padding: 20px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
      overflow-y: auto;
      max-height: 600px;
    }
    .profile-content h2 {
      font-size: 24px;
      margin-bottom: 20px;
    }
    .profile-content p {
      font-size: 16px;
      line-height: 1.6;
      color: #333;
    }
    .hide_div{
        display: none;
    }
    /* Responsive styles */
    @media (max-width: 768px) {
        .profile-image {
            display: none;
        }
        .hide_div{
            display:inline-block;

        }
        .btn-responsive {
            width: 100%; /* Hacer que el botón ocupe el ancho completo */
            margin-top: 5px; /* Agregar un pequeño margen superior para separar del párrafo */
        }
    }
</style>
<script>
    $(document).ready(function(){ 
        document.getElementById('biography-title').innerText = 'Capitán Manfred Reyes Villa Bacigalupi';
        var bioParagraph = `{!! addslashes($biografia->biografia_spanish) !!}`;
        document.getElementById('bio-paragraph-1').innerText = bioParagraph;
    })
</script>
<script>
    function changeLanguage(language) {
        if (language === 'es') {
            document.getElementById('biography-title').innerText = 'Capitán Manfred Reyes Villa Bacigalupi';
            var bioParagraph = `{!! addslashes($biografia->biografia_spanish) !!}`;
            document.getElementById('bio-paragraph-1').innerText = bioParagraph;
           
        } else if (language === 'en') {
            document.getElementById('biography-title').innerText = 'Captain Manfred Reyes Villa Bacigalupi';
            var bioParagraph = `{!! addslashes($biografia->biografia_english) !!}`;
            document.getElementById('bio-paragraph-1').innerText = bioParagraph;
            
        }
    }
</script>

<!--End biografia-->
<!--Entrevistas destacadas-->
<!--Codigo de abajo funciona-->
<!--<div class="highlighted-interviews">
   <h2 class="text-center" >EN LAS REDES <br>SOCIALES</h2>
    <div class="container">
        <div class="row">
            @php($count=1)
            @foreach($entrevistas as $entrevista)
                <div class="col-md-6">
                    <div class="interview-card text-center">    
                        <img alt="{{$entrevista->titulo_entrevista}}" height="100" src="{{$entrevista->url}}" width="100"/>
                        <p id="descripcionEntrevista{{$count}}" data-target="descripcionEntrevista{{$count}}" class="texto-recortado">{{$entrevista->descripcion_entrevista}} </p>
                        <button type="button" class="btn btn-purple-outline btn-oval recuperar_id btn-responsive"  value="{{$entrevista->id_entrevistas}}" data-toggle="modal" data-target="#ModalEntrevista">Ver más</button>
                        <div>
                            
                        </div>
                    </div>
                </div>
            @php($count++)    
            @endforeach
        </div>
        <div class="text-center">
            <ul class="pagination"></ul>
        </div>
    </div>
</div>-->
<!--Iframes-->
<!--<div class="highlighted-interviews">
   <h2 class="text-center" >EN LAS REDES <br>SOCIALES</h2>
    <div class="container">
        <div class="row">
            @php($count=1)
            @foreach($entrevistas as $entrevista)
                <div class="col-md-6">
                    <div class="interview-card text-center">   
                        <p style="text-align: center;">                           
                            {!! $entrevista->link_entrevista !!}
                        </p>
                    </div>
                </div>
            @php($count++)    
            @endforeach
        </div>
        <div class="text-center">
            <ul class="pagination"></ul>
        </div>
    </div>
</div>-->
<!--nuevo diseno con 1 iframe por red social-->
<!--<div class="highlighted-interviews"> 
    <h2 class="text-center">EN LAS REDES <br> SOCIALES</h2>
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <iframe src="https://www.instagram.com/p/C43AehUsziG/embed/" frameborder="0" scrolling="no" allowtransparency="true" " class="instagram-embed"  ></iframe>
            </div>
            <div class="col-md-4">
                <blockquote class="tiktok-embed" cite="https://www.tiktok.com/@manfredbolivia/video/7349562902812085509" data-video-id="7349562902812085509"> <section> <a target="_blank" title="@manfredbolivia" href="https://www.tiktok.com/@manfredbolivia?refer=embed">@manfredbolivia</a> Llegamos a la Ciudad Blanca para invitar a nuestros hermanos chuquisaqueños a participar de la <a title="fexco2024" target="_blank" href="https://www.tiktok.com/tag/fexco2024?refer=embed">#FEXCO2024</a> ¡Los esperamos en la mejor ciudad de <a title="bolivia🇧🇴" target="_blank" href="https://www.tiktok.com/tag/bolivia%F0%9F%87%A7%F0%9F%87%B4?refer=embed">#Bolivia🇧🇴</a>! <a title="cochabamba" target="_blank" href="https://www.tiktok.com/tag/cochabamba?refer=embed">#Cochabamba</a> <a title="sucre" target="_blank" href="https://www.tiktok.com/tag/sucre?refer=embed">#sucre</a> <a title="love" target="_blank" href="https://www.tiktok.com/tag/love?refer=embed">#love</a> <a title="work" target="_blank" href="https://www.tiktok.com/tag/work?refer=embed">#work</a> <a target="_blank" title="♬ La Flor de Sama - Esther Marisol" href="https://www.tiktok.com/music/La-Flor-de-Sama-6845191953584228353?refer=embed">♬ La Flor de Sama - Esther Marisol</a> </section> </blockquote> <script async src="https://www.tiktok.com/embed.js"></script>
            </div>
            <div class="col-md-4">
                <blockquote class="twitter-tweet"><p lang="es" dir="ltr">Gracias a Dios, a mi familia y a todo mi pueblo cochabambino. Hoy asumo el desafío de levantar a nuestra Llajta y reafirmo la promesa que hice de dar mi vida por esta tierra y por mi patria. ¡Todos unidos, vamos por días mejores! <a href="https://twitter.com/hashtag/CochaSomosTodos?src=hash&amp;ref_src=twsrc%5Etfw">#CochaSomosTodos</a> <a href="https://t.co/yfETPwlIko">pic.twitter.com/yfETPwlIko</a></p>&mdash; Manfred Reyes Villa (@ManfredBolivia) <a href="https://twitter.com/ManfredBolivia/status/1389332713770004481?ref_src=twsrc%5Etfw">May 3, 2021</a></blockquote> <script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>
            </div>
            <div class="col-md-4">
                <iframe src="https://www.facebook.com/plugins/video.php?height=314&href=https%3A%2F%2Fwww.facebook.com%2FManfredReyesVillaOficial%2Fvideos%2F7256796947731652%2F&show_text=false&width=560&t=0" width="460" height="314" style="border:none;overflow:hidden" scrolling="no" frameborder="0" allowfullscreen="true" allow="autoplay; clipboard-write; encrypted-media; picture-in-picture; web-share" allowFullScreen="true"></iframe>
            </div>
        </div>
    </div>
</div>-->
<style>
    .columns_div {
        display: flex;
        flex-wrap: wrap;
        justify-content: space-between;
    }
    .column {
        width: calc(25% - 10px); /* Establece el ancho de cada columna */
        margin-bottom: 20px; /* Espacio entre las columnas */
        padding: 20px;
        box-sizing: border-box;
    }
    /* Estilos adicionales para hacerlo más visual */
    .column:nth-child(odd) {
    }
    .column h2 {
        margin-top: 0;
    }
    /* Media query para dispositivos con un ancho máximo de 768px */
    @media screen and (max-width: 768px) {
        .column {
            width: 100%; /* Cambia el ancho de las columnas a 100% para que ocupen todo el ancho en dispositivos más pequeños */
        }
    }
    /* Media query para iPad Air */
    @media screen and (max-width: 1024px) {
        .column {
            width: 100%; /* Cambia el ancho de las columnas a 100% para que ocupen todo el ancho en iPad Air */
        }
    }
</style>

<div class="highlighted-interviews">
    <h2 class="text-center" >EN LAS REDES <br>SOCIALES</h2>
    <div class="columns_div">
        @foreach($entrevistas as $entrevista)
            <div class="column text-center"> 
                <img alt="logo-red-social" height="100" src="{{$entrevista->url}}" width="100"/><br>
                <p id="iframeContainer" style="text-align: center;">{!! $entrevista->link_entrevista !!}</p> 
            </div>
        @endforeach
        <!--<div class="column text-center">
            <h2 class="text-center">Logo instagram</h2>
            <iframe src="https://www.instagram.com/p/C43AehUsziG/embed/" frameborder="0" scrolling="no" allowtransparency="true"  class="instagram-embed"  ></iframe>
        </div>
        <div class="column text-center">
            <h2 class="text-center">Logo Tiktok</h2>
            <blockquote class="tiktok-embed" cite="https://www.tiktok.com/@manfredbolivia/video/7349562902812085509" data-video-id="7349562902812085509" style="max-width: 605px;min-width: 325px;" > <section> <a target="_blank" title="@manfredbolivia" href="https://www.tiktok.com/@manfredbolivia?refer=embed">@manfredbolivia</a> Llegamos a la Ciudad Blanca para invitar a nuestros hermanos chuquisaqueños a participar de la <a title="fexco2024" target="_blank" href="https://www.tiktok.com/tag/fexco2024?refer=embed">#FEXCO2024</a> ¡Los esperamos en la mejor ciudad de <a title="bolivia🇧🇴" target="_blank" href="https://www.tiktok.com/tag/bolivia%F0%9F%87%A7%F0%9F%87%B4?refer=embed">#Bolivia🇧🇴</a>! <a title="cochabamba" target="_blank" href="https://www.tiktok.com/tag/cochabamba?refer=embed">#Cochabamba</a> <a title="sucre" target="_blank" href="https://www.tiktok.com/tag/sucre?refer=embed">#sucre</a> <a title="love" target="_blank" href="https://www.tiktok.com/tag/love?refer=embed">#love</a> <a title="work" target="_blank" href="https://www.tiktok.com/tag/work?refer=embed">#work</a> <a target="_blank" title="♬ La Flor de Sama - Esther Marisol" href="https://www.tiktok.com/music/La-Flor-de-Sama-6845191953584228353?refer=embed">♬ La Flor de Sama - Esther Marisol</a> </section> </blockquote> <script async src="https://www.tiktok.com/embed.js"></script>        </div>
        <div class="column text-center">
            <h2 class="text-center">Logo twitter</h2>
            <blockquote class="twitter-tweet"><p lang="es" dir="ltr">Gracias a Dios, a mi familia y a todo mi pueblo cochabambino. Hoy asumo el desafío de levantar a nuestra Llajta y reafirmo la promesa que hice de dar mi vida por esta tierra y por mi patria. ¡Todos unidos, vamos por días mejores! <a href="https://twitter.com/hashtag/CochaSomosTodos?src=hash&amp;ref_src=twsrc%5Etfw">#CochaSomosTodos</a> <a href="https://t.co/yfETPwlIko">pic.twitter.com/yfETPwlIko</a></p>&mdash; Manfred Reyes Villa (@ManfredBolivia) <a href="https://twitter.com/ManfredBolivia/status/1389332713770004481?ref_src=twsrc%5Etfw">May 3, 2021</a></blockquote> <script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>
        </div>
        <div class="column text-center">
            <h2 class="text-center">Logo facebook</h2>
            <iframe src="https://www.facebook.com/plugins/video.php?height=314&href=https%3A%2F%2Fwww.facebook.com%2FManfredReyesVillaOficial%2Fvideos%2F7256796947731652%2F&show_text=false&width=560&t=0" width="460" height="314" style="border:none;overflow:hidden" scrolling="no" frameborder="0" allowfullscreen="true" allow="autoplay; clipboard-write; encrypted-media; picture-in-picture; web-share" allowFullScreen="true"></iframe>
        </div>-->
    </div>
    <div class="text-center">
        <ul class="pagination"></ul>
    </div>
</div>





</style>

<!--paginacion con twbs-pagination-->
<script>
    $(document).ready(function(){
        var itemsPerPage = 4;

        // Ocultar todas las tarjetas de entrevistas
        $('.column').hide();

        // Mostrar las primeras 'itemsPerPage' tarjetas de entrevistas
        $('.column:lt(' + itemsPerPage + ')').show();

        // Inicializar el plugin de paginación
        $('.pagination').twbsPagination({
            totalPages: Math.ceil($('.column').length / itemsPerPage),
            visiblePages: 3,
            onPageClick: function (event, page) {
                var start = (page - 1) * itemsPerPage;
                var end = start + itemsPerPage;

                // Ocultar todas las tarjetas de entrevistas
                $('.column').hide();

                // Mostrar las tarjetas de entrevistas correspondientes a la página actual
                $('.column').slice(start,end).show();
            },
            first: false, // Deshabilitar la opción "first"
            last: false,   // Deshabilitar la opción "last"
            prev: 'Anterior', // Texto para la opción "Previous"
            next: 'Siguiente' // Texto para la opción "Next"
        });
    });
</script>
<!-- Modal de ver entrevista completa-->
<div class="modal fade" id="ModalEntrevista" tabindex="-1" role="dialog" aria-labelledby="ModalEntrevistaTitle" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title col-11 text-center" id="ModalEntrevistaTitle"></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <!--Contenido-->
        <div class="text-center">
            <img src="" alt="" id="imagen_entrevista_url" class="imagen_responsive_modal">
        </div>
        <div class="text-center">
            <p id="descripcion_entrevista_modal"></p>
        </div>
        <!--<a href="" id="link_entrevista_modal" target="_blank">Link de Entrevista completa</a>-->
        <div id="iframe_redes_sociales" class="text-center" >

        </div>
        <!--Fin Contenido-->
      </div>
      <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
      </div>    
    </div>
  </div>
</div>
<!--Fin modal de ver entrevista completa-->
    
<!--<div class="container">
    <br><iframe src="https://www.facebook.com/plugins/video.php?height=314&href=https%3A%2F%2Fwww.facebook.com%2FManfredReyesVillaOficial%2Fvideos%2F7256796947731652%2F&show_text=false&width=560&t=0" width="560" height="314" style="border:none;overflow:hidden" scrolling="no" frameborder="0" allowfullscreen="true" allow="autoplay; clipboard-write; encrypted-media; picture-in-picture; web-share" allowFullScreen="true"></iframe>
</div><br>
<div class="container">
    <iframe src="https://www.facebook.com/plugins/post.php?href=https%3A%2F%2Fwww.facebook.com%2FManfredReyesVillaOficial%2Fposts%2Fpfbid0yiQUj5b8MByzp1nJM9zLcH7VhyK4N8MVuVwgP6cJpZx6boGpHNZHpyviUyM7ZwmNl&show_text=true&width=500" width="500" height="645" style="border:none;overflow:hidden" scrolling="no" frameborder="0" allowfullscreen="true" allow="autoplay; clipboard-write; encrypted-media; picture-in-picture; web-share"></iframe><br>
</div><br>
<div class="container">
    <blockquote class="twitter-tweet"><p lang="es" dir="ltr">Aprovechamos nuestra visita al distrito 15 para hacer la entrega de Resoluciones Administrativas Municipales a 6 Juntas Vecinales de la Mancomunidad Arrumani, un importante avance en la regularización de la documentación que les permitirá obtener su derecho propietario. <a href="https://t.co/MKM6Eie5Wu">pic.twitter.com/MKM6Eie5Wu</a></p>&mdash; Manfred Reyes Villa (@ManfredBolivia) <a href="https://twitter.com/ManfredBolivia/status/1769476209115599040?ref_src=twsrc%5Etfw">March 17, 2024</a></blockquote> <script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script><br>
</div><br>
<div class="container">
    <blockquote class="twitter-tweet" data-media-max-width="560"><p lang="es" dir="ltr">Visitamos <a href="https://twitter.com/hashtag/Tarija?src=hash&amp;ref_src=twsrc%5Etfw">#Tarija</a> para presentar oficialmente la Feria Exposición Internacional de <a href="https://twitter.com/hashtag/Cochabamba?src=hash&amp;ref_src=twsrc%5Etfw">#Cochabamba</a> e invitar a toda la familia tarijeña y al empresariado, a ser parte de esta versión que promete superar todas las expectativas. Será un privilegio contar con las grandes potencialidades… <a href="https://t.co/lemhHdB5rJ">pic.twitter.com/lemhHdB5rJ</a></p>&mdash; Manfred Reyes Villa (@ManfredBolivia) <a href="https://twitter.com/ManfredBolivia/status/1768349967494558123?ref_src=twsrc%5Etfw">March 14, 2024</a></blockquote> <script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script><br>
</div><br>
<div class="container">
 <blockquote class="instagram-media" data-instgrm-captioned data-instgrm-permalink="https://www.instagram.com/reel/C4l4oqmr7Fp/?utm_source=ig_embed&amp;utm_campaign=loading" data-instgrm-version="14" style=" background:#FFF; border:0; border-radius:3px; box-shadow:0 0 1px 0 rgba(0,0,0,0.5),0 1px 10px 0 rgba(0,0,0,0.15); margin: 1px; max-width:540px; min-width:326px; padding:0; width:99.375%; width:-webkit-calc(100% - 2px); width:calc(100% - 2px);"><div style="padding:16px;"> <a href="https://www.instagram.com/reel/C4l4oqmr7Fp/?utm_source=ig_embed&amp;utm_campaign=loading" style=" background:#FFFFFF; line-height:0; padding:0 0; text-align:center; text-decoration:none; width:100%;" target="_blank"> <div style=" display: flex; flex-direction: row; align-items: center;"> <div style="background-color: #F4F4F4; border-radius: 50%; flex-grow: 0; height: 40px; margin-right: 14px; width: 40px;"></div> <div style="display: flex; flex-direction: column; flex-grow: 1; justify-content: center;"> <div style=" background-color: #F4F4F4; border-radius: 4px; flex-grow: 0; height: 14px; margin-bottom: 6px; width: 100px;"></div> <div style=" background-color: #F4F4F4; border-radius: 4px; flex-grow: 0; height: 14px; width: 60px;"></div></div></div><div style="padding: 19% 0;"></div> <div style="display:block; height:50px; margin:0 auto 12px; width:50px;"><svg width="50px" height="50px" viewBox="0 0 60 60" version="1.1" xmlns="https://www.w3.org/2000/svg" xmlns:xlink="https://www.w3.org/1999/xlink"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><g transform="translate(-511.000000, -20.000000)" fill="#000000"><g><path d="M556.869,30.41 C554.814,30.41 553.148,32.076 553.148,34.131 C553.148,36.186 554.814,37.852 556.869,37.852 C558.924,37.852 560.59,36.186 560.59,34.131 C560.59,32.076 558.924,30.41 556.869,30.41 M541,60.657 C535.114,60.657 530.342,55.887 530.342,50 C530.342,44.114 535.114,39.342 541,39.342 C546.887,39.342 551.658,44.114 551.658,50 C551.658,55.887 546.887,60.657 541,60.657 M541,33.886 C532.1,33.886 524.886,41.1 524.886,50 C524.886,58.899 532.1,66.113 541,66.113 C549.9,66.113 557.115,58.899 557.115,50 C557.115,41.1 549.9,33.886 541,33.886 M565.378,62.101 C565.244,65.022 564.756,66.606 564.346,67.663 C563.803,69.06 563.154,70.057 562.106,71.106 C561.058,72.155 560.06,72.803 558.662,73.347 C557.607,73.757 556.021,74.244 553.102,74.378 C549.944,74.521 548.997,74.552 541,74.552 C533.003,74.552 532.056,74.521 528.898,74.378 C525.979,74.244 524.393,73.757 523.338,73.347 C521.94,72.803 520.942,72.155 519.894,71.106 C518.846,70.057 518.197,69.06 517.654,67.663 C517.244,66.606 516.755,65.022 516.623,62.101 C516.479,58.943 516.448,57.996 516.448,50 C516.448,42.003 516.479,41.056 516.623,37.899 C516.755,34.978 517.244,33.391 517.654,32.338 C518.197,30.938 518.846,29.942 519.894,28.894 C520.942,27.846 521.94,27.196 523.338,26.654 C524.393,26.244 525.979,25.756 528.898,25.623 C532.057,25.479 533.004,25.448 541,25.448 C548.997,25.448 549.943,25.479 553.102,25.623 C556.021,25.756 557.607,26.244 558.662,26.654 C560.06,27.196 561.058,27.846 562.106,28.894 C563.154,29.942 563.803,30.938 564.346,32.338 C564.756,33.391 565.244,34.978 565.378,37.899 C565.522,41.056 565.552,42.003 565.552,50 C565.552,57.996 565.522,58.943 565.378,62.101 M570.82,37.631 C570.674,34.438 570.167,32.258 569.425,30.349 C568.659,28.377 567.633,26.702 565.965,25.035 C564.297,23.368 562.623,22.342 560.652,21.575 C558.743,20.834 556.562,20.326 553.369,20.18 C550.169,20.033 549.148,20 541,20 C532.853,20 531.831,20.033 528.631,20.18 C525.438,20.326 523.257,20.834 521.349,21.575 C519.376,22.342 517.703,23.368 516.035,25.035 C514.368,26.702 513.342,28.377 512.574,30.349 C511.834,32.258 511.326,34.438 511.181,37.631 C511.035,40.831 511,41.851 511,50 C511,58.147 511.035,59.17 511.181,62.369 C511.326,65.562 511.834,67.743 512.574,69.651 C513.342,71.625 514.368,73.296 516.035,74.965 C517.703,76.634 519.376,77.658 521.349,78.425 C523.257,79.167 525.438,79.673 528.631,79.82 C531.831,79.965 532.853,80.001 541,80.001 C549.148,80.001 550.169,79.965 553.369,79.82 C556.562,79.673 558.743,79.167 560.652,78.425 C562.623,77.658 564.297,76.634 565.965,74.965 C567.633,73.296 568.659,71.625 569.425,69.651 C570.167,67.743 570.674,65.562 570.82,62.369 C570.966,59.17 571,58.147 571,50 C571,41.851 570.966,40.831 570.82,37.631"></path></g></g></g></svg></div><div style="padding-top: 8px;"> <div style=" color:#3897f0; font-family:Arial,sans-serif; font-size:14px; font-style:normal; font-weight:550; line-height:18px;">Ver esta publicación en Instagram</div></div><div style="padding: 12.5% 0;"></div> <div style="display: flex; flex-direction: row; margin-bottom: 14px; align-items: center;"><div> <div style="background-color: #F4F4F4; border-radius: 50%; height: 12.5px; width: 12.5px; transform: translateX(0px) translateY(7px);"></div> <div style="background-color: #F4F4F4; height: 12.5px; transform: rotate(-45deg) translateX(3px) translateY(1px); width: 12.5px; flex-grow: 0; margin-right: 14px; margin-left: 2px;"></div> <div style="background-color: #F4F4F4; border-radius: 50%; height: 12.5px; width: 12.5px; transform: translateX(9px) translateY(-18px);"></div></div><div style="margin-left: 8px;"> <div style=" background-color: #F4F4F4; border-radius: 50%; flex-grow: 0; height: 20px; width: 20px;"></div> <div style=" width: 0; height: 0; border-top: 2px solid transparent; border-left: 6px solid #f4f4f4; border-bottom: 2px solid transparent; transform: translateX(16px) translateY(-4px) rotate(30deg)"></div></div><div style="margin-left: auto;"> <div style=" width: 0px; border-top: 8px solid #F4F4F4; border-right: 8px solid transparent; transform: translateY(16px);"></div> <div style=" background-color: #F4F4F4; flex-grow: 0; height: 12px; width: 16px; transform: translateY(-4px);"></div> <div style=" width: 0; height: 0; border-top: 8px solid #F4F4F4; border-left: 8px solid transparent; transform: translateY(-4px) translateX(8px);"></div></div></div> <div style="display: flex; flex-direction: column; flex-grow: 1; justify-content: center; margin-bottom: 24px;"> <div style=" background-color: #F4F4F4; border-radius: 4px; flex-grow: 0; height: 14px; margin-bottom: 6px; width: 224px;"></div> <div style=" background-color: #F4F4F4; border-radius: 4px; flex-grow: 0; height: 14px; width: 144px;"></div></div></a><p style=" color:#c9c8cd; font-family:Arial,sans-serif; font-size:14px; line-height:17px; margin-bottom:0; margin-top:8px; overflow:hidden; padding:8px 0 7px; text-align:center; text-overflow:ellipsis; white-space:nowrap;"><a href="https://www.instagram.com/reel/C4l4oqmr7Fp/?utm_source=ig_embed&amp;utm_campaign=loading" style=" color:#c9c8cd; font-family:Arial,sans-serif; font-size:14px; font-style:normal; font-weight:normal; line-height:17px; text-decoration:none;" target="_blank">Una publicación compartida de Manfred Reyes Villa (@manfred_oficial)</a></p></div></blockquote> <script async src="//www.instagram.com/embed.js"></script><br>
</div><br>
<div class="container">
    <blockquote class="instagram-media" data-instgrm-captioned data-instgrm-permalink="https://www.instagram.com/p/C4gvqMOrLlW/?utm_source=ig_embed&amp;utm_campaign=loading" data-instgrm-version="14" style=" background:#FFF; border:0; border-radius:3px; box-shadow:0 0 1px 0 rgba(0,0,0,0.5),0 1px 10px 0 rgba(0,0,0,0.15); margin: 1px; max-width:540px; min-width:326px; padding:0; width:99.375%; width:-webkit-calc(100% - 2px); width:calc(100% - 2px);"><div style="padding:16px;"> <a href="https://www.instagram.com/p/C4gvqMOrLlW/?utm_source=ig_embed&amp;utm_campaign=loading" style=" background:#FFFFFF; line-height:0; padding:0 0; text-align:center; text-decoration:none; width:100%;" target="_blank"> <div style=" display: flex; flex-direction: row; align-items: center;"> <div style="background-color: #F4F4F4; border-radius: 50%; flex-grow: 0; height: 40px; margin-right: 14px; width: 40px;"></div> <div style="display: flex; flex-direction: column; flex-grow: 1; justify-content: center;"> <div style=" background-color: #F4F4F4; border-radius: 4px; flex-grow: 0; height: 14px; margin-bottom: 6px; width: 100px;"></div> <div style=" background-color: #F4F4F4; border-radius: 4px; flex-grow: 0; height: 14px; width: 60px;"></div></div></div><div style="padding: 19% 0;"></div> <div style="display:block; height:50px; margin:0 auto 12px; width:50px;"><svg width="50px" height="50px" viewBox="0 0 60 60" version="1.1" xmlns="https://www.w3.org/2000/svg" xmlns:xlink="https://www.w3.org/1999/xlink"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><g transform="translate(-511.000000, -20.000000)" fill="#000000"><g><path d="M556.869,30.41 C554.814,30.41 553.148,32.076 553.148,34.131 C553.148,36.186 554.814,37.852 556.869,37.852 C558.924,37.852 560.59,36.186 560.59,34.131 C560.59,32.076 558.924,30.41 556.869,30.41 M541,60.657 C535.114,60.657 530.342,55.887 530.342,50 C530.342,44.114 535.114,39.342 541,39.342 C546.887,39.342 551.658,44.114 551.658,50 C551.658,55.887 546.887,60.657 541,60.657 M541,33.886 C532.1,33.886 524.886,41.1 524.886,50 C524.886,58.899 532.1,66.113 541,66.113 C549.9,66.113 557.115,58.899 557.115,50 C557.115,41.1 549.9,33.886 541,33.886 M565.378,62.101 C565.244,65.022 564.756,66.606 564.346,67.663 C563.803,69.06 563.154,70.057 562.106,71.106 C561.058,72.155 560.06,72.803 558.662,73.347 C557.607,73.757 556.021,74.244 553.102,74.378 C549.944,74.521 548.997,74.552 541,74.552 C533.003,74.552 532.056,74.521 528.898,74.378 C525.979,74.244 524.393,73.757 523.338,73.347 C521.94,72.803 520.942,72.155 519.894,71.106 C518.846,70.057 518.197,69.06 517.654,67.663 C517.244,66.606 516.755,65.022 516.623,62.101 C516.479,58.943 516.448,57.996 516.448,50 C516.448,42.003 516.479,41.056 516.623,37.899 C516.755,34.978 517.244,33.391 517.654,32.338 C518.197,30.938 518.846,29.942 519.894,28.894 C520.942,27.846 521.94,27.196 523.338,26.654 C524.393,26.244 525.979,25.756 528.898,25.623 C532.057,25.479 533.004,25.448 541,25.448 C548.997,25.448 549.943,25.479 553.102,25.623 C556.021,25.756 557.607,26.244 558.662,26.654 C560.06,27.196 561.058,27.846 562.106,28.894 C563.154,29.942 563.803,30.938 564.346,32.338 C564.756,33.391 565.244,34.978 565.378,37.899 C565.522,41.056 565.552,42.003 565.552,50 C565.552,57.996 565.522,58.943 565.378,62.101 M570.82,37.631 C570.674,34.438 570.167,32.258 569.425,30.349 C568.659,28.377 567.633,26.702 565.965,25.035 C564.297,23.368 562.623,22.342 560.652,21.575 C558.743,20.834 556.562,20.326 553.369,20.18 C550.169,20.033 549.148,20 541,20 C532.853,20 531.831,20.033 528.631,20.18 C525.438,20.326 523.257,20.834 521.349,21.575 C519.376,22.342 517.703,23.368 516.035,25.035 C514.368,26.702 513.342,28.377 512.574,30.349 C511.834,32.258 511.326,34.438 511.181,37.631 C511.035,40.831 511,41.851 511,50 C511,58.147 511.035,59.17 511.181,62.369 C511.326,65.562 511.834,67.743 512.574,69.651 C513.342,71.625 514.368,73.296 516.035,74.965 C517.703,76.634 519.376,77.658 521.349,78.425 C523.257,79.167 525.438,79.673 528.631,79.82 C531.831,79.965 532.853,80.001 541,80.001 C549.148,80.001 550.169,79.965 553.369,79.82 C556.562,79.673 558.743,79.167 560.652,78.425 C562.623,77.658 564.297,76.634 565.965,74.965 C567.633,73.296 568.659,71.625 569.425,69.651 C570.167,67.743 570.674,65.562 570.82,62.369 C570.966,59.17 571,58.147 571,50 C571,41.851 570.966,40.831 570.82,37.631"></path></g></g></g></svg></div><div style="padding-top: 8px;"> <div style=" color:#3897f0; font-family:Arial,sans-serif; font-size:14px; font-style:normal; font-weight:550; line-height:18px;">Ver esta publicación en Instagram</div></div><div style="padding: 12.5% 0;"></div> <div style="display: flex; flex-direction: row; margin-bottom: 14px; align-items: center;"><div> <div style="background-color: #F4F4F4; border-radius: 50%; height: 12.5px; width: 12.5px; transform: translateX(0px) translateY(7px);"></div> <div style="background-color: #F4F4F4; height: 12.5px; transform: rotate(-45deg) translateX(3px) translateY(1px); width: 12.5px; flex-grow: 0; margin-right: 14px; margin-left: 2px;"></div> <div style="background-color: #F4F4F4; border-radius: 50%; height: 12.5px; width: 12.5px; transform: translateX(9px) translateY(-18px);"></div></div><div style="margin-left: 8px;"> <div style=" background-color: #F4F4F4; border-radius: 50%; flex-grow: 0; height: 20px; width: 20px;"></div> <div style=" width: 0; height: 0; border-top: 2px solid transparent; border-left: 6px solid #f4f4f4; border-bottom: 2px solid transparent; transform: translateX(16px) translateY(-4px) rotate(30deg)"></div></div><div style="margin-left: auto;"> <div style=" width: 0px; border-top: 8px solid #F4F4F4; border-right: 8px solid transparent; transform: translateY(16px);"></div> <div style=" background-color: #F4F4F4; flex-grow: 0; height: 12px; width: 16px; transform: translateY(-4px);"></div> <div style=" width: 0; height: 0; border-top: 8px solid #F4F4F4; border-left: 8px solid transparent; transform: translateY(-4px) translateX(8px);"></div></div></div> <div style="display: flex; flex-direction: column; flex-grow: 1; justify-content: center; margin-bottom: 24px;"> <div style=" background-color: #F4F4F4; border-radius: 4px; flex-grow: 0; height: 14px; margin-bottom: 6px; width: 224px;"></div> <div style=" background-color: #F4F4F4; border-radius: 4px; flex-grow: 0; height: 14px; width: 144px;"></div></div></a><p style=" color:#c9c8cd; font-family:Arial,sans-serif; font-size:14px; line-height:17px; margin-bottom:0; margin-top:8px; overflow:hidden; padding:8px 0 7px; text-align:center; text-overflow:ellipsis; white-space:nowrap;"><a href="https://www.instagram.com/p/C4gvqMOrLlW/?utm_source=ig_embed&amp;utm_campaign=loading" style=" color:#c9c8cd; font-family:Arial,sans-serif; font-size:14px; font-style:normal; font-weight:normal; line-height:17px; text-decoration:none;" target="_blank">Una publicación compartida de Manfred Reyes Villa (@manfred_oficial)</a></p></div></blockquote> <script async src="//www.instagram.com/embed.js"></script><br>
</div><br>
<div class="text-center">
    <blockquote class="tiktok-embed" cite="https://www.tiktok.com/@manfredbolivia/video/7344428419599305990" data-video-id="7344428419599305990" style="max-width: 605px;min-width: 325px;" > <section> <a target="_blank" title="@manfredbolivia" href="https://www.tiktok.com/@manfredbolivia?refer=embed">@manfredbolivia</a> En Cochabamba, ¿Se come para vivir o se vive para comer? 😎🫶🏼<a title="comida" target="_blank" href="https://www.tiktok.com/tag/comida?refer=embed">#comida</a> <a title="love" target="_blank" href="https://www.tiktok.com/tag/love?refer=embed">#love</a> <a title="cochabamba" target="_blank" href="https://www.tiktok.com/tag/cochabamba?refer=embed">#Cochabamba</a> <a title="charque" target="_blank" href="https://www.tiktok.com/tag/charque?refer=embed">#charque</a> <a target="_blank" title="♬ sonido original - Manfred Reyes Villa Oficial" href="https://www.tiktok.com/music/sonido-original-7344428435288328966?refer=embed">♬ sonido original - Manfred Reyes Villa Oficial</a> </section> </blockquote> <script async src="https://www.tiktok.com/embed.js"></script>
</div>-->


<style>
    .btn-purple-outline {
        color: #6c1b74;
        background-color: transparent;
        border: 2px solid #6c1b74; /* Color lila */
        border-radius: 25px;
        padding: 0.75rem 1.2rem;
        font-weight: 100;
        text-transform: uppercase;
    }
    .btn-purple-outline:hover {
        background-color: #6c1b74; /* Color lila al pasar el ratón (hover) */
        color: #fff; /* Cambia el color del texto al pasar el ratón (hover) */
    }
    .imagen_responsive_modal {
        width: 700px;
    }
   
    .instagram-embed {
        width:400px ;
        height:600px;
    }
    

    
    /* Responsive styles */
    @media (max-width: 768px) {
        .imagen_responsive_modal {
            width:320px;
        }
        iframe {
            justify-content: center;
            align-items: center;
            text-align: center;
            width: 290px;
            height:400px;
        }
        .instagram-embed {
            justify-content: center;
            align-items: center;
            text-align: center;
            width: 290px;
            height:400px;
        }
        .tiktok-embed{
            min-width: 100px;             
            height:800px;
            width:280px;
        }
        
        .instagram-media {
            min-width: 100px;             
            height:650px;
            width:280px;
            position: relative;
            overflow: hidden;
            justify-content: center;  
            display: flex;
        }
    }
</style>
<style>
    .highlighted-interviews {
        position: relative;
        padding: 30px;
        background: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url('img/background.png') no-repeat center center;
        background-size: cover;
    }
    /*.highlighted-interviews::before {
        content: "";
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: linear-gradient(rgba(128, 0, 128, 0.5), rgba(128, 0, 128, 0.5));
    }*/
    

    .highlighted-interviews h2 {
        font-weight: 600;
        font-size: 36px;
        margin-bottom: 30px;
        color: #ffffff;

    }
    .interview-card {
        text-align: center;
        background-color: #ffffff; 
        /*background-color: rgba(255, 255, 255, 0.1);*/
        margin-bottom: 30px;
        padding: 20px;
        /*border-radius: 10px;*/
        border-radius: 70px; /* Hacer que las esquinas sean redondeadas */
        display: flex;
        align-items: center;
        color: #efefef;
    }
    .interview-card img {
        border-radius: 50%;
        margin-right: 15px;
    }
    .interview-card p {
        font-size: 14px;
        margin: 0;
        flex-grow: 1;
        color:black
    }
    .pagination {
        display: flex;
        justify-content: center;
        list-style: none;
        padding: 0;
    }
    .pagination li {
        margin: 0 5px;
    }
    .pagination li a {
        color: white;
        text-decoration: none;
    }
    @media (max-width: 768px) {
        .interview-card  {
            display: inline-block;
        }
        .btn-responsive{
            width:200px;
        }
    }
</style>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twbs-pagination/1.4.2/jquery.twbsPagination.min.js"></script>
<style>
    .pagination > li > a,
    .pagination > li > span {
        color: black;
    }
    .pagination > .active > a,
    .pagination > .active > span,
    .pagination > .active > a:hover,
    .pagination > .active > span:hover,
    .pagination > .active > a:focus,
    .pagination > .active > span:focus {
        background-color: #333; 
        border-color: #333;
        color:black
    }
</style>
<!--paginacion con twbs-pagination-->
<script>
    $(document).ready(function(){
        var itemsPerPage = 6;

        // Ocultar todas las tarjetas de entrevistas
        $('.interview-card').hide();

        // Mostrar las primeras 'itemsPerPage' tarjetas de entrevistas
        $('.interview-card:lt(' + itemsPerPage + ')').show();

        // Inicializar el plugin de paginación
        $('.pagination').twbsPagination({
            totalPages: Math.ceil($('.interview-card').length / itemsPerPage),
            visiblePages: 3,
            onPageClick: function (event, page) {
                var start = (page - 1) * itemsPerPage;
                var end = start + itemsPerPage;

                // Ocultar todas las tarjetas de entrevistas
                $('.interview-card').hide();

                // Mostrar las tarjetas de entrevistas correspondientes a la página actual
                $('.interview-card').slice(start,end).show();
            },
            first: false, // Deshabilitar la opción "first"
            last: false,   // Deshabilitar la opción "last"
            prev: 'Anterior', // Texto para la opción "Previous"
            next: 'Siguiente' // Texto para la opción "Next"
        });
    });
</script>
<!-- Script JavaScript para manejar el recorte -->
<script>
    document.addEventListener("DOMContentLoaded", function () {
        var verMenos = document.querySelectorAll('.texto-recortado');
        var maxCaracteres = 150; // Número máximo de caracteres antes de recortar
        // Iterar sobre cada botón y agregar el evento load
        verMenos.forEach(function (btn) {
            var targetId = btn.getAttribute('data-target');
            var descripcionEntrevista = document.getElementById(targetId);
            // Mostrar solo parte del texto y el botón "Ver más"
            if (descripcionEntrevista.innerHTML.length > maxCaracteres) {
                var textoRecortado = descripcionEntrevista.innerHTML.slice(0, maxCaracteres);
                descripcionEntrevista.innerHTML = textoRecortado + '...';
            }
        });
    });
</script>
<!--end enrevistas destacadas-->
<!--Script para recuperar datos en los modales-->
<script>
    $(document).ready(function(){
        $(document).on('click','.recuperar_id',function(){
            var id = $(this).val();
            $.ajax({
                type:"POST",
                headers: {'Content-Type':'application/json','X-CSRF-TOKEN':'{{ csrf_token() }}'},
                url: "{{route('recuperar-entrevista')}}",
                async:false,
                data:JSON.stringify({'id_entrevista':id}),
                success:function (data){
                    if(data.status==true){
                        document.getElementById("ModalEntrevistaTitle").innerText = data.data.titulo_entrevista;
                        document.getElementById("descripcion_entrevista_modal").innerText = data.data.descripcion_entrevista;
                        document.getElementById("imagen_entrevista_url").src = data.data.url;
                        if(data.data.link_entrevista){
                            //document.getElementById("link_entrevista_modal").href = data.data.link_entrevista;
                            document.getElementById("iframe_redes_sociales").innerHTML  = data.data.link_entrevista;
                            //document.getElementById("div_afuera_del_modal").innerHTML = data.data.link_entrevista;
                            // Después de insertar el contenido
                            var scriptinstagram = document.createElement('script');
                            scriptinstagram.async = true;
                            scriptinstagram.src = "//www.instagram.com/embed.js";
                            document.body.appendChild(scriptinstagram);
                            // Eliminar el script de Instagram después de cargarse
                            eliminarScript(scriptinstagram);
                            var scripttiktok = document.createElement('script');
                            scripttiktok.src = "https://www.tiktok.com/embed.js";
                            document.body.appendChild(scripttiktok);
                            // Eliminar el script de TikTok después de cargarse
                            eliminarScript(scripttiktok);
                            var scripttwitter = document.createElement('script');
                            scripttwitter.src = "https://platform.twitter.com/widgets.js";
                            document.body.appendChild(scripttwitter);
                            // Eliminar el script de Twitter después de cargarse
                            eliminarScript(scripttwitter);
                            
                        }else{
                            document.getElementById("link_entrevista_modal").style.display = 'none';
                        }
                    }
                }
            });
        });
    });
    // Función para eliminar un script después de que se haya cargado
    function eliminarScript(script) {
        script.onload = function() {
            // El script se ha cargado, ahora podemos eliminarlo del DOM
            script.parentNode.removeChild(script);
        };
    }
</script> 
<!--https://graph.instagram.com/logging_client_events-->
@include('footer')


