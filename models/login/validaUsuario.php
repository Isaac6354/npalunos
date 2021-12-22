<?php
session_start();
include_once 'Usuario.class.php';
$user = new Usuario();
$usuario = base64_decode($_COOKIE["usuario_np"]);
if(!isset($_SESSION['usuario']) || !$_SESSION['usuario'])
{
    $_SESSION['usuario'] = $usuario;    
}
$user->DadosUsuario($_SESSION['usuario']);

if($user->verificaAdmProf($_SESSION['usuario'])== true)
{
    $_SESSION['adm'] = 'F';
    header('location: ../../views/professor/Menu.php');
}
else
{
    $_SESSION['adm'] = 'T';
    header('location: ../../views/adm/Menu.php');
}