<?php
session_start();
error_reporting(0);
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
  <title>NPAlunos</title>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
<meta charset="UTF-8">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.0/jquery.mask.js"></script>
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<title>Cadastro de Professores</title>
<script type="text/JavaScript" src="../../util/js/valida.js"></script>
<link href="../../util/css/simple-sidebar.css" rel="stylesheet" type="text/css">
<link href="../../util/css/modal.css" rel="stylesheet" type="text/css">
</head>

<body>
<?php
if (!isset($_SESSION['autenticado']) || !$_SESSION['autenticado']){
    $_SESSION['msg'] = '<div class="alert alert-danger alert-dismissible fade show" role="alert"><strong>Para entrar nesta pagina você deve estar logado. Por favor efetue o login!</strong><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span>';
    header( "Location: ../../views/login/index.php");
}
if ($_SESSION['adm'] != 'T'){
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
        <a href="ProfessoresInativos.php" class="list-group-item list-group-item-action bg-light"><strong>Professores Inativos</strong></a>
        <a href="Professores.php" class="list-group-item list-group-item-action bg-light"><strong>Cadastro de Professores</strong></a>
      </div>
    </div>
    <!-- /#sidebar-wrapper -->

    <!-- Page Content -->
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
                <a class="dropdown-item" onclick="location. href= 'NovaSenhaPrincipal.php'">Alterar Senha</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" onclick="location. href= '../../models/login/logout.php'">Sair</a>
              </div>
            </li>
          </ul>
        </div>
      </nav>

<!-- Editar Pagina principal aqui -->
 <div class="container-fluid">
 <h4 class="mt-4"><strong>Professores:</strong></h4>
 <p>
<p>
<p>
<p>
<div>
<?php 
if(isset($_SESSION['msg'])){
    echo $_SESSION['msg'];
    unset($_SESSION['msg']);
}
?>
</div>
 <form class="form-inline row col" method="post" action="pesquisa.php">
     <strong> Nome:</strong> <input name = "nome" id = "" class="form-control form-control-sm" type="search" placeholder="Nome" aria-label="Pesquisar">
	<strong> CPF: </strong> <input name = "cpf" id = "pesquisa2" class="form-control form-control-sm" type="search" placeholder="000.000.000-00" aria-label="Pesquisar" autocomplete="off" onkeypress="$(this).mask('000.000.000-00')">
	<strong> Setor: </strong> <input name = "setor" id = "pesquisa3" class="form-control form-control-sm" type="search" placeholder="Setor" aria-label="Pesquisar">
	<button class="btn btn-primary btn-sm" type="submit">Pesquisar</button>
    </form>
    <p>
    <p>
    <p>
    <p>
    <p>
    <p>
	<form name="searchform" method="post" action="../../models/adm/gerarplanilha.php">
    <button type ="submit" class="btn btn-success btn-sm" name = "planilha" id="planilha">Exportar Excel</button>
    </form>
    <p>
    <p>

        <table class="table table-hover">
    <tr>
        <th scope="col">Nome:</th>
        <th scope="col">E-mail:</th>
        <th scope="col">CPF:</th>
        <th scope="col">Setor:</th>
        <th scope="col">Acesso:</th>
        <th scope="col">Ações:</th>
    </tr>    
    <?php include_once '../../models/adm/processa.php';
    $pesquisaT = new pesquisa();
    Try{
       $pesquisaT->tabelaProfessores(); 
    }
    catch (Exception $e)
    {
        echo "Erro $e";
    }
    ?>
</table>
        </div>
    </div>
    <!-- /#page-content-wrapper -->

  </div>  
  <div class = 'modal_bg'>
  <div class = 'modal'>
  
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
