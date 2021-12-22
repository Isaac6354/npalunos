<?php
session_start();
include_once "metodosProfessor.class.php";
include_once "../login/MetodoEsqueciSenha.php";
include_once "../../models/login/Metodos.php";
$incluir = new professor();
$esqueci = new Senha();
$util = new util();

try {
        
       
    if($_POST['inicio'] == "" || empty($_POST['inicio']))
        {
            $inicio = '2019-05/01';
        }
        else
        {
            
            $inicio = $_POST['inicio'];
        }
        
        
        if($_POST['validade'] == "" || empty($_POST['validade']))
        {
             $validade = '2030-05-15';   
        }
        else
        {
            
            $validade = $_POST['validade'];
        }
        $incluir->inserirQuest($_POST['titulo'], $_POST['publico_alvo'], $validade, $_POST['aviso'], $_SESSION['usuario'], $inicio, '0');
        $quest = $incluir->getUltimQuest($_SESSION['usuario']);       
        $link = "http://localhost/npaluno/npalunos/models/professor/validaUrlQuest.php?&ida=$quest";
        $assunto = "Dados do novo questionário cadastrado";
        $nome = $_SESSION['nome'];
        $corpo = "Prezado(a) $nome,<br> <br> Segue abaixo link contendo o ultimo questionário cadastrado. O link abaixo deve ser encaminhado aos alunos para Preenchimento/Respotas: <br><br> $link <br><br> Atenciosamente, <br>NPALUNOS.";
        if($esqueci->EnviaEmail($_SESSION['email'], $assunto, $corpo) == true)
        {
            $cpf = $_SESSION['usuario'];
            $rotina = "Adicionado novo questionario pelo usuario $cpf";
            $ip = $_SERVER["REMOTE_ADDR"];
            $util->auditoria($rotina, $cpf, $ip);          
            $_SESSION['msg'] = '<div class="alert alert-success alert-dismissible fade show" role="alert"><strong>Questionario cadastrado com sucesso! O Link contendo o questionário foi encaminhado ao seu Email!</strong><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span>';
            header('location: ../../views/professor/questionario.php');
        }
    } 

catch (Exception $p)
{
    echo "Ocorreu um erro inesperado: ". $p->getMessage();
    $_SESSION['msg'] = '<div class="alert alert-danger alert-dismissible fade show" role="alert"><strong>Ocorreu um erro ao salvar os dados. Tente novamente mais tarde!</strong><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span>';
    header('location: ../../views/professor/questionario.php');
}
?>