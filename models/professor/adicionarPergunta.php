<?php
session_start();
include_once "metodosProfessor.class.php";
include_once "../../models/login/Metodos.php";
$incluir = new professor();
$util = new util();

try 
{
        if($_POST['tipo'] == 'range')
        {

            if($incluir->inserirPergunta($_POST['questionario'], $_POST['pergunta'] , 1) == true)
            {
               $id_perg = $incluir->getUltimPerg($_POST['questionario']);
               $incluir->inserirOpcoes($_POST['inicio'], $id_perg);
               $incluir->inserirOpcoes($_POST['final'], $id_perg);
               $_SESSION['msg'] = '<div class="alert alert-success alert-dismissible fade show" role="alert"><strong>Pergunta adicionada com sucesso!</strong><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span>';
               header('location: ../../views/professor/addPergunta.php');
            }
            else {
                echo 'erro';
            }
        }
        if($_POST['tipo'] == 'aberta')
        {
            
            $incluir->inserirPergunta($_POST['questionario'], $_POST['pergunta'] , 4);
            $_SESSION['msg'] = '<div class="alert alert-success alert-dismissible fade show" role="alert"><strong>Pergunta adicionada com sucesso!</strong><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span>';
            header('location: ../../views/professor/addPergunta.php');
        }
        

}
catch (Exception $p)
{
    echo "Ocorreu um erro inesperado: ". $p;
    $_SESSION['msg'] = '<div class="alert alert-danger alert-dismissible fade show" role="alert"><strong>Ocorreu um erro ao salvar os dados. Tente novamente mais tarde!</strong><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span>';
    header('location: ../../views/professor/questionario.php');
}
?>
