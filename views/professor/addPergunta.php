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
               	 	<a class="dropdown-item" onclick="location. href= 'NovaSenhaPrincipal.php'">Alterar Senha</a>
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

<div class="form-group col-md-4">
      <label for="pergunta"><strong><h5>Selecione o tipo de pergunta:</h5></strong></label>
      <select id="tipoPerg" name = "tipoPerg" class="form-control">
        <option value = ''>Selecione...</option>
        <option value = 'range'>Range</option>
        <option value = 'multipla'>Multipla escolha</option>
        <option value = 'diversas'>Multipla escolha(Varias opções)</option>
        <option value = 'aberta'>Livre</option>
      </select>
    </div>	
	<div id="pai">
        <div id = "range" >    
        <form method="post" action="../../models/professor/adicionarPergunta.php">    
        <input type='hidden' value = 'range' name = 'tipo'> 	
        <input type='hidden' value = "<?php echo $_GET['ida'];?>" name = 'questionario'>
        	<div id = "range" class="form-group col-md-10">
    			<label for="exampleFormControlTextarea1">Pergunta:</label>
    			<textarea class="form-control" id="pergunta" name = "pergunta" rows="2" required></textarea>
  			</div>
        
         	<div id = "range" class="form-group col-md-2">
      			<label for="inicio">Inicio:</label>
      			<input type="number" name = "inicio" class="form-control" id="inicio" min="0" required>
    		</div>       
         	<div id = "range" class="form-group col-md-2">
      			<label for="inicio">Final:</label>
      			<input type="number" name = "final" class="form-control" id="final" min="0" required>
    		</div>  
   				<input class="btn btn-primary btn-sm" type="submit" name="submit" value="Salvar">
   				<button type="reset" class="btn btn-danger btn-sm" onclick="location. href= 'questionario.php'">Cancelar</button>    		      
        </form>
        </div>        
        
        <div id = "multipla">
        <form method="post" action="../../models/professor/adicionarPergunta.php">  
        <input type='hidden' value = 'multipla' name = 'tipo'> 	
        <input type='hidden' value = '<?php echo $_GET['ida'];?>>' name = 'questionario'> 
        	<div id = "multipla" class="form-group">
    			<label for="exampleFormControlTextarea1">Pergunta:</label>
    			<textarea class="form-control" id="pergunta" name = "pergunta" rows="2" required></textarea>
  			</div>
        <fieldset class="form-group">
    <div class="row" id = "multipla">
      <div class="col-sm-10" id = "multipla">
        <div class="form-check" id = "multipla">
          <input class="form-check-input" type="radio" name="gridRadios" id="gridRadios1" value="opcao1" checked >
          <label class="form-check-label" for="gridRadios1">
            
          </label>
        </div>
      </div>
    </div>
  </fieldset>  
  
   				<input class="btn btn-primary btn-sm" type="submit" name="submit" value="Salvar">
   				<button type="reset" class="btn btn-danger btn-sm" onclick="location. href= 'questionario.php'">Cancelar</button>    		      
        </form>
        
        
        </div>
        
        <div id = "diversas">
        <form method="post" action="../../models/professor/adicionarPergunta.php">    
  			<input type='hidden' value = 'diversas' name = 'tipo'>
  			<input type='hidden' value = '<?php echo $_GET['ida'];?>>' name = 'questionario'> 	 	
  			<div class="form-group">
    			<label for="exampleFormControlTextarea1">Pergunta:</label>
    			<textarea class="form-control" id="pergunta" name = "pergunta" rows="2" required></textarea>
  			</div>
   				<input class="btn btn-primary btn-sm" type="submit" name="submit" value="Salvar">
   				<button type="reset" class="btn btn-danger btn-sm" onclick="location. href= 'questionario.php'">Cancelar</button>    		      
        </form>
        
        </div>
        
        <div id = "aberta">
        <form method="post" action="../../models/professor/adicionarPergunta.php">
        <input type='hidden' value = 'aberta' name = 'tipo'> 
        <input type='hidden' value = '<?php echo $_GET['ida'];?>>' name = 'questionario'> 	    
  				<div class="form-group">
    				<label for="exampleFormControlTextarea1">Pergunta:</label>
    				<textarea class="form-control"  id="pergunta" name = "pergunta" rows="2" required></textarea>
  				</div>
   				<input class="btn btn-primary btn-sm" type="submit" name="submit" value="Salvar">
   				<button type="reset" class="btn btn-danger btn-sm" onclick="location. href= 'questionario.php'">Cancelar</button>    		      
        </form>
        </div>
 	</div>       
</div>
   
   
   
    </div>

  </div>
  <script>
    $("#menu-toggle").click(function(e) {
      e.preventDefault();
      $("#wrapper").toggleClass("toggled");
    });
  </script>
<script type="text/JavaScript" src="../../util/js/pergunta.js"></script>
</body>

</html>
