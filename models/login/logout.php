<?php
session_start();
unset($_SESSION['autenticado']);
unset($_SESSION['usuario']);
unset($_SESSION['nome']);
unset($_SESSION['email']);
session_destroy();
setcookie('usuario_np', null, -1, '/');
header("Location: ../../views/login/index.php");
?>
