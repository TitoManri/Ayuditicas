<div id="FORM" class="container-fluid">
    <div class="container_label">
        <h5>Crear denuncia</h5>
    </div>
    <div class="container">
        <form method="post" action="" id="formDenuncia">
            <div class="row gx-5">
                <div class="col">
                    <label for="tipoDenuncia" class="form-label">
                        <h3>Tipo denuncia</h3>
                    </label>
                    <input class="form-control" id="tipoDenuncia" readonly>
                </div>
                <div class="col">
                    <label>
                        <h3>Imágen</h3>
                    </label>
                    <div class="imagenPreviewContainer">
                        <img id="imagenPreview" src="" alt="Vista previa de la imagen">
                    </div>
                </div>
            </div>
            <div class="row gx-5">
                <div class="col">
                    <label for="IdDetalle" class="form-label">
                        <h3>Detalle</h3>
                    </label>
                    <textarea class="form-control" id="IdDetalle" rows="4" readonly></textarea>
                </div>
                <div class="col">
                    <label for="ubicacion" class="form-label">
                        <h3>Ubicación</h3>
                    </label>
                    <br>
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d780739.7870962442!2d-4.508766387499999!3d40.14752270238211!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0xd42287bd0788e65%3A0xa28363ebaaa7adae!2sTeatro%20Real!5e0!3m2!1ses-419!2scr!4v1720387958264!5m2!1ses-419!2scr" width="300" height="150" style="border:0;" allowfullscreen="" referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
            </div>
            <div class="row justify-content-center mt-4">
                <input class="btn_enviar mx-1" type="submit" value="Aceptar">
                <input class="btn_enviar mx-1" type="submit" value="Eliminar">
            </div>
        </form>
    </div>
</div>
