<?php
session_start();

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
<title>Professores</title>
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
      <div class="sidebar-heading"><figure><center><img width="100"src="../../util/image/logo.png"></center> </figure> </div>
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
</div>
      <div class="container-fluid">
        <h4 class="mt-4">Bem vindo <?php echo $_SESSION['nome'];?></h4>
        </div>
   
   
   
    </div>

  </div>
  <script>
    $("#menu-toggle").click(function(e) {
      e.preventDefault();
      $("#wrapper").toggleClass("toggled");
    });
  </script>

</body>

</html>
