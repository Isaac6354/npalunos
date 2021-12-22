<?php
session_start();
	include_once "../adm/MetodosCadastro.class.php";
	$INCLUIR = new InserirProf();

try{ 
    if($INCLUIR->validaEmail($_POST["email"]) == false)
    {
        $_SESSION['msg'] = '<div class="alert alert-danger alert-dismissible fade show" role="alert"><strong>E-mail já cadastrado!</strong><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span>';
        header('location: ../../views/cadastro/cadastroProf.php');
        return false;
    }
        
} catch (Exception $e){
        return false;
    
}
try{
    if($INCLUIR->validaCpf($_POST["cpf"]) == false)
    {
        $_SESSION['msg'] = '<div class="alert alert-danger alert-dismissible fade show" role="alert"><strong>CPF já cadastrado!</strong><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span>';
        header('location: ../../views/cadastro/cadastroProf.php');
        return false;
    }
} catch (Exception $e){
    return false;
    
}
	try {
		    $INCLUIR->novo($_POST["nome"],$_POST["cpf"], $_POST["email"], $_POST["setor"], $_POST["senha"], 
		     $_POST["telefone"], 0 , 0, "");
		    $_SESSION['msg'] = '<div class="alert alert-success alert-dismissible fade show" role="alert"><strong>Cadastro Efetuado com sucesso!</strong><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span>';
		    header('location: ../../views/login/index.php');
		    
		    
		} catch (Exception $e){
		    $_SESSION['msg'] = '<div class="alert alert-danger alert-dismissible fade show" role="alert"><strong>Ocorreu um erro ao salvar os dados. Tente novamente mais tarde!</strong><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span>';
		    header('location: ../../views/cadastro/cadastroProf.php');
		    
		    
		}
	?>