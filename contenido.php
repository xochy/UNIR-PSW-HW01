<?php
session_start();
if (isset($_SESSION["usuario"]) and $_SESSION["usuario"] <> "") {

    echo "Usted se ha identificado como: " . $_SESSION["usuario"];
    //* Notemos que dejamos SIN CERRAR la llave del if

?>
    <h1>PEGAR aquí TODA LA "PAGINA SECRETA"</h1>
    <div id="menu">
        <ul>
            <li><a href="index.php">Página de Inicio</a></li>
        </ul>
    </div>
<?php
    //* Recién aquí cerramos el if
} else {
?>
    <p>La sesión no está abierta, por favor utilice el <a href="index.php">formulario de acceso</a></p>
<?php
}
?>