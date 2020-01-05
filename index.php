<?php
session_start();
?>
<!DOCTYPE html>
<html>

<head>
  <title>Zona de Ingreso</title>
  <meta charset="utf-8">
  <link rel="stylesheet" href="estilo.css">
</head>

<body>
  <?php
  //* 1. Si acaban de enviar el formulario de acceso, leemos de $_POST los datos:
  if (isset($_POST["usuario"]) and isset($_POST["clave"])) {

    //* 2. En ese caso, verificamos que no estén vacíos:
    if ($_POST["usuario"] == "" or $_POST["clave"] == "") {

      print("<p>Por favor, completar los campos de usuario y clave</p>");

    } else {

      $usuarios     = file("suscriptores.txt");
      $credenciales = array();

      foreach ($usuarios as $usuarioArchivo) {

        if (empty(preg_replace('~[\r\n]+~', '', $usuarioArchivo))) continue;

        $usuarioArr = explode('-', $usuarioArchivo);

        $credenciales[$usuarioArr[0]] = $usuarioArr[1];
      }

      if (array_key_exists($_POST["usuario"], $credenciales) && preg_replace('~[\r\n]+~', '', $credenciales[$_POST["usuario"]]) == sha1($_POST["clave"])) {

        //* 4. Si eran correctos los datos, los colocamos en variables de sesión:
        $_SESSION["usuario"] = $_POST["usuario"];
        $_SESSION["clave"]   = $_POST["clave"];

        print("<p>Bienvenido, usted se ha identificado correctamente como: " . $_SESSION["usuario"] . "</p>");
        
      } else {

        print("<p>¡Usuario y/o contraseña incorrecta, favor de revisar sus datos!</p>");
      }
    }
  }
  ?>
  <p>Página de Ingreso</p>
  <div id="formulario">
    <form name="acceso" method="post" action="index.php">
      <div class="imgcontainer">
        <img src="img.png" alt="Avatar" class="avatar">
      </div>

      <div class="container">
        <label for="uname"><b>Usuario</b></label>
        <input type="text" placeholder="Ingrese Usuario" name="usuario" id="usuario" required>

        <label for="psw"><b>Contraseña</b></label>
        <input type="password" placeholder="Ingrese Contraseña" name="clave" id="clave" required>

        <button type="submit">Ingresar</button>
      </div>
    </form>
    <div class="container">
      <span class="psw">¿Eres nuevo?<a href="registro.php">¡Regístrate!</a></span>
      <?php
      if (isset($_SESSION["usuario"]) and $_SESSION["usuario"] <> "") { ?>
        <a href="logout.php">Cerrar sesión</a>
      <?php
      }
      ?>
    </div>
  </div>
</body>
</html>