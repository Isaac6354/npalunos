<?php
session_start();
include_once '../../Conectar.class.php';
if( empty(empty($_GET['id']) ))
    die('<p>Não é possível alterar a password: dados em falta</p>');
    $id = $_GET['ida'];
    $con = npaluno::conectar();
    $stm = $con->prepare("select * from esqueci_senha where id = (?) and data >= NOW()");
    $stm->bindParam(1, $id);
    $stm->execute();
    $dados = $stm->fetchAll(PDO::FETCH_ASSOC);
    if(count($dados) == 1)
    {
        $_SESSION['autenticado'] = true;
        $_SESSION['id'] = $id;
        header("Location: ../../views/login/NovaSenha.php");
        
    } else {
        $_SESSION['autenticado'] = false;
        header("Location: ../../views/login/PaginaInvalida.php");
       
        
    }
    
    ?>