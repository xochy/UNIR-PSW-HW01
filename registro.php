<?php
session_start();
?>
<!DOCTYPE html>
<html>

<head>
    <title>Zona de Registro</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="estilo.css">
</head>

<body>
    <?php
    //* Si acaban de enviar el formulario de acceso, leemos de $_POST los datos:
    if (isset($_POST["usuario"]) and isset($_POST["clave"])) {

        //* En ese caso, verificamos que no estén vacíos:
        if ($_POST["usuario"] == "" or $_POST["clave"] == "") {

            print("<p>Por favor, completar los campos de usuario y clave</p>");
        } else {

            //* Abrimos el archivo, pero esta vez para añadir información:
            $archivoAbierto = fopen("suscriptores.txt", "a");

            //* Preparamos los datos:
            $usuario = $_POST["usuario"];
            $clave   = $_POST["clave"];
            $texto   = $usuario . "-" . sha1($clave) . "\n";

            //* Intentamos añadirlos, validando que se haya podido hacer:
            if (fputs($archivoAbierto, $texto)) {

                print("<p>¡Gracias por sus datos, el registro se ha realizado exitosamente!</p>");

            } else {

                print("<p>Hubo un error. Intente nuevamente</p>");
            }

            //* Cerramos el archivo.
            fclose($archivoAbierto);
        }
    }
    ?>  
    <p>Página de Registro</p>
    <div id="formulario">
        <form name="acceso" method="post" action="registro.php">
            <div class="container">
                <label for="uname"><b>Usuario</b></label>
                <input type="text" placeholder="Ingrese Usuario" name="usuario" id="usuario" required>

                <label for="psw"><b>Contraseña</b></label>
                <input type="password" placeholder="Ingrese Contraseña" name="clave" id="clave" required>

                <button type="submit">Registrar</button>
        </form>
    </div>
    <div id="menu">
        <a href="index.php">Página de Ingreso</a>
    </div>
</body>
</html>