<?php
session_start();
include_once 'MetodoEsqueciSenha.php';
include_once 'Metodos.php';

$valida = new Senha();
try
{   
        $valida->SalvaID($_POST['senha'], $_SESSION['id']); 
        $valida->deletaID($_SESSION['id']);
        $_SESSION['msg'] = '<div class="alert alert-success alert-dismissible fade show" role="alert"><strong>Alteração de senha efetuada com sucesso!</strong><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span>';
        header('location: ../../views/login/index.php');
}
catch (PDOException $p){
    $_SESSION['msg'] = '<div class="alert alert-danger alert-dismissible fade show" role="alert"><strong>Senha atual incorreta!</strong><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span>';
    header('location: ../../views/login/index.php');
    
}