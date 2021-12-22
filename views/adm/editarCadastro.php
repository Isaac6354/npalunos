<?php
session_start();
require_once '../../Conectar.class.php';
    try {
        if( empty(empty($_GET['id']) ))
        {
            die('<p>Não é possível alterar a password: dados em falta</p>');
        }
    }catch (Exception $e) {
    }
    
?>

<!DOCTYPE html>
<html lang="en">

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
<title>Editar Professor</title>
<script type="text/JavaScript" src="../../util/js/valida.js"></script>
<script type="text/JavaScript" src="../../util/js/modal.js"></script>
<link href="../../util/css/simple-sidebar.css" rel="stylesheet">
<link href="../../util/css/modal.css" rel="stylesheet">
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
        <button class="btn btn-primary" id="menu-toggle">Menu</button>

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav ml-auto mt-2 mt-lg-0">
            <li class="nav-item active">
              <a class="nav-link" href='Menu.php'>Home <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <strong><?php echo $_SESSION['nome'];?></strong> 
              </a>
              <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
               <a class="dropdown-item" onclick="location. href= '../login/NovaSenhaPrincipal.php'">Alterar Senha</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" onclick="location. href= '../login/logout.php'">Sair</a>
              </div>
            </li>
          </ul>
        </div>
      </nav>

<!-- Editar Pagina principal aqui -->
<form name="form1" method="post" action="../../models/adm/alterarCadastro.php">
<div class="container-fluid">
<div class="Cadastro">
<div class="container theme-showcase" role="main">
<center>

<p></p><h3><font color="#000099"> Editar cadastro de professor </font></h3><p></p> 
<div class="row">
 <div class="form-group col-md-6">
   <label for="campo1"><strong>Nome:</strong></label>
   <input name="nome" type="text" class="form-control" id="nome" placeholder="Digite o seu nome" required value = "<?php echo $_GET['nome']?>">
 </div>
 <div class="form-group col-md-6">
   <label for="campo2"><strong>CPF:</strong></label>
   <input type="text" class="form-control cpf-mask" placeholder="Ex.: 000.000.000-00" id="cpf" name = "cpf" autocomplete="off" disabled
   onkeypress="$(this).mask('000.000.000-00')" value = "<?php echo $_GET['ida']?>">
  <input type="hidden" id="cpf" name="cpf" value="<?php echo $_GET['ida']?>">
  </div>
  <div class="form-group col-md-6">
   <label for="campo222"><strong>Setor:</strong></label>
 <select id="setor" class="form-control" name = "setor" required>
        <option selected value = "<?php echo $_GET['cod_setor']; ?>"><?php echo $_GET['setor'];?></option>
        <?php	
        try {
            $con = npaluno::conectar();
            $sql = "select * from setor";
            $stm = $con->prepare($sql);
            if($stm->execute())
            {	while($rs= $stm->fetch(PDO::FETCH_ASSOC)){ ?>
				<option value="<?php echo $rs['cod_setor'] ?>"><?php echo $rs['descricao'];?></option> <?php 
				mysqli_close($con);			
						}
            }
            }
			catch (PDOException $erro) {
			    echo "Erro: ".$erro->getMessage();
			}
					?>
</select>
</div>	        
  <div class="form-group col-md-6">
   <label for="campo29"><strong>Telefone:</strong></label>
   <input name="telefone" type="text" class="form-control phone-ddd-mask" value = "<?php echo $_GET['telefone']?>" placeholder="(00) 00000-0000" autocomplete="off"  id="telefone" onkeypress="$(this).mask('(00) 0000-00009')" required>
 </div>
 <div class="form-group col-md-12">
   <label for="campo3"><strong>E-mail:</strong></label>
   <input name="email" type="email" class="form-control" id="email" value = "<?php echo $_GET['email']?>" placeholder="Digite o seu Email" required>
 </div>
   <div id="msg"></div>
   <div class="col-md-12">
   <center>
   <input class="btn btn-success" type="submit" name="submit" value="Salvar">
   <button type="reset" class="btn btn-danger" onclick="location. href= 'Professores.php'">Cancelar</button>
   </center>
   </div>  		
  </div>
  </div>
  </div>
</form>  	
       
       
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
