<?php
session_start();
?>

<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
<link href="../../util/css/cadastro.css" rel="stylesheet" type="text/css"/>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" ></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
<meta charset="UTF-8">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.0/jquery.mask.js"></script><meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<title>Esqueci Minha senha?</title>
<script type = "text/javascript" src = "jquery/jquery-3.3.1.min.js"></script>
</head>
<body>
<form name="form1" method="post" action="../../models/login/envio.php">
<div class="Cadastro">
<div class="container theme-showcase" role="main">
 <center>
  <figure>
    <img width="200"src="../../util/image/logo.png">
  </figure>
  </center>
<p></p><h5><font color="#000099">Insira os dados para confirmação e envio do E-mail</font></h5><p></p> 
<div>
<?php 
if(isset($_SESSION['msg'])){
    echo $_SESSION['msg'];
    unset($_SESSION['msg']);
}
?>
</div>

	<div class="row">
 <div class="form-group col-md-6">
   <label for="campo2"><strong>CPF:</strong></label>
 <input type="text" class="form-control cpf-mask" placeholder="Ex.: 000.000.000-00" id="cpf" name = "cpf" autocomplete="off" onkeypress="$(this).mask('000.000.000-00')" required></div>
 		<div class="form-group col-md-6">
   			<label for="campo3"><strong>E-mail:</strong></label>
   			<input name="email" type="email" class="form-control" id="email" placeholder="Digite o seu Email" required>
 		</div>		
  	</div>
</div>
</div>
   		<div class="form-group col-md-12">
    		<center>
   				<input class="btn btn-primary" type="submit" name="submit" value="Enviar"">
   				<button type="reset" class="btn btn-danger" onclick="location. href= 'index.php'">Cancelar</button>
   			</center>
   		</div>  
</form>  	
</body>
</html>