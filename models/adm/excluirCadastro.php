<?php
session_start();
include_once "MetodosCadastro.class.php";
include_once "../login/Metodos.php";


$excluir = new InserirProf();
$aud = new util();

try{
       
        $cpf = $_SESSION['usuario'];
        $professor = $_GET['ida'];
        if($professor != $cpf)
        {
            $rotina = "Exclusao do professor: $professor efetuada pelo usuário $cpf"; 
            $ip = $_SERVER["REMOTE_ADDR"];
            $aud->auditoria($rotina, $cpf, $ip);
            $excluir->ExcluirProfessor($professor);
            $_SESSION['msg'] = '<div class="alert alert-success alert-dismissible fade show" role="alert"><strong>Exclusão efetuada. Caso seja necessário reverter este processo entre em contato com o Administrador.</strong><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span>';
            header('location: ../../views/adm/Professores.php');
        }
        else {
            $_SESSION['msg'] = '<div class="alert alert-danger alert-dismissible fade show" role="alert"><strong>Não é possível efetuar a exclusão deste o usuário. O usuário encontra-se logado.</strong><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span>';
            header('location: ../../views/adm/Professores.php');
        }
          
} catch (Exception $e){
    echo "Erro: $e";
    return false;
    
}