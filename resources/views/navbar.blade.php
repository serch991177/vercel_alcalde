<nav class="navbar navbar-expand-lg navbar-custom">
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"><i class="fa fa-bars" aria-hidden="true"></i></span>
  </button>
  <a href="/"><img src="img/logo_manfred.png" alt="logo manfred" class="navbar-logo"></a>

  <div class="collapse navbar-collapse" id="navbarNav">
    <ul class="navbar-nav">
      <li class="nav-item active">
        <a class="nav-link" href="/">Inicio</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="/biografia">Biografia</a>
      </li>
      <li class="nav-item">
        <a  class="nav-link" href="#" data-toggle="modal" data-target="#videoModal" role="button" aria-haspopup="true" aria-expanded="false">Trayectoria</a>
      </li>
      <li class="navbar-log-web">
        <a href="/"><img src="img/logo_manfred.png" alt="logo manfred"></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="/prensa">Prensa</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="/galeria">Galeria</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="/contacto">Contacto</a>
      </li>
    </ul>
    <!-- Formulario de búsqueda -->
    <!--<form class="form-inline my-2 my-lg-0 search-form">
      <button class="btn btn-outline-light my-2 my-sm-0" type="submit">Buscar</button>
    </form>-->

  </div>
</nav>

<!--Seccion de estilos-->
<style>
    .nav-item{
      padding: 0.7rem 2rem; 
    }
    /* Personalización del color de fondo de la barra de navegación */
    .navbar-custom {
      background-color: #473878; /* Código de color lila */
    }
    /* Alineación de los elementos de la lista en el centro */
    .navbar-nav {
      margin: 0 auto;
      display: flex;
    }
    /* Color blanco para el texto del enlace y el ícono del burger */
    .navbar-nav .nav-link  {
      color: white;
    }
    .navbar-toggler-icon{
        color:white;
    }
    /* Estilo para el campo de búsqueda */
    .search-form {
      display: flex;
      align-items: center;
    }
    .search-input {
      margin-right: 10px; /* Ajusta el valor según sea necesario */
    }

    
    /* Estilo para el logo */
    .navbar-logo {
      display: none; /* Inicialmente oculto */
    }

    /* Estilo para el logo en modo responsivo */
    @media (max-width: 768px) {
      .navbar-nav {
        flex-direction: column; /* Cambia la dirección de la flexbox en el modo responsivo */
        align-items: center; /* Centra los elementos en el modo responsivo */
      }
      .navbar-logo {
        display: inline-block; /* Muestra el logo en el modo responsivo */
        margin-right: 10px; /* Ajusta el valor según sea necesario */
      }
      .navbar-log-web {
        display: none; /* Inicialmente oculto */
      }
      .navbar-toggler {
        order: 1; /* Cambia el orden del botón del menú burger */
      }
    }
</style>
<div class="modal fade" id="videoModal" tabindex="-1" role="dialog" aria-labelledby="videoModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header text-center">
          <h5 class="modal-title" id="videoModalLabel"></h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <iframe width="100%" height="315" src="https://www.youtube.com/embed/XUNi0AVTyAM" frameborder="0" allowfullscreen></iframe>
          <br><br>
          <p style="color:purple;">MANFRED REYES VILLA</p>
          <p>Líder y político boliviano, reconocido a nivel nacional e internacional como la mejor autoridad municipal de Bolivia.  </p>
          <p>-	5 veces Alcalde electo de la ciudad de Cochabamba.</p>
          <p>-	Primer Prefecto, elegido democráticamente, del Departamento de Cochabamba.</p>
          <p>-	2 veces candidato a la Presidencia de la República.</p>
        </div>
      </div>
    </div>
</div>