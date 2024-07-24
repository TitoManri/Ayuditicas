<!--Cositas que estan arriba de mis publicaciones-->
<ul class="nav nav-tabs nav-tabs-custom border-bottom-0 mt-3 nav-justfied" role="tablist">
    <!--Publicaciones-->
    <li class="nav-item">
        <a class="nav-link active" aria-current="page" href="#">
            <i class="fa-regular fa-rectangle-list fa-xl" style="color: #616d63;"></i></a>
    </li>
</ul><!-- fin ul -->

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
                    <div class="card-2 card-body">
                            <div class="d-flex mb-3">
                                <div class="flex-grow-1 align-items-start">
                                    <!--Nombre de la publicacion-->
                                    <div>
                                        <h4 class="mb-0 text-muted">
                                            <i class="mdi mdi-circle-medium text-success fs-3 align-middle"></i>
                                            <a>Nombre Publicacion</a>
                                        </h4>
                                    </div>
                                </div>

                                <!--Apartado del corazon-->
                                <div class="col-auto d-flex align-items-center likes position-relative"
                                    style="z-index: 1;">
                                    <i class="fa-regular fa-heart fa-lg heart-icon"></i>
                                </div>
                                <div class="dropdown ms-2">
                                    <a href="#" class="dropdown font-size-16 text-muted" data-bs-toggle="dropdown"
                                        aria-haspopup="true" aria-expanded="false">
                                        <i class="fa-solid fa-ellipsis-vertical" style="color: #827a6f;"></i>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-end">
                                        <a class="dropdown-item" href="javascript: void(0);" data-bs-toggle="modal"
                                            data-bs-target=".bs-example-new-project"
                                            onclick="editProjects('project-items-2')">Reportar</a>
                                    </div>
                                </div>
                            </div>

                            <div class="mb-4">
                                <p class="text-muted mb-0 team-description">Lorem ipsum dolor sit amet, consectetur
                                    adipiscing elit. Vestibulum in fermentum mi, sit amet hendrerit lacus. Cras dapibus,
                                    lacus non pretium tempor, ligula urna volutpat dui, ac vehicula justo metus non nunc
                                </p>
                            </div>
                        </div><!-- end cad-body -->
                    
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
                                    <a href="#"><img
                                            src="https://static.vecteezy.com/system/resources/thumbnails/010/145/455/small/heart-icon-sign-symbol-design-free-png.png"
                                            alt="" class="corazonEj"></a>

                                    <a href="#" class="dropdown font-size-16 text-muted" data-bs-toggle="dropdown"
                                        aria-haspopup="true" aria-expanded="false">
                                        <i class="fa-solid fa-ellipsis-vertical" style="color: #827a6f;"></i>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-end">
                                        <a class="dropdown-item" href="javascript: void(0);" data-bs-toggle="modal"
                                            data-bs-target=".bs-example-new-project"
                                            onclick="editProjects('project-items-2')">Reportar</a>
                                    </div>
                                </div>
                            </div>

                            <div class="mb-4">
                                <p class="text-muted mb-0 team-description">Lorem ipsum dolor sit amet, consectetur
                                    adipiscing elit. Vestibulum in fermentum mi, sit amet hendrerit lacus. Cras dapibus,
                                    lacus non pretium tempor, ligula urna volutpat dui, ac vehicula justo metus non nunc
                                </p>
                            </div>
                        </div><!-- end cad-body -->
                    </div><!-- end card -->
                </div><!-- end col -->
            </div><!-- end row -->
        </div><!-- end tab pane -->
    </div>
</div><!-- fin card -->