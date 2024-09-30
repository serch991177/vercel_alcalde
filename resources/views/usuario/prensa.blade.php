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
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<style>
    body {
        font-family: 'Poppins';font-size: 18px;text-align: justify;
    }
</style>
<!--seccion de noticias-->
<style>
    .highlighted-interviews {
        position: relative;
        padding: 30px;
        background: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url('img/prensa.png') no-repeat center center;
        background-size: cover;
    }
    .label-buscar{
        color:white;
    }
    .input-buscar{
        border-radius:30px;
        width: 200%; /* Cambié el ancho a 100% */
        max-width: 900px; /* Ajusta el ancho máximo según tus necesidades */
    }
    .icon-search{
        color:white;
    }
    .button-dropdown{
        border-radius:20px;
        background-color:red;
    }
    .social-icons {
        position: absolute;
        top: 120px; /* Adjust the top margin as needed */
        left: 20px;
        color: white;
        font-size: 24px;
        display: flex;
        flex-direction: column;
        align-items: center;
    }
    .social-icons i {
        margin-bottom: 10px; /* Adjust the spacing between icons as needed */
    }
    /* Responsive styles */
    @media (max-width: 768px) {
        .social-icons {
            display:none;
        }
        .linea-responsive{
            border-top: 4px solid #473878;
            height: 20px;
            max-width:1200px;
            padding:1px;
            margin: 10px auto 0 auto;
        }
    }
</style>
<!--estilos de scroll-->
<style>    
    .profile-content {
      flex: 1;
      background-color: #fff;
      padding: 20px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
      overflow-y: auto;
      max-height: 600px;
    }
</style>
<div class="highlighted-interviews profile-content">
    <div class="social-icons">
        <a href="https://www.facebook.com/ManfredReyesVillaOficial " target="_blank" class="text-white"><i class="fab fa-facebook" style="margin-bottom: 20px;"></i></a>
        <a href="https://www.instagram.com/manfred_oficial/" target="_blank" class="text-white" ><i class="fab fa-instagram" style="margin-bottom: 20px;"></i></a>
        <a href="https://www.tiktok.com/@manfredbolivia" target="_blank" class="text-white"><svg class="icon_tiktok" style="margin-bottom: 20px;" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="29pt"  viewBox="0 0 256 256" version="1.1"><g id="surface2796506"><path style=" stroke:none;fill-rule:evenodd;fill:rgb(100%,100%,100%);fill-opacity:1;" d="M 155.96875 97.703125 C 166.894531 105.507812 180.285156 110.097656 194.742188 110.097656 L 194.742188 88.210938 C 186.667969 86.488281 179.527344 82.273438 174.15625 76.414062 C 164.960938 70.683594 158.339844 61.226562 156.398438 50.152344 L 136.132812 50.152344 L 136.132812 161.210938 C 136.085938 174.15625 125.574219 184.636719 112.609375 184.636719 C 104.96875 184.636719 98.179688 181 93.882812 175.363281 C 86.207031 171.492188 80.945312 163.539062 80.945312 154.359375 C 80.945312 141.375 91.476562 130.847656 104.46875 130.847656 C 106.957031 130.847656 109.355469 131.238281 111.609375 131.953125 L 111.609375 109.835938 C 83.710938 110.410156 61.273438 133.191406 61.273438 161.21875 C 61.273438 175.210938 66.863281 187.890625 75.929688 197.152344 C 84.113281 202.644531 93.964844 205.847656 104.558594 205.847656 C 132.957031 205.847656 155.984375 182.835938 155.984375 154.449219 Z M 155.96875 97.703125 "/></g></svg></a>
        <a href="https://x.com/ManfredBolivia" target="_blank" class="text-white" style="margin-bottom: 20px"><img src="img/X_logo_2023_(white).png" width="25px" alt="icon_twitter"></a>
        <a href="https://www.linkedin.com/in/manfredreyesvillab/" target="_blank" class="text-white" style="margin-bottom:20px"><img src="img/linkedin_icon.png" alt="icon_linkedin" width="30px"></a>
        <a href="https://www.threads.net/@manfred_oficial" target="_blank" class="text-white" style="margin-bottom:20px"><img src="img/threads.png" alt="icon_threads" width="50px"></a>
        <a href="https://whatsapp.com/channel/0029VabqAxhCMY09UGFHdF2w"  target="_blank" class="text-white" style="margin-bottom:15px"><i class="fa fa-whatsapp"></i></a>
        <!--<a href="" target="_blank" class="text-white"></a>-->
    </div>
    <!--cabecera de las ultimas noticias-->
    <div class="container">
        <div class="row justify-content-center">
            <form class="form-inline">
                <label class="mr-2 label-buscar">Busca tu noticia</label>
                <!-- Input de texto -->
                <input type="text" class="form-control mr-2 input-buscar" placeholder="" name="palabra_clave" id="palabra_clave">
                <!-- Icono de búsqueda -->
                <button type="button" class="btn" onclick="buscarnoticia()"><i class="fas fa-search icon-search"></i></button>
                <!-- Dropdown -->
                <div class="dropdown">
                    <button class="btn btn-secondary dropdown-toggle button-dropdown" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">CATEGORÍA</button>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton" id="categoriaDropdown">
                        @foreach($categorias as $categoria)
                            <a class="dropdown-item" href="#" data-id="{{$categoria->id_categorias}}">{{strtoupper($categoria->nombre_categoria)}}</a>
                        @endforeach
                    </div>
                </div>
            </form>
        </div>
        <!--Inicio de cambios-->    
            <div id="categoriaSeleccionada" style="margin-top: 20px; color:white" class="text-center"></div>
            <script>
                /*document.addEventListener('DOMContentLoaded', function() {
                    const dropdownItems = document.querySelectorAll('.dropdown-item');
                    const categoriaSeleccionada = document.getElementById('categoriaSeleccionada');
                    dropdownItems.forEach(item => {
                        item.addEventListener('click', function(event) {
                            event.preventDefault();
                            const categoriaNombre = event.target.textContent;
                            categoriaSeleccionada.textContent = `Categoría seleccionada: ${categoriaNombre}`;
                        });
                    });
                });*/
                document.addEventListener('DOMContentLoaded', function() {
                    const dropdownItems = document.querySelectorAll('.dropdown-item');
                    const dropdownButton = document.getElementById('dropdownMenuButton');
                    const categoriaSeleccionada = document.getElementById('categoriaSeleccionada');

                    dropdownItems.forEach(item => {
                        item.addEventListener('click', function(event) {
                            event.preventDefault();
                            const categoriaNombre = event.target.textContent;
                            dropdownButton.textContent = categoriaNombre;
                            //categoriaSeleccionada.textContent = `Categoría seleccionada: ${categoriaNombre}`;
                        });
                    });
                });
            </script>
        <!--Fin de cambios-->
        <h2 class="text-center" style="color:white;">ULTIMAS NOTICIAS</h2>
    </div>
    <!--end cabecera de las ultimas noticias-->
    <!--seccion de noticias-->
    <div id="div_noticias_cargar">
        @php($count=1)
        @foreach($noticias as $noticia)
            <div class="container mt-3 div_not_responsive">
                <div class="news-container">
                    <div class="news-image">
                        <img alt="{{$noticia->titulo_noticia}}" height="250" src="{{$noticia->url}}" width="250"/>
                    </div>
                    <div class="news-text">
                        <div class="news-description"><p id="descripcionNoticia{{$count}}" data-target="descripcionNoticia{{$count}}" class="texto-recortado">{{$noticia->descripcion_noticia}}</p></div>
                        <button type="button" class="btn text-white" data-toggle="modal" data-target="#exampleModal"><i class="fa fa-share-alt" aria-hidden="true"></i></button> 
                        <a type="button" class="text-white read-more recuperar_id" data-id="{{$noticia->id_noticias}}" data-toggle="modal" data-target="#ModalNoticia">LEER MÁS<i class="fas fa-arrow-right"></i></a>
                    </div>
                </div>
            </div>
            <div class="container mt-3 div_responsive_noticias" >
                <div class="text-center">
                    <div class="">
                        <img alt="{{$noticia->titulo_noticia}}" height="250" src="{{$noticia->url}}" width="350"/>
                    </div>
                    <div class="news-text">
                        <div class="news-description"><p id="descripcionNoticiar{{$count}}" data-target="descripcionNoticiar{{$count}}" class="texto-recortado-responsive" >{{$noticia->descripcion_noticia}}</p></div>
                        <button type="button" class="btn text-white" data-toggle="modal" data-target="#exampleModal"><i class="fa fa-share-alt" aria-hidden="true"></i></button> 
                        <a type="button" class="text-white read-more recuperar_id" data-id="{{$noticia->id_noticias}}" data-toggle="modal" data-target="#ModalNoticia">LEER MÁS<i class="fas fa-arrow-right"></i></a>
                    </div>
                </div>
            </div>
            <div class="linea-responsive" ></div>
        @php($count++)    
        @endforeach
    </div>
    <!--Div busqueda por categorias-->
        <div id="carga_div_categorias" ></div>
    <!--fin div busqueda por categorias-->
    <!--div busqueda por input-->
        <div id="carga_div_input"></div>
    <!--fin div busqueda por input-->
    <!--end seccion de noticias-->
</div>
<!--Buscar por input-->
<script>
    function buscarnoticia(){
        var valor_input_text = document.getElementById("palabra_clave").value;
        if(valor_input_text.length == 0){
            swal.fire('Error','Por favor ingrese alguna palabra clave','error')
        }else{
            $.ajax({
                type:'POST',
                url:'{{route("busqueda-palabra")}}',
                headers:{'Content-Type':'application/json','X-CSRF-TOKEN':'{{csrf_token()}}'},
                data:JSON.stringify({'input_texto':valor_input_text}),
                success:function(data){
                    if(data.data.length == 0){
                        swal.fire('Error','No existen noticias con la palabra ingresada','error');
                    }else{
                        document.getElementById("div_noticias_cargar").style.display = 'none';
                        document.getElementById("carga_div_categorias").style.display = 'none';
                        document.getElementById("carga_div_input").style.display = '';
                        let div_busqueda_categoria = "";
                        var count = 1;
                        for (var i = 0; i < data.data.length; i++) {
                            div_busqueda_categoria +=`
                            <div class="container mt-3 div_not_responsive">
                                <div class="news-container">
                                    <div class="news-image">
                                        <img alt="${data.data[i].titulo_noticia}" height="250" src="${data.data[i].url}" width="250"/>
                                    </div>
                                    <div class="news-text">
                                        <div class="news-description"><p id="descripcionNoticia${count}" data-target="descripcionNoticia${count}" class="texto-recortado">${data.data[i].descripcion_noticia}</p></div>
                                        <button type="button" class="btn text-white" data-toggle="modal" data-target="#exampleModal"><i class="fa fa-share-alt" aria-hidden="true"></i></button> 
                                        <a type="button" class="text-white read-more recuperar_id" data-id="${data.data[i].id_noticias}" data-toggle="modal" data-target="#ModalNoticia">LEER MÁS<i class="fas fa-arrow-right"></i></a>
                                    </div>
                                </div>
                            </div>
                            <div class="container mt-3 div_responsive_noticias" >
                                <div class="text-center">
                                    <div class="">
                                        <img alt="${data.data[i].titulo_noticia}" height="250" src="${data.data[i].url}" width="250"/>
                                    </div>
                                    <div class="news-text">
                                        <div class="news-description"><p id="descripcionNoticiar${count}" data-target="descripcionNoticiar${count}" class="texto-recortado-responsive" >${data.data[i].descripcion_noticia}</p></div>
                                        <button type="button" class="btn text-white" data-toggle="modal" data-target="#exampleModal"><i class="fa fa-share-alt" aria-hidden="true"></i></button> 
                                        <a type="button" class="text-white read-more recuperar_id" data-id="${data.data[i].id_noticias}" data-toggle="modal" data-target="#ModalNoticia">LEER MÁS<i class="fas fa-arrow-right"></i></a>
                                    </div>
                                </div>
                            </div>
                            <div class="linea-responsive" ></div>`;     
                            count ++;
                        }
                        document.getElementById('carga_div_input').innerHTML = div_busqueda_categoria;
                    }
                },
                error:function (error){
                    console.log(error);
                }
            });
        }
    }
</script>
<!--fin buscar por input-->
<!--filtrador por categoria-->
<script>
    $(document).ready(function () {
        // Agrega un evento de cambio al dropdown
        $('#categoriaDropdown a').on('click', function () {
            var categoriaId = $(this).data('id');
            // Realiza una llamada AJAX al servidor
            $.ajax({
                type: 'POST',
                url: '{{route("filtrar-categoria")}}',
                headers: {'Content-Type':'application/json','X-CSRF-TOKEN':'{{ csrf_token() }}'},
                data:JSON.stringify({'id_categoria':categoriaId}),
                success: function (data) {
                    document.getElementById("div_noticias_cargar").style.display = 'none';
                    document.getElementById("carga_div_input").style.display = 'none';
                    document.getElementById("carga_div_categorias").style.display = '';
                    let div_busqueda_categoria = "";
                    var count = 1;
                    for (var i = 0; i < data.data.length; i++) {
                        div_busqueda_categoria +=`
                        <div class="container mt-3  div_not_responsive">
                            <div class="news-container">
                                <div class="news-image">
                                    <img alt="${data.data[i].titulo_noticia}" height="250" src="${data.data[i].url}" width="250"/>
                                </div>
                                <div class="news-text">
                                    <div class="news-description"><p id="descripcionNoticia${count}" data-target="descripcionNoticia${count}" class="texto-recortado">${data.data[i].descripcion_noticia}</p></div>
                                    <button type="button" class="btn text-white" data-toggle="modal" data-target="#exampleModal"><i class="fa fa-share-alt" aria-hidden="true"></i></button> 
                                    <a type="button" class="text-white read-more recuperar_id" data-id="${data.data[i].id_noticias}" data-toggle="modal" data-target="#ModalNoticia">LEER MÁS<i class="fas fa-arrow-right"></i></a>
                                </div>
                            </div>
                        </div>
                        <div class="container mt-3 div_responsive_noticias" >
                            <div class="text-center">
                                <div class="">
                                    <img alt="${data.data[i].titulo_noticia}" height="250" src="${data.data[i].url}" width="250"/>
                                </div>
                                <div class="news-text">
                                    <div class="news-description"><p id="descripcionNoticiar${count}" data-target="descripcionNoticiar${count}" class="texto-recortado-responsive" >${data.data[i].descripcion_noticia}</p></div>
                                    <button type="button" class="btn text-white" data-toggle="modal" data-target="#exampleModal"><i class="fa fa-share-alt" aria-hidden="true"></i></button> 
                                    <a type="button" class="text-white read-more recuperar_id" data-id="${data.data[i].id_noticias}" data-toggle="modal" data-target="#ModalNoticia">LEER MÁS<i class="fas fa-arrow-right"></i></a>
                                </div>
                            </div>
                        </div>
                        <div class="linea-responsive" ></div>`;     
                        count ++;
                    }
                    document.getElementById('carga_div_categorias').innerHTML = div_busqueda_categoria;
                },
                error: function (error) {
                    console.error(error);
                }
            });
        });
    });
</script>
<!--fin filtrador por categoria-->
<script>
    function compartirFacebook() {
        var url = '{{URL::current()}}';
        window.open('https://www.facebook.com/sharer/sharer.php?u=' + encodeURIComponent(url), 'Compartir en Facebook', 'width=600,height=400');
    }
    function compartirTwitter() {
        var url = '{{URL::current()}}'; // URL de la página actual
        window.open('https://twitter.com/intent/tweet?url=' + encodeURIComponent(url), 'Compartir en Twitter', 'width=600,height=400');
    }
    function compartirWhatsApp() {
        var url = '{{URL::current()}}'; // URL de la página actual
        var mensaje = 'Echa un vistazo a esta noticia: ' + url;
        window.open('https://wa.me/?text=' + encodeURIComponent(mensaje), 'Compartir en WhatsApp', 'width=600,height=400');
    }
</script>
<!--Cambios-->
<!--seccion de noticias-->

<!--fin cambios-->
<style>
    .news-container {
      display: flex;
      align-items: center;
    }
    .news-image {
      flex-shrink: 0;
      width: 100px;
      height: 100px;
      border-radius: 50%;
      overflow: hidden;
      margin-right: 20px;
    }
    .news-image img {
      width: 150%;
      height: auto;
    }
    .news-title {
      font-size: 24px;
      font-weight: 700;
      margin-bottom: 10px;
      color:white;
    }
    .news-description {
      font-size: 14px;
      line-height: 1.5;
      color:white;
    }
    .read-more {
      text-decoration: none;
      color: white;
      font-size: 14px;
      display: inline-flex;
      align-items: center;
      margin-top: 10px;
    }
    .read-more i {
      margin: 0 5px;
    }
    .share-icon {
      margin-right: 10px;
    }
    .div_responsive_noticias {
        display:none;
    }
    /* Responsive styles */
    @media (max-width: 768px) {
        .div_not_responsive {
            display:none;
        }
        .div_responsive_noticias {
            display : inline;
        }
    }
</style>
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
<!-- Modal de ver noticia completa-->
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
<!--Fin modal de ver noticia completa-->
<!-- Modal Compartir-->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title col-11 text-center" id="exampleModalLabel">Comparitr en redes Sociales</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row div-iconos-web">
            <div class="col-md-4">
                <a type="button" onclick="compartirFacebook()"  ><img src='https://upload.wikimedia.org/wikipedia/commons/thumb/b/b9/2023_Facebook_icon.svg/2048px-2023_Facebook_icon.svg.png' width='80px' alt='Facebook Icon'></a>
            </div>
            <div class="col-md-4">
                <a type="button" onclick="compartirTwitter()" ><img src="data:image/png;base64,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" width="100px"></a>
            </div>
            <div class="col-md-4">
                <a type="button" onclick="compartirWhatsApp()" ><img src='https://upload.wikimedia.org/wikipedia/commons/thumb/6/6b/WhatsApp.svg/767px-WhatsApp.svg.png' width='80px' alt='Whatsap Icon'></a>
            </div>
        </div>
            &nbsp;&nbsp;&nbsp;&nbsp;<a  type="button" onclick="compartirFacebook()" class="iconos-movile"><img src='https://upload.wikimedia.org/wikipedia/commons/thumb/b/b9/2023_Facebook_icon.svg/2048px-2023_Facebook_icon.svg.png' width='80px' alt='Facebook Icon'></a>
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a  type="button" onclick="compartirTwitter()" class="iconos-movile"><img src="data:image/png;base64,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" width="100px"></a>
            &nbsp;<a  type="button" onclick="compartirWhatsApp()" class="iconos-movile"><img src='https://upload.wikimedia.org/wikipedia/commons/thumb/6/6b/WhatsApp.svg/767px-WhatsApp.svg.png' width='80px' alt='Whatsap Icon'></a>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<!--Fin modal compartir-->
<!--estilos de los iconos dentro del modal-->
<style>
    .iconos-movile{
        display: none;
    }
    @media (max-width: 768px) {
        .div-iconos-web{
            display: none;
        }
        .iconos-movile{
            display:inline ;
        }
    }
</style>
<!--fin estilos de los iconos dentro del modal-->
<!-- Script JavaScript para manejar el recorte -->
<script>
    document.addEventListener("DOMContentLoaded", function () {
        var verMenos = document.querySelectorAll('.texto-recortado');
        var maxCaracteres = 400; // Número máximo de caracteres antes de recortar
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
    document.addEventListener("DOMContentLoaded", function () {
        var verMenos = document.querySelectorAll('.texto-recortado-responsive');
        var maxCaracteres = 200; // Número máximo de caracteres antes de recortar
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
<!--end seccion de noticias-->
<!--Videos destacados-->
<br>
<!--cambios en el apartado de video-->
<!--<div class="container">
    <h2 class="text-center" style="color:red">ENTREVISTAS DESTACADAS</h2>
    @foreach($videos as $video)
        <div class="content-section">
            <div class="image-container">
                {!! $video->url !!}
                {{--<iframe width="100%" height="315" src="https://www.youtube.com/embed/{{$video->url}}" frameborder="0" allowfullscreen></iframe>--}}
            </div>
            <div class="text-section">
                <h2 style="color:purple">{{$video->titulo_video}}</h2>
                <p>{{$video->descripcion_video}}</p>
            </div>
            <div class="container text-center div-responsive">
                <h2 style="color:purple">{{$video->titulo_video}}</h2>
                <iframe width="100%" height="315" src="https://www.youtube.com/embed/{{$video->url}}" frameborder="0" allowfullscreen></iframe>
                <p>{{$video->descripcion_video}}</p>
            </div>
        </div>
    @endforeach
</div>-->
<div class="container">
    <h2 class="text-center" style="color:red">ENTREVISTAS DESTACADAS</h2>
    @foreach($videos as $video)
        <div class="content-section">
            <div class="container text-center">
                <h2 style="color:purple">{{$video->titulo_video}}</h2>
                <div class="responsive-iframe-container">
                    {!! $video->url !!}
                </div>
                <p>{{$video->descripcion_video}}</p>
            </div>
        </div>
    @endforeach
</div>



{{--style="display: flex; justify-content: center;"--}}


<style>
    .responsive-iframe-container {
        position: relative;
        overflow: hidden;
        
        justify-content: center;  
        display: flex;
    }

    
</style>









<div class="container">
    <div class="row justify-content-center">
        <ul class="pagination" id="pagination"></ul>
    </div>
</div>






<!--terminar responsive del video en dispositivos moviles-->
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
<style>
    .content-section {
        border-radius: 10px;
        padding: 20px;
        display: flex;
        align-items: center;
        margin-top: 20px;
    }
    .image-container {
        position: relative;
        width: 40%;
    }
    .play-icon {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        font-size: 32px;
        color: white;
    }
    .text-section {
        width: 60%;
        padding-left: 20px;
    }
    .text-section h2 {
        color: #333;
        margin-bottom: 10px;
    }
    .text-section p {
        color: #666;
        line-height: 1.5;
    }
    .social-icons-videos {
        position: absolute;
        top: 850px; /* Adjust the top margin as needed */
        left: 20px;
        color: white;
        font-size: 24px;
        display: flex;
        flex-direction: column;
        align-items: center;
    }
    
    .div-responsive{
        /*display:none;*/
    }
    /* Responsive styles */
    @media (max-width: 768px) {
        .social-icons-videos,.image-container, .text-section {
            display:none;
        }
        .div-responsive{
            width:100%;
        }
    }
</style>
<div class="social-icons-videos">
    <a href="https://www.facebook.com/ManfredReyesVillaOficial " target="_blank" class="text-white"><i class="fab fa-facebook purple-icon" style="margin-bottom: 30px;"></i></a>
    <a href="https://www.instagram.com/manfred_oficial/" target="_blank" class="text-white" ><i class="fab fa-instagram purple-icon" style="margin-bottom: 30px;"></i></a>
    <a href="https://www.tiktok.com/@manfredbolivia" target="_blank" class="text-white"><svg class="purple-icon" style="margin-bottom: 30px;" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="29pt"  viewBox="0 0 256 256" version="1.1"><g id="surface2796506"><path style="stroke:none;fill-rule:evenodd;fill:purple;fill-opacity:1;" d="M 155.96875 97.703125 C 166.894531 105.507812 180.285156 110.097656 194.742188 110.097656 L 194.742188 88.210938 C 186.667969 86.488281 179.527344 82.273438 174.15625 76.414062 C 164.960938 70.683594 158.339844 61.226562 156.398438 50.152344 L 136.132812 50.152344 L 136.132812 161.210938 C 136.085938 174.15625 125.574219 184.636719 112.609375 184.636719 C 104.96875 184.636719 98.179688 181 93.882812 175.363281 C 86.207031 171.492188 80.945312 163.539062 80.945312 154.359375 C 80.945312 141.375 91.476562 130.847656 104.46875 130.847656 C 106.957031 130.847656 109.355469 131.238281 111.609375 131.953125 L 111.609375 109.835938 C 83.710938 110.410156 61.273438 133.191406 61.273438 161.21875 C 61.273438 175.210938 66.863281 187.890625 75.929688 197.152344 C 84.113281 202.644531 93.964844 205.847656 104.558594 205.847656 C 132.957031 205.847656 155.984375 182.835938 155.984375 154.449219 Z M 155.96875 97.703125 "/></g></svg></a>
    <a href="https://x.com/ManfredBolivia" target="_blank" class="text-white" style="margin-bottom:30px;"><img class="purple-icon" src="img/X_logo_2023_(white).png" width="25px" alt="icon_twitter"></a>
    <a href="https://www.linkedin.com/in/manfredreyesvillab/" target="_blank" class="text-white" style="margin-bottom:30px"><img class="purple-icon" src="img/linkedin_icon.png" alt="icon_linkedin" width="30px"></a>
    <a href="https://www.threads.net/@manfred_oficial" target="_blank" class="text-white" style="margin-bottom:30px"><img   class="purple-icon" src="img/threads.png" alt="icon_threads" width="50px"></a>
    <a href="https://whatsapp.com/channel/0029VabqAxhCMY09UGFHdF2w"  target="_blank" class="text-white" style="margin-bottom:15px"><i class="fa fa-whatsapp purple-icon"></i></a>
</div>
<style>
    .purple-icon {
        filter: invert(60%) sepia(100%) saturate(5000%) hue-rotate(270deg) brightness(95%) contrast(105%);
    }
</style>
<!--end videos destacados-->
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
@include('footer')
