<?php
session_start();
include_once "MetodosProfessor.class.php";
include_once "../login/Metodos.php";


$excluir = new professor();
$aud = new util();

try{
    $cpf = $_SESSION['usuario'];
    $quest = $_GET['ida'];
    $rotina = "Exclusao do questionario: $quest efetuada pelo usuário $cpf";
    $ip = $_SERVER["REMOTE_ADDR"];
    $aud->auditoria($rotina, $cpf, $ip);
    $excluir->excluirQuest($quest);
        $_SESSION['msg'] = '<div class="alert alert-success alert-dismissible fade show" role="alert"><strong>Exclusão efetuada.</strong><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span>';
        header('location: ../../views/professor/questionario.php');
    }
    catch (Exception $e)
    {
        $_SESSION['msg'] = '<div class="alert alert-danger alert-dismissible fade show" role="alert"><strong>Ocorreu um erro ao salvar os dados. Tente novamente mais tarde!</strong><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span>';
        header('location: ../../views/professor/questionario.php');
    
    }