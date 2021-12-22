<?php
session_start();
include_once "MetodosProfessor.class.php";
include_once "../login/Metodos.php";

$INCLUIR = new professor();
$aud = new util();
try{
    
    $cpf = $_SESSION['usuario'];
    $professor = $_POST['cpf'];
	echo $cpf;
    echo $professor;
    $ip = $_SERVER["REMOTE_ADDR"];
    $rotina = "Alteracao de questionario pelo: $professor efetuada pelo usuario $cpf"; 
    $INCLUIR->editarQuest($_POST['titulo'], $_POST['publico_alvo'], $_POST['validade'], $_POST['aviso_resposta'], $_POST['inicio'], $_POST['codigo']);
    $aud->auditoria($rotina, $cpf, $ip);
    $_SESSION['msg'] = '<div class="alert alert-success alert-dismissible fade show" role="alert"><strong>Dados alterados com sucesso</strong><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span>';
    header('location: ../../views/professor/questionario.php');
    
    
    
} catch (Exception $e){
     echo "Erro: $e";   
    
}




?>