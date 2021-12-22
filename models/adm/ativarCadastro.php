<?php
session_start();
include_once "MetodosCadastro.class.php";
include_once "../login/Metodos.php";
include_once '../login/MetodoEsqueciSenha.php';
$ativar = new InserirProf();
$aud = new util();
$enviar = new Senha();

try{
    $cpf = $_SESSION['usuario'];
    $professor = $_GET['ida'];
    $rotina = "Professor ativado: $professor pelo usuario $cpf";
    $ativar-> AtivarProfessor($professor);
    $assunto = "Usuario Ativado - NPAlunos";
    $email = $_GET['email'];
    $link = "http://localhost/npaluno/npalunos/views/login/index.php";
    $corpo = "Prezado Professor, o seu usuario foi ativado pelo administrador. Por gentileza direcione-se ao seguinte link para acessar o sistema: $link";
    $ip = $_SERVER["REMOTE_ADDR"];
    $aud->auditoria($rotina, $cpf, $ip);
    $enviar->EnviaEmail($email, $assunto, $corpo);
    $_SESSION['msg'] = '<div class="alert alert-success alert-dismissible fade show" role="alert"><strong>Ativação efetuada com sucesso.</strong><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span>';
    header('location: ../../views/adm/ProfessoresInativos.php');
    
    
} catch (Exception $e){
    echo "Erro: $e";
    return false;
    
}