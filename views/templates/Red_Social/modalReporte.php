<div class="modal fade" id="reportar" tabindex="-1" aria-labelledby="modalReporte" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="modalTituloReporte">Enviar Reporte</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Gracias por velar por ti y por la comunidad al denunciar contenidos que no cumplen
                    con las normas. Infórmanos de cualquier irregularidad y nos encargaremos de
                    revisarla.</p>
                <label for="tipoReporte" class="form-label">Esta publicacion se categoriza: </label>
                <select class="form-select" aria-label="Tipo Reporte" id="tipoReporte">
                    <option selected>Tipo Reporte</option>
                    <option value="1">Contenido inapropiado o ofensivo</option>
                    <option value="2">Spam o contenido no deseado</option>
                    <option value="3">Violencia o daño físico</option>
                    <option value="4">Acoso o intimidación</option>
                    <option value="5">Discursos de odio</option>
                    <option value="6">Derechos de autor</option>
                </select>
                <div class="mb-3 mt-3">
                    <label for="contenidoReporte" class="form-label">Describenos el problema</label>
                    <textarea class="form-control" id="contenidoReporte" rows="5"></textarea>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-reporte" data-bs-target="#verificarReporte"
                    data-bs-toggle="modal">Enviar Reporte</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="verificarReporte" tabindex="-1" aria-labelledby="modalReporte" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="modalTituloReporte">Muchas Gracias por tu Opinión</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Gracias por avisarnos, nuestro equipo se encargará de revisar tu reporte y tomará las medidas
                    necesarias para garantizar que se cumplan nuestras normas. Apreciamos tu compromiso con la
                    comunidad.</p>
            </div>
        </div>
    </div>
</div>