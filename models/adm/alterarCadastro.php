<?php
session_start();
include_once "MetodosCadastro.class.php";
include_once "../login/Metodos.php";

$INCLUIR = new InserirProf();
$aud = new util();
try{
    
    if($INCLUIR->validaEmailEdicao($_POST['email'], $_POST['cpf']) == true)   
    {   $cpf = $_SESSION['usuario'];
        $professor = $_POST['cpf'];
        echo $cpf;
        echo $professor;
        $ip = $_SERVER["REMOTE_ADDR"];
        $rotina = "Alteracao do professor: $professor efetuada pelo usuario $cpf"; 
        $INCLUIR->SalvarEdicaoCadastro($_POST['nome'], $_POST['setor'], $_POST['telefone'], $_POST['email'], $_POST['cpf']);
        $aud->auditoria($rotina, $cpf, $ip);
        $_SESSION['msg'] = '<div class="alert alert-success alert-dismissible fade show" role="alert"><strong>Dados alterados com sucesso</strong><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span>';
        header('location: ../../views/adm/Professores.php');
    }
    else {
        $_SESSION['msg'] = '<div class="alert alert-danger alert-dismissible fade show" role="alert"><strong>Email já encontra-se cadastrado para outro usuário! </strong><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span>';
        header('location: ../../views/adm/Professores.php');
        return false;
        
    }
    
} catch (Exception $e){
     echo "Erro: $e";   
    
}




?>