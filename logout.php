<?php
session_start();
session_destroy();
echo 'Has cerrado tu sesión. <a href="index.php">Regresar</a>';
?>