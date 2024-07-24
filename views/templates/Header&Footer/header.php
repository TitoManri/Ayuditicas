<!-- Header -->
<nav class="navbar navbar-expand-lg">
  <div class="container-fluid">
    <!-- Navbar Izquierda -->
    <a class="navbar-brand" href="./index.php"><img src="./assets/img/logoAyuditicas_Verde.png" width="55px" alt="Logo_Ayuditicas"></a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="navbar-brand ayuditicaHeader" href="./index.php">AYUDITICAS</a>
        </li>
      </ul>
      <!-- Navbar Derecha-->
      <ul class="navbar-nav">
        <!-- Search Bar -->
        <li class="nav-item">
        <div class="searchbar">
          <input type="text" placeholder="Buscar..">
          <div class="icon">
          <i class="fas fa-search fa-xl"></i>
          </div>
        </div>
        </li>
        <!-- Denuncias -->
        <div class="nav-item dropdown">
            <a class="nav-link icons" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              <i class="fa-solid fa-triangle-exclamation fa-2xl"></i>
            </a>
            <ul class="dropdown-menu dropdown-menu-lg-end">
             <li><a class="dropdown-item" href=""><i class="fa-solid fa-bullhorn" style="color: #000000;"></i> Ver Mis Denuncias</a></li>
              <li><hr class="dropdown-divider"></li>
              <li><a class="dropdown-item" href="./confirmarDenuncia.php"><i class="fa-solid fa-people-group" style="color: #000000";></i> Solicitudes Denuncias</a></li>
            </ul>
          </div>
        <!-- Campanias -->
        <div class="nav-item dropdown">
            <a class="nav-link icons" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              <i class="fa-solid fa-people-roof fa-2xl"></i>          
            </a>
            <ul class="dropdown-menu dropdown-menu-lg-end">
             <li><a class="dropdown-item" href="./camps.php"><i class="fa-solid fa-campground" style="color: #000000;"></i> Ver Campañas</a></li>
              <li><hr class="dropdown-divider"></li>
              <li><a class="dropdown-item" href="./solicitudCamp.php"><i class="fa-solid fa-people-group" style="color: #000000";></i> Solicitudes Campañas</a></li>
            </ul>
          </div>
        <!-- Publicaciones -->
        <div class="nav-item dropdown">
            <a class="nav-link icons" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              <i class="fa-regular fa-pen-to-square fa-2xl"></i>          
            </a>
            <ul class="dropdown-menu dropdown-menu-lg-end">
              <li><a class="dropdown-item" href="./crearPublicacion.php"><i class="fa-solid fa-square-plus" style="color: #000000;"></i> Crear publicación</a></li>
              <li><a class="dropdown-item" href="../views/crearDenuncia.php"><i class="fa-solid fa-triangle-exclamation" style="color: #000000;"></i> Crear denuncia</a></li>
              <li><hr class="dropdown-divider"></li>
              <li><a class="dropdown-item" href="./CrearCamp.php"><i class="fa-solid fa-people-group"></i> Crear campaña</a></li>
            </ul>
          </div>
          <!-- Perfil -->
          <div class="nav-item dropdown">
            <a class="nav-link icons" href="#" role="button" data-bs-toggle="dropdown" data-bs-display="static" aria-expanded="false">
            <i class="fa-solid fa-user fa-2xl"></i>
            </a>
            <ul class="dropdown-menu dropdown-menu-lg-end">
              <li><a class="dropdown-item" href="./perfil.php"><i class="fa-solid fa-user" style="color: #000000;"></i> Perfil</a></li>
              <li><a class="dropdown-item" href="./mensajeria.php"><i class="fa-solid fa-message" style="color: #000000;"></i> Mensajeria</a></li>
              <li><a class="dropdown-item" href="./perfil.php"><i class="fa-solid fa-bell" style="color: #000000;"></i> Notificaciones</a></li>
              <li><hr class="dropdown-divider"></li>
              <li><a class="dropdown-item" href="./index.php"><i class="fa-solid fa-arrow-right-from-bracket" style="color: #000000;"></i> Cerrar sesion</a></li>
            </ul>
          </div>
        </ul>
      </form>
    </div>
  </div>
</nav>