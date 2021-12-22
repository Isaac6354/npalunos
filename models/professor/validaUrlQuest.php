<?php
session_start();
date_default_timezone_set('America/Sao_Paulo');
    include_once '../../Conectar.class.php';
    if(!empty($_GET['ida']))
    {
        $id = $_GET['ida'];
        $con = npaluno::conectar();
        $stm = $con->prepare("select codigo, validade, inicio, ativo, publicar from questionario where codigo = (?)");
        $stm->bindParam(1, $id);
        $stm->execute();
        $dados = $stm->fetch(PDO::FETCH_ASSOC);
        if(count($dados) >= 1)
        {
            if(strtotime($dados['validade']) >= strtotime(date('Y-m-d')))
            {
                if(strtotime($dados['inicio']) <= strtotime(date('Y-m-d')))
                {
                    if($dados['ativo'] == '1')
                    {    
                        if ($dados['publicar'] == '1') 
                        {
                            header("Location: ../../views/professor/RespQuestionario.php?&ida=$id");
                        }
                        else
                        {
                            $_SESSION['msg'] = '<div class="alert alert-danger alert-dismissible fade show" role="alert"><strong>O questionário ainda não encontra-se liberado. Entre em contato com o seu professor.</strong><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span>';
                            header("Location: ../../views/professor/Quest404.php");
                        }
                    }
                    else
                    {
                        $_SESSION['msg'] = '<div class="alert alert-danger alert-dismissible fade show" role="alert"><strong>O questionário foi encerrado antecipadamente. Entre em contato com o seu professor.</strong><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span>';
                        header("Location: ../../views/professor/Quest404.php");
                    }
                }
                else 
                {
                    $_SESSION['msg'] = '<div class="alert alert-danger alert-dismissible fade show" role="alert"><strong>O questionário em questão ainda não foi iniciado!</strong><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span>';
                    header("Location: ../../views/professor/Quest404.php");
                }
            }
            else 
            {
                $_SESSION['msg'] = '<div class="alert alert-danger alert-dismissible fade show" role="alert"><strong>O questionário em questão encontra-se vencido! Entre em contato com o seu professor para maiores esclarecimentos</strong><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span>';
                header("Location: ../../views/professor/Quest404.php");
            }
       }
       else 
       {
           $_SESSION['msg'] = '<div class="alert alert-danger alert-dismissible fade show" role="alert"><strong>O questionário em questão não foi encontrado</strong><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span>';
           header("Location: ../../views/professor/Quest404.php");
       }
    }
    ?>