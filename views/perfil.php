<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pagina Principal</title>
    <!-- Bootstrap & Icons-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="../assets/css/theme.css">
    <link rel="stylesheet" href="../assets/css/headerfooter.css">
    <link rel="stylesheet" href="../assets/css/perfil.css">
</head>
<body>
    <header class="mainHeader">
        <?php
            include './templates/Header&Footer/header.php';
        ?></header>

<div class="container">
<div class="row">
    <div class="col-xl-8">
        <div class="card">
            <div class="card-body pb-0">
                <div class="row align-items-center">

                    <!--Columna del perfil-->
                    <div class="col-md-4">
                        <div class="text-center">
                            <img src="https://pbs.twimg.com/media/FbGqCHeVEAQkb0X.png" class="img-fluid avatar-xxl rounded-circle" alt="">
                            <h4 class="font-size-10 mt-3">Nombre Apellido</h4>
                            <h5 class="font-size-13 mb-2">Nombre Usuario</h5>
                        </div>
                    </div><!-- end col -->

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
                                    </div>
                            </div><!-- end row -->
                        </div>
                    </div><!-- end col -->
                    
                </div><!-- end row -->
            </div><!-- end card body -->
        </div><!-- end card -->

        <ul class="nav nav-tabs nav-tabs-custom border-bottom-0 mt-3 nav-justfied" role="tablist">
            <li class="nav-item" role="presentation">
              <a class="nav-link px-4 active" data-bs-toggle="tab" href="#" role="tab" aria-selected="false" tabindex="-1">
                <span class="d-block d-sm-none"><i class="fas fa-home"></i></span>
                <span class="d-none d-sm-block">Projects</span>
              </a>
            </li><!-- end li -->
            <li class="nav-item" role="presentation">
              <a class="nav-link px-4"  href="#" target="__blank" >
                <span class="d-block d-sm-none"><i class="mdi mdi-menu-open"></i></span>
                <span class="d-none d-sm-block">Tasks</span>
              </a>
            </li><!-- end li -->
        </ul><!-- end ul -->

        <div class="card">
            <div class="tab-content p-4">
                <div class="tab-pane active show" id="projects-tab" role="tabpanel">
                    <div class="d-flex align-items-center">
                        <div class="flex-1">
                            <h4 class="card-title mb-4">Projects</h4>
                        </div>
                    </div>

                    <div class="row" id="all-projects">
                        <div class="col-md-6" id="project-items-1">
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-flex mb-3">
                                        <div class="flex-grow-1 align-items-start">
                                            <div>
                                                <h6 class="mb-0 text-muted">
                                                    <i class="mdi mdi-circle-medium text-danger fs-3 align-middle"></i>
                                                    <span class="team-date">21 Jun, 2021</span>
                                                </h6>
                                            </div>
                                        </div>
                                        <div class="dropdown ms-2">
                                            <a href="#" class="dropdown-toggle font-size-16 text-muted" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="mdi mdi-dots-horizontal"></i>
                                            </a>

                                            <div class="dropdown-menu dropdown-menu-end">
                                                <a class="dropdown-item" href="javascript: void(0);">Reportar</a>
                                                <div class="dropdown-divider"></div>
                                                <a class="dropdown-item delete-item" onclick="deleteProjects('project-items-1')" data-id="project-items-1" href="javascript: void(0);">Delete</a>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="mb-4">
                                        <h5 class="mb-1 font-size-17 team-title">Marketing</h5>
                                        <p class="text-muted mb-0 team-description">Every Marketing Plan
                                            Needs</p>
                                    </div>
                                    <div class="d-flex">
                                        <div class="avatar-group float-start flex-grow-1 task-assigne">
                                            
                                            
                                            </div>
                                        </div><!-- end avatar group -->
                                        <div class="align-self-end">
                                            <span class="badge badge-soft-danger p-2 team-status">Pending</span>
                                        </div>
                                    </div>
                                </div><!-- end cardbody -->
                            </div><!-- end card -->
                        </div><!-- end col -->

                        <div class="col-md-6" id="project-items-2">
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-flex mb-3">
                                        <div class="flex-grow-1 align-items-start">
                                            <div>
                                                <h6 class="mb-0 text-muted">
                                                    <i class="mdi mdi-circle-medium text-success fs-3 align-middle"></i>
                                                    <span class="team-date">13 Aug, 2021</span>
                                                </h6>
                                            </div>
                                        </div>
                                        <div class="dropdown ms-2">
                                            <a href="#" class="dropdown-toggle font-size-16 text-muted" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="mdi mdi-dots-horizontal"></i>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-end">
                                                <a class="dropdown-item" href="javascript: void(0);" data-bs-toggle="modal" data-bs-target=".bs-example-new-project" onclick="editProjects('project-items-2')">Reportar</a>
                                                <div class="dropdown-divider"></div>
                                                <a class="dropdown-item delete-item" href="javascript:void(0);" onclick="deleteProjects('project-items-2')" data-id="project-items-2">Delete</a>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="mb-4">
                                        <h5 class="mb-1 font-size-17 team-title">Website Design</h5>
                                        <p class="text-muted mb-0 team-description">Creating the design
                                            and layout of a
                                            website.</p>
                                    </div>
                                    <div class="d-flex">
                                        <div class="avatar-group float-start flex-grow-1 task-assigne">
                                            <div class="avatar-group-item">
                                                <a href="javascript: void(0);" class="d-inline-block" data-bs-toggle="tooltip" data-bs-placement="top" value="member-10" aria-label="Kelly Osborn" data-bs-original-title="Kelly Osborn">
                                                    <img src="https://bootdey.com/img/Content/avatar/avatar1.png" alt="" class="rounded-circle avatar-sm">
                                                </a>
                                            </div>
                                            <div class="avatar-group-item">
                                                <a href="javascript: void(0);" class="d-inline-block" data-bs-toggle="tooltip" data-bs-placement="top" value="member-2" aria-label="John Page" data-bs-original-title="John Page">
                                                    <img src="https://bootdey.com/img/Content/avatar/avatar2.png" alt="" class="rounded-circle avatar-sm">
                                                </a>
                                            </div>
                                        </div><!-- end avatar group -->
                                        <div class="align-self-end">
                                            <span class="badge badge-soft-success p-2 team-status">Completed</span>
                                        </div>
                                    </div>
                                </div><!-- end cad-body -->
                            </div><!-- end card -->
                        </div><!-- end col -->
                    </div><!-- end row -->
                </div><!-- end tab pane -->
            </div>
        </div><!-- end card -->
    </div><!-- end col -->

    </div><!-- end col -->
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
