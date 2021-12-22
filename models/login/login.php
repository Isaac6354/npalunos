<?php
session_start();
include_once "../../Conectar.class.php";
include_once "Usuario.class.php";
$user = new usuario();
try {
    
    if ($user->confere($_POST['usuario'],$_POST['senha']) == false)
    {
        $_SESSION['autenticado'] = false;
        $_SESSION['msg'] = '<div class="alert alert-danger alert-dismissible fade show" role="alert"><strong>Usuário ou senha inválidos!</strong><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span>';
        header('location: ../../views/login/index.php');
        return false;
        
    }
    if($user-> liberado($_POST['usuario'], 1) == false)
    {
        $_SESSION['autenticado'] = false;
        $_SESSION['msg'] = '<div class="alert alert-danger alert-dismissible fade show" role="alert"><strong>Usuário não liberado. Entre em contato com o administrador!</strong><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span>';
        header('location: ../../views/login/index.php');
        return false;
    }
    
    
} catch(PDOException $p){
    echo "Ocorreu um erro inesperado: ". $p->getMessage();
}
try {
    
    if($user->confere($_POST['usuario'],$_POST['senha']) == true) {
        if($user-> liberado($_POST['usuario'], 1) == true)
        {
            $_SESSION['autenticado'] = true;
            $_SESSION['usuario'] = $_POST['usuario'];
            if (isset($_POST["conectado"])=="1"){
                setcookie("usuario_np",  base64_encode($_SESSION['usuario']) , time()+(280000 * 30), "/");
            }
            $user->atualizaAcesso($_POST['usuario']);
            header('location: validaUsuario.php');
        }
    }
    
}catch(PDOException $p){
    echo "Ocorreu um erro inesperado: ". $p->getMessage();
}


?>
