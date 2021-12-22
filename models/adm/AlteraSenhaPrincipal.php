<?php
session_start();

include_once '../login/MetodoEsqueciSenha.php';
include_once '../login/Metodos.php';

$valida = new Senha();
$aud = new util();

try
{   
    $senha_atual = $_POST['senhaAtual'];
    $cpf = $_SESSION['usuario'];
    $novaSenha = $_POST['senha'];
    if($valida->ValidaSenhaAtual($_POST['senhaAtual'], $cpf) == true)
    {
        if( $valida->AlteraSenha($_POST['senha'], $cpf));
        {   $ip = $_SERVER["REMOTE_ADDR"];
            $rotina = "Alteracao de senha. De: $senha_atual / Para: $novaSenha";
            $aud->auditoria($rotina, $cpf, $ip);
             $_SESSION['msg'] = '<div class="alert alert-success alert-dismissible fade show" role="alert"><strong>Alteração de senha efetuada com sucesso!</strong><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span>';
             header('location: ../../views/adm/Menu.php');
        }
    }
    else
    {
        $_SESSION['msg'] = '<div class="alert alert-danger alert-dismissible fade show" role="alert"><strong>Senha atual incorreta! Você será redirecionado a pagina de login. Detalhes contendo a tentativa de acesso serao encaminhadas ao seu Email.</strong><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span>';
        $email = $_SESSION['email'];
        $assunto = 'Tentativa de troca de senha!';
        $corpo = "Houve a tentativa de troca de senha, informando a senha atual inválida. Por gentileza verifique e se possível altere a sua senha!! 
Caso esta situação tenha sido efetuada por você, por gentileza desconsidere este email";
        $valida->EnviaEmail($email, $assunto, $corpo);
        unset($_SESSION['autenticado']);
        unset($_SESSION['usuario']);
        unset($_SESSION['nome']);
        unset($_SESSION['email']);
        setcookie('usuario_np', null, -1, '/');
        header('location: ../../views/login/index.php');
    }
        
}
catch (PDOException $p){
        echo $p;
    
}

?>