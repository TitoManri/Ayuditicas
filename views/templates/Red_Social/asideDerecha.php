<aside id="EtiquetaAside" class="EtiquetasAside">
<h3 class="text-center">Campañas</h3>
    <div class="text-center">
        <a href="./Camps.php" style="color: #827a6f; opacity: 47%;" class="text-center">Ver todo</a>
    </div>
    <br>
    <?php for ($i = 0; $i < 2; $i++) { ?>
        <div class="Etiquetas">
            <a href="">
                <div class="row">
                    <div class="col d-flex justify-content-center">
                        <img src="https://cdn.iconscout.com/icon/free/png-256/free-gallery-187-902099.png?f=webp" alt="" width="60px" height="60px">
                    </div>
                    <div class="col">
                        <div class="row" style="height: 30%;">
                            <p>Nombre</p>
                        </div>
                        <div class="row">
                            <p style="font-size: 14px; opacity: 47%;" class="text-truncate">Descripcion</p>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        <br>
    <?php } ?>
    <h3 class="text-center">Etiquetas</h3>
    <div class="text-center">
        <a href="./VerEtiquetas.php" style="color: #827a6f; opacity: 47%;" class="text-center">Ver todo</a>
    </div>
    <br>
    <?php for ($i = 0; $i < 3; $i++) { ?>
        <div class="Etiquetas">
            <a href=""><i class="bi bi-tag-fill" style="color: #bcc9b8;"></i> Nombre</a>
        </div>
        <br>
    <?php } ?>
</aside>