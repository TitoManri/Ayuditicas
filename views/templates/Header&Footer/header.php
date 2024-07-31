<!-- Source: https://stackoverflow.com/questions/30038275/change-a-div-in-php-include-->

<!-- Header -->
<nav class="navbar navbar-expand-lg navbar-custom ">
    <div class="container-fluid">
        <!-- Navbar Izquierda -->
        <a class="navbar-brand" href="./index.php">
            <img src="./assets/img/logoAyuditicas_Verde.png" width="55px" alt="Logo_Ayuditicas">
        </a>
        <a class="navbar-brand ayuditicaHeader" href="./index.php">AYUDITICAS</a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Navbar Centro -->
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="nav mx-auto">
                <li class="nav-item">
                    <a class="nav-link 
                    <?php 
                      echo $activoPaginaP; 
                    ?>" aria-current="page" href="./redSocial.php"><i class="fa fa-solid fa-house fa-2xl"></i></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link 
                    <?php 
                      echo $activoCampanias; 
                    ?>" href="./camps.php"><i class="fa fa-solid fa-people-roof fa-2xl"></i></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link 
                    <?php 
                      echo $activoMensajeria; 
                    ?>" href="./mensajeria.php"><i class="fa fa-regular fa-comment fa-2xl"></i></a>
                </li>
            </ul>
        </div>

        <!-- Navbar Derecha -->
        <ul class="navbar-nav">
            <!-- Perfil --><p class="ayuditicaHeader desconocido" href="">AYUDITICAS</p>
            <li class="nav-item dropdown ">
                <a class="nav-link icons 
                <?php 
                      echo $activoPerfil; 
                    ?>" href="#" role="button" data-bs-toggle="dropdown" data-bs-display="static"
                    aria-expanded="false">
                    <i class="fa fa-solid fa-user fa-2xl"></i>
                </a>
                <ul class="dropdown-menu dropdown-menu-lg-end">
                    <li><a class="dropdown-item" href="./perfil.php"><i class="fa-solid fa-user"
                                style="color: #000000;"></i> Perfil</a></li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>
                    <li><a class="dropdown-item" href="./index.php"><i class="fa-solid fa-arrow-right-from-bracket"
                                style="color: #000000;"></i> Cerrar sesion</a></li>
                </ul>
            </li>
        </ul>
    </div>
    </div>
</nav>