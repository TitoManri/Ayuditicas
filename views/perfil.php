<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil</title>
    <!-- Bootstrap & Icons-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="./assets/css/theme.css">
    <link rel="stylesheet" href="./assets/css/headerfooter.css">
    <link rel="stylesheet" href="../views/assets/css/perfil.css">
</head>
<body>
    <header class="mainHeader">
        <?php
            include './templates/Header&Footer/header.php';
        ?></header>

        <div class="container">
        <div class="row">
            <div class="col-xl-8">
                <div class="card card-top" >
                    <div class="card-body">
                        <div class="row align-items-center">

                            <!--Columna del perfil-->
                            <div class="col-md-4">
                              <div class="text-center">
                                <img src="https://pbs.twimg.com/media/FbGqCHeVEAQkb0X.png" class="img-fluid avatar-xxl rounded-circle" alt="">
                                <h4 class="font-size-10 mt-3">Nombre Apellido</h4>
                                <h5 class="font-size-13 mb-2">Nombre Usuario</h5>
                              </div>
                            </div><!-- fin col -->

                            <!--Columna de la biografia-->
                            <div class="col-md-8">
                              <div class="ms-3">
                                <div>
                                  <h4 class="card-title mb-2">Biografia</h4>
                                    <p class="mb-0 text-muted">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
                                    </div>
                                    <div class="row my-4">
                                      <div>
                                      <p class="text-muted mb-2 fw-medium">Se unio el: XX-XX-XXXX</p>
                                      <p class="text-muted fw-medium mb-2">Genero: XXXX/XXX</p>
                                      <p class="text-muted fw-medium mb-0">Seguidores: XXXk</p>
                                    <br>
                                  </div>
                                <button type="button" class="btn btn-success">Editar Perfil</button>
                              </div><!-- end row -->
                                    
                                </div>
                            </div><!-- fin col -->
                            
                        </div><!-- fin row -->
                    </div><!-- fin card body -->
                </div><!-- fin card -->

                <!--Cositas que estan arriba de mis publicaciones-->
                <ul class="nav nav-tabs nav-tabs-custom border-bottom-0 mt-3 nav-justfied" role="tablist">
                  <!--Publicaciones-->
                  <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="#">
                    <i class="fa-regular fa-rectangle-list fa-xl" style="color: #616d63;"></i></a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="#">
                    <i class="fa-solid fa-clipboard fa-xl" style="color: #616d63;"></i></a>
                  </li>
                </ul><!-- fin ul -->




                <!--Mis publicaciones-->
                <div class="card">
                    <div class="tab-content p-3">
                        <div class="tab-pane active show" id="projects-tab" role="tabpanel">
                            <div class="d-flex align-items-center">
                                <div class="flex-1">
                                    <h4 class="card-title mb-4">Mis Publicaciones</h4>
                                </div>
                            </div>

                            <div class="row" id="all-projects">
                            <div class="col-md-6" id="project-items-1">
                                    <div class="card-2">
                                        <div class="card-body">
                                            <div class="d-flex mb-3">
                                                <div class="flex-grow-1 align-items-start">
                                                    <div>
                                                        <h4 class="mb-0 text-muted">
                                                            <i class="mdi mdi-circle-medium text-success fs-3 align-middle"></i>
                                                            <span class="">Nombre Publicacion</span>
                                                        </h4>
                                                    </div>
                                                </div>
                                                <div class="dropdown ms-2">
                                                    <a href="#"><img src="https://static.vecteezy.com/system/resources/thumbnails/010/145/455/small/heart-icon-sign-symbol-design-free-png.png" alt="" class="corazonEj"></a>
                                                    
                                                    <a href="#" class="dropdown font-size-16 text-muted" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <i class="fa-solid fa-ellipsis-vertical" style="color: #827a6f;"></i>
                                                    </a>
                                                    <div class="dropdown-menu dropdown-menu-end">
                                                        <a class="dropdown-item" href="javascript: void(0);" data-bs-toggle="modal" data-bs-target=".bs-example-new-project" onclick="editProjects('project-items-2')">Reportar</a>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="mb-4">
                                                <p class="text-muted mb-0 team-description">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum in fermentum mi, sit amet hendrerit lacus. Cras dapibus, lacus non pretium tempor, ligula urna volutpat dui, ac vehicula justo metus non nunc</p>
                                            </div>
                                        </div><!-- end cad-body -->
                                    </div>
                                </div>

                                <div class="col-md-6" id="project-items-2">
                                  <div class="card-2">
                                    <div class="card-body">
                                      <div class="d-flex mb-3">
                                        <div class="flex-grow-1 align-items-start">
                                          <div>
                                            <h4 class="mb-0 text-muted">
                                              <i class="mdi mdi-circle-medium text-success fs-3 align-middle"></i>
                                              <span class="">Nombre Publicacion</span>
                                            </h4>
                                          </div>
                                        </div>
                                        <div class="dropdown ms-2">
                                          <a href="#"><img src="https://static.vecteezy.com/system/resources/thumbnails/010/145/455/small/heart-icon-sign-symbol-design-free-png.png" alt="" class="corazonEj"></a>
                                          
                                          <a href="#" class="dropdown font-size-16 text-muted" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                          <i class="fa-solid fa-ellipsis-vertical" style="color: #827a6f;"></i>
                                          </a>
                                          <div class="dropdown-menu dropdown-menu-end">
                                          <a class="dropdown-item" href="javascript: void(0);" data-bs-toggle="modal" data-bs-target=".bs-example-new-project" onclick="editProjects('project-items-2')">Reportar</a>
                                          </div>
                                        </div>
                                      </div>

                                      <div class="mb-4">
                                        <p class="text-muted mb-0 team-description">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum in fermentum mi, sit amet hendrerit lacus. Cras dapibus, lacus non pretium tempor, ligula urna volutpat dui, ac vehicula justo metus non nunc</p>
                                      </div>
                                    </div><!-- end cad-body -->
                                  </div><!-- end card -->
                                </div><!-- end col -->
                            </div><!-- end row -->
                        </div><!-- end tab pane -->
                    </div>
                </div><!-- fin card -->

            </div><!-- fin col -->
            </div><!-- fin col -->
        </div>
        </div>

<footer class="mainfooter">
        <?php include './templates/Header&Footer/footer.php'; 
        ?></footer>
</body> 
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/c723dfe3cd.js" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="../assets/js/searchBar.js"></script>
</html>
