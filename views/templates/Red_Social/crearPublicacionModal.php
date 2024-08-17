<div class="modal fade" id="crearPublicacionModal" aria-hidden="true" aria-labelledby="crearPublicacionModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalToggleLabel">Crear la Publicación</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="crearPublicacionForm">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="tituloPublicacion" class="form-label">Título de la Publicación</label>
                                <input type="text" class="form-control w-100" id="tituloPublicacion" placeholder="Título de la Publicación" required name="titulo">
                            </div>
                            <div class="mb-3">
                                <label for="descripcionPublicacion" class="form-label">Descripción de la Publicación</label>
                                <textarea class="form-control w-100" id="descripcionPublicacion" rows="5" style="resize: none;" required name="descripcion"></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="descripcionPublicacion" class="form-label">¿Esta publicación es para alguna campaña? </label>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio1" value="option1">
                                    <label class="form-check-label" for="inlineRadio1">Sí</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio2" value="option2" checked>
                                    <label class="form-check-label" for="inlineRadio2">No</label>
                                </div>
                            </div>
                            <div id="comunidadSection" class="mb-3" style="display: none;">
                                <label for="descripcionPublicacion" class="form-label">¿Cuál?</label>
                                <select class="form-select" aria-label="Default select example" name="campaniaSeleccionada">
                                    <option selected>Campañas</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="descripcionPublicacion" class="form-label">Etiquetas (Max.3)</label>
                                <input type="text" id="tags" class="form-control" />
                            </div>
                        </div>
                        <div class="col-md-6">
                            <center><label for="descripcionPublicacion" class="form-label mt-5">Imagen para la Publicación</label></center>
                            <div class="mb-4 mt-1 d-flex justify-content-center">
                                <img id="selectedImage" src="https://mdbootstrap.com/img/Photos/Others/placeholder.jpg" alt="example placeholder" style="width: 300px;" />
                            </div>
                            <div class="d-flex justify-content-center mb-4">
                                <div data-mdb-ripple-init class="btn btn-primary btn-rounded">
                                    <label class="form-label text-white m-1" for="customFile1">Escoja una Foto</label>
                                    <input type="file" class="form-control d-none" id="customFile1" name="imagen" onchange="displaySelectedImage(event, 'selectedImage')" />
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-primary" id="btnNext" type="submit">Crear Publicación</button>
                    </div>
                </form>
                
            </div>
        </div>
    </div>
</div>
