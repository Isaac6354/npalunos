<?php
session_start();
error_reporting(0);
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <title>NPAlunos</title>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" ></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
<meta charset="UTF-8">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.0/jquery.mask.js"></script>
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<title>Questionário - NPAlunos</title>
<script type="text/JavaScript" src="../../util/js/valida.js"></script>
<link href="../../util/css/simple-sidebar.css" rel="stylesheet">

</head>

<body>
<?php
if (!isset($_SESSION['autenticado']) || !$_SESSION['autenticado']){
    $_SESSION['msg'] = '<div class="alert alert-danger alert-dismissible fade show" role="alert"><strong>Para entrar nesta pagina você deve estar logado. Por favor efetue o login!</strong><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span>';
    header( "Location: ../../views/login/index.php");
}
if ($_SESSION['adm'] != 'F')
{
    $_SESSION['msg'] = '<div class="alert alert-danger alert-dismissible fade show" role="alert"><strong>Pagina somente permitida para usuários administradores!</strong><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span>';
    header( "Location: ../../models/login/validaUsuario.php");
}
?>

  <div class="d-flex" id="wrapper">

    <!-- Sidebar -->
    <div class="bg-light border-right" id="sidebar-wrapper">
      <div class="sidebar-heading"><figure><center><img width="100"src="../../util/image/logo.PNG"></center> </figure> </div>
    	  <div class="list-group list-group-flush">
       		 <a href="Menu.php" class="list-group-item list-group-item-action bg-light"><strong>HOME</strong></a>
     	  	 <a href="questionario.php" class="list-group-item list-group-item-action bg-light"><strong>QUESTIONÁRIOS</strong></a>
     	  </div>
    	</div>	
    <div id="page-content-wrapper">
     <nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom">
        	<button class="btn btn-primary btn-sm" id="menu-toggle">Menu</button>
        	<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        	<span class="navbar-toggler-icon"></span>
        	</button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          	<ul class="navbar-nav ml-auto mt-2 mt-lg-0">
            	<li class="nav-item active">
             		<a class="nav-link" href='Menu.php'><strong>Home</strong> <span class="sr-only">(current)</span></a>
            	</li>
            <li class="nav-item dropdown">
              	<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                	<strong><?php echo $_SESSION['nome'];?></strong> 
              	</a>
              <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
               	 	<a class="dropdown-item" onclick="location. href= '../../views/professor/NovaSenhaPrincipal.php'">Alterar Senha</a>
               	 	<div class="dropdown-divider"></div>
                	<a class="dropdown-item" onclick="location. href= '../../models/login/logout.php'">Sair</a>
              </div>
            </li>
          </ul>
        </div>
      </nav>
<div>
<?php 
if(isset($_SESSION['msg'])){
    echo $_SESSION['msg'];
    unset($_SESSION['msg']);
}
?>
<form name="form1" method="post"  action="../../models/professor/editarQuest.php">
		<div class="container-fluid">
		<div class="Cadastro">
		<div class="container theme-showcase" role="main">
		<center>

<p></p><h3><font color="#000099"> Editar questionario </font></h3><p></p> 
<div class="row">
 <div class="form-group col-md-6">
   <label for="campo1"><strong>Titulo:</strong></label>
   <input name="titulo" type="text" class="form-control" id="titulo" value = "<?php echo $_GET['titulo']?>" placeholder="Titulo do questionário" required>
   <input type="hidden" name="codigo" value="<?php echo $_GET['codigo']?>" />
 </div>
  <div class="form-group col-md-6">
   <label for="campo1"><strong>Publico Alvo:</strong></label>
   <input name="publico_alvo" type="text" class="form-control" id="publico_alvo" value = "<?php echo $_GET['publico_alvo']?>" placeholder="Publico Alvo do questionário" required>
 </div>
  <div class="form-group col-md-4">
   <label for="campo1"><strong>Data de inicio do questionário:</strong></label>
   <input name="inicio" type="date" class="form-control" id="inicio" value = "<?php echo $_GET['inicio']?>" placeholder="00/00/0000">
 </div>
 
  <div class="form-group col-md-4">
   <label for="campo1"><strong>Data de validade:</strong></label>
   <input name="validade" type="date" class="form-control" id="validade" value = "<?php echo $_GET['validade']?>" placeholder="00/00/0000">
 </div>
 <div class="form-group col-md-4">
 <label for="campo1"><strong>Deseja receber Notificações?</strong></label>
	<div class="form-check">
          <input class="form-check-input" type="radio" name="aviso_resposta" id="aviso_resposta" value="1" <?php echo ($_GET['aviso_resposta'] == "1") ? "checked" : null; ?>>
          	<label class="form-check-label" for="gridRadios1">
            	Sim
          	</label>
    </div>
        <div class="form-check">
          <input class="form-check-input" type="radio" name="aviso_resposta" id="aviso_resposta" value="0" <?php echo ($_GET['aviso_resposta'] == "0") ? "checked" : null; ?> required>
          	<label class="form-check-label" for="gridRadios2">
            	Não		
          	</label>
        </div>
 </div>
   <div id="msg"></div>
   <div class="col-md-12">
<div>
</div>      
   <center>
   <input class="btn btn-success" type="submit" name="submit" value="Salvar">
   <button type="reset" class="btn btn-danger" onclick="location. href= 'questionario.php'">Cancelar</button>
   </center>
   </div>  		
  </div>
  </div>
  </div>
  </div>
</form> 
