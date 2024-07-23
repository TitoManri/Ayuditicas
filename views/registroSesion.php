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
        <label for="nombre" class="form-label">Nombre</label>
        <input type="text" class="form-control escribir" id="nombre" placeholder="" value="" required name="nombre">
          <div class="invalid-feedback">Porfavor ingrese un nombre.</div> <!--Sirven para validar que el campo este completo-->
      </div>

<!--Apellido del Usuario-->
      <div class="col-sm-3">
        <label for="primer_apellido" class="form-label">Primer Apellido</label>
        <input type="text" class="form-control escribir" id="primer_apellido" placeholder="" value="" required="" name="primer_apellido">
          <div class="invalid-feedback">Porfavor ingrese sus apellidos.</div>
      </div>

<!--Apellido del Usuario-->
<div class="col-sm-3">
        <label for="segundo_apellido" class="form-label">Segundo Apellido</label>
        <input type="text" class="form-control escribir" id="segundo_apellido" placeholder="" value="" required="" name="segundo_apellidop">
          <div class="invalid-feedback">Porfavor ingrese sus apellidos.</div>
      </div>

<!--Genero Del usuario-->
      <div class="col-sm-4">
        <label for="genero" class="form-label">Genero</label>
        <select class="form-select escribir" aria-label="Default select example" id="genero" name="genero">
            <option selected>Eliga su genero</option>
            <option value="1">Femenino</option>
            <option value="2">Masculino</option>
            <option value="3">Prefiero no decidir</option>
        </select>
      </div>

<!--Fecha de nacimiento-->
      <div class="col-sm-8">
        <label for="fechaNacimiento" class="form-label">Fecha de nacimiento</label>
        <input type="date" class="form-control escribir" id="fechaNacimiento" placeholder="XX/XX/XXXX" value="" required="" name="fechaNacimiento">
          <div class="invalid-feedback">Porfavor ingrese su fecha de nacimiento.</div>
      </div>

<!--Correo Electronico-->
      <div class="col-12">
        <label for="correo" class="form-label">Correo electrónico </label>
        <input type="email" class="form-control escribir" id="correo" placeholder="tu@ejemplo.com" name="correo">
          <div class="invalid-feedback">Porfavor ingrese un correo electronico valido.</div>
      </div>

<!--Numero de Cedula del usuario-->
        <div class="col-sm-8">
            <label for="cedula" class="form-label">Numero de cedula</label>
            <input type="number" class="form-control escribir" id="cedula" placeholder="" value="" required="" name="cedula">
              <div class="invalid-feedback">Porfavor ingrese su numero de celuda.</div>
        </div>

<!--Numero Telefonico-->
        <div class="col-sm-4">
            <label for="telefono" class="form-label">Telefono</label>
            <input type="number" class="form-control escribir" id="telefono" placeholder="" value="" required="" name="telefono">
              <div class="invalid-feedback">Porfavor ingrese su numero de telefono.</div>
        </div>

<!--Nombre de Usuario-->
        <div class="col-12">
        <label for="nombre_usuario" class="form-label">Nombre de Usuario</label>
        <input type="text" class="form-control escribir" id="nombre_usuario" placeholder="" required="" name="nombre_usuario">
        </div>

<!--Contraseña-->
        <div class="col-sm-6">
            <label for="contrasenia" class="form-label">Contraseña</label>
            <input type="password" class="form-control escribir" id="contrasenia" placeholder="" value="" required="" name="contrasenia">
              <div class="invalid-feedback">Porfavor ingrese su numero de celuda.</div>
        </div>

<!--Confirmar Contraseña-->
        <div class="col-sm-6">
            <label for="confirmar_contrasenia" class="form-label">Confirmar Contraseña</label>
            <input type="password" class="form-control escribir" id="confirmar_contrasenia" placeholder="" value="" required="" name="confirmar_contrasenia">
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
        <div class="checkbox-button mb-3">
          <input type="checkbox" id="TYCCheck">
          <label for="TYCCheck" class="" id="TYBbtn" data-bs-toggle="modal" data-bs-target="#exampleModal" name="TYBbtn">
            Aceptar Términos y Condiciones
          </label>
        </div>
        <?php
          include './templates/registro/MRegistroSesion.php'
        ?>

        <!--Boton de registrarse-->
        <button class="w-100 btn-success" type="submit" href=""><h4>Registrar</h4></button>
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
    <script src="../assets/js/MTYCRS.js"></script>
</html>