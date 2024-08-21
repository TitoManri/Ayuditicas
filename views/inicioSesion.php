
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="./assets/css/theme.css">
    <link rel="stylesheet" href="./assets/css/headerfooter.css">
    <link rel="stylesheet" href="./assets/css/IS.css">
</head>
<body>
<header class="mainHeader">
        <?php
            include './templates/Header&Footer/header2.php';
        ?></header>
<div id="response"></div> 

<div class="container">                                                                    
  <form class="position-absolute top-50 start-50 translate-middle margenes" id="formIniciarSesion" method="post">
    <h3 class="mb-3 text-center">Iniciar sesion</h3>
    <hr>

      <!--Forms para el nombre y contraseña-->
      <div class="form-floating"> 
        <input type="text" class="form-control" id="nombreUsuario" placeholder="nombreUsuario" name="nombreUsuario">
        <label for="nombreUsuario">Nombre Usuario</label>
      </div>
      <div class="form-floating">
        <input type="password" class="form-control" id="Contrasenia" placeholder="Contrasenia" name="contrasenia">
        <label for="Contrasenia">Contraseña</label>
      </div>

      <a class="text-decoration-none text-dark" href="">¿Olvidaste tu contraseña?</a>
      <br>
      <button id="iniciarSesionBtn" class="w-100 btn boton-inicio" type="submit">Iniciar sesión</button>
      <br>
    <a class="text-decoration-none text-dark" href="./registroSesion.php">¿No tienes una cuenta? Registrate</a>
  </form>
</div>
<footer class="mainfooter">
        <?php include './templates/Header&Footer/footer.php';
        ?></footer>
</body>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/c723dfe3cd.js" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="./assets/js/inicioSesion.js"></script>
</html>