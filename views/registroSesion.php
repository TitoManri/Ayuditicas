<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="./assets/css/theme.css">
    <link rel="stylesheet" href="./assets/css/headerfooter.css">
    <link rel="stylesheet" href="../views/assets/css/registro.css">
</head>
<body>
<header class="mainHeader">
        <?php
            include './templates/Header&Footer/header2.php';
        ?></header>

<div class="container form-container">
   <h1 class="mb-3 titulo">Registro de Usuario</h1>
    <hr>
    <form class="needs-validation form-container" novalidate="">
        <div class="row g-3">

<!--Nombre del usuario-->
      <div class="col-sm-6">
        <label for="firstName" class="form-label">Nombre</label>
        <input type="text" class="form-control escribir" id="firstName" placeholder="" value="" required>
          <div class="invalid-feedback">Porfavor ingrese un nombre.</div> <!--Sirven para validar que el campo este completo-->
      </div>

<!--Apellido del Usuario-->
      <div class="col-sm-6">
        <label for="lastName" class="form-label">Apellidos</label>
        <input type="text" class="form-control escribir" id="lastName" placeholder="" value="" required="">
          <div class="invalid-feedback">Porfavor ingrese sus apellidos.</div>
      </div>

<!--Genero Del usuario-->
      <div class="col-sm-4">
        <label for="gender" class="form-label">Genero</label>
        <select class="form-select escribir" aria-label="Default select example" id="gender">
            <option selected>Eliga su genero</option>
            <option value="1">Femenino</option>
            <option value="2">Masculino</option>
            <option value="3">Prefiero no decidir</option>
        </select>
      </div>

<!--Fecha de nacimiento-->
      <div class="col-sm-8">
        <label for="fechaNacimiento" class="form-label">Fecha de nacimiento</label>
        <input type="date" class="form-control escribir" id="fechaNacimiento" placeholder="XX/XX/XXXX" value="" required="">
          <div class="invalid-feedback">Porfavor ingrese su fecha de nacimiento.</div>
      </div>

<!--Correo Electronico-->
      <div class="col-12">
        <label for="email" class="form-label">Correo electrónico </label>
        <input type="email" class="form-control escribir" id="email" placeholder="tu@ejemplo.com">
          <div class="invalid-feedback">Porfavor ingrese un correo electronico valido.</div>
      </div>

<!--Numero de Cedula del usuario-->
        <div class="col-sm-8">
            <label for="numCedula" class="form-label">Numero de cedula</label>
            <input type="number" class="form-control escribir" id="numCedula" placeholder="" value="" required="">
              <div class="invalid-feedback">Porfavor ingrese su numero de celuda.</div>
        </div>

<!--Numero Telefonico-->
        <div class="col-sm-4">
            <label for="telefono" class="form-label">Telefono</label>
            <input type="number" class="form-control escribir" id="telefono" placeholder="" value="" required="">
              <div class="invalid-feedback">Porfavor ingrese su numero de telefono.</div>
        </div>

<!--Nombre de Usuario-->
        <div class="col-12">
        <label for="nomUsuario" class="form-label">Nombre de Usuario</label>
        <input type="text" class="form-control escribir" id="nomUsuario" placeholder="" required="">
        </div>

<!--Contraseña-->
        <div class="col-sm-6">
            <label for="contraseña" class="form-label">Contraseña</label>
            <input type="password" class="form-control escribir" id="contraseña" placeholder="" value="" required="">
              <div class="invalid-feedback">Porfavor ingrese su numero de celuda.</div>
        </div>

<!--Confirmar Contraseña-->
        <div class="col-sm-6">
            <label for="ConfContra" class="form-label">Confirmar Contraseña</label>
            <input type="password" class="form-control escribir" id="ConfContra" placeholder="" value="" required="">
              <div class="invalid-feedback">Porfavor ingrese su numero de telefono.</div>
        </div>

<!--El "Ya teiene una cuenta"-->
        <div class="col-sm-3">
        <a class="link" href="./inicioSesion.php">¿Ya tienes cuenta? Inicia sesion</a>
        </div>

        <div class="col-sm-6"></div>

<!--Boton de Registrar-->
        <div class="col-sm-3">
        <!--Checkbox para el Aceptar Terminos y Condiciones-->
        <div class="checkbox mb-3">
          <label> <input type="checkbox" value="remember-me">&nbsp;Aceptar Terminos y Condiciones</label>
        </div>
        <button class="w-100 btn btn-success" type="submit" href=""><h4>Registrar</h4></button>
        </div>
        <br><br><br><br><br><br><br><br>
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
    <script src="../assets/js/searchBar.js"></script>
</html>