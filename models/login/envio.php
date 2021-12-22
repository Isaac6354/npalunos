<?php 
session_start();
error_reporting(0);
include_once 'MetodoEsqueciSenha.php';

$esqueci = new Senha();

try
{   if($esqueci->CpfEmail($_POST["email"], $_POST["cpf"]) == true)
    {  
       $assunto = utf8_decode("Recuperação de Senha NPAlunos");
       
       $email = $_POST['email'];
       $id = md5(uniqid(time()));
       $link = "http://localhost/npaluno/npalunos/models/login/ValidaUrl.php?&ida=$id";
       $corpo = "Prezado Professor, <br> <br>Segue link para recuperação de sua senha:<br><br> $link <br><br> Atenciosamente, <br> NPALUNOS";
       if($esqueci->EnviaEmail($_POST["email"], $assunto, $corpo) == true)
       {
          $esqueci->SalvaNovaSenha($id, $email);
           $_SESSION['msg'] = '<div class="alert alert-success alert-dismissible fade show" role="alert"><strong>Email contendo as orientações para alteração de senha, foi enviado ao seu endereço de E-mail</strong><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span>';
          header('location: ../../views/login/index.php');          
       }
       else 
       {
           echo "erro";
       }
    }
    
}

catch (PDOException $p){
    
}


?>