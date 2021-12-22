<?php session_start()?>
<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
<link href="../../util/css/cadastro.css" rel="stylesheet" type="text/css"/>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
<meta charset="UTF-8">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.0/jquery.mask.js"></script>
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<title>Redefinição de senha</title>
<script type="text/JavaScript" src="../../util/js/valida.js"></script>
</head>
<body class = "cadastro">
<form name="form42" method="post" action="../../models/login/RegistraSenha.php" onsubmit = "return validaSenha()">
<div class="Cadastro">
<div class="container theme-showcase" role="main">
 <center>
  <figure>
    <img width="100"src="../../util/image/logo.png">
  </figure>
  </center>
<p></p><h2><font color="#000099">Resgistre sua nova senha </font></h2><p></p> 
<div>
<?php 
if(isset($_SESSION['msg'])){
    echo $_SESSION['msg'];
    unset($_SESSION['msg']);
}
?>
</div>
<center>
    <div class="form-group col-md-4">
   <label for="campo8"><strong>Senha:</strong></label>
   <input name="senha" type="password" class="form-control" id="senha" placeholder="Senha" required>
    </div> 
    <div class="form-group col-md-4">
   <label for="campo9"><strong>Confirme a senha:</strong></label>
   <input name="senha1" type="password" class="form-control" id="senha1" placeholder="Confirme a Senha" required>
   </div>
</center>

<?php
if (!isset($_SESSION['autenticado']) || !$_SESSION['autenticado']){
    $_SESSION['msg'] = '<div class="alert alert-danger alert-dismissible fade show" role="alert"><strong>Para acessar o sistema você deve efetuar login</strong><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span>';
    header( "Location: ../../views/login/index.php");
}
?>

<div>
<input type="hidden" id="id" name="id" value="<?$_SESSION['id']?>">
</div>   
   <div id="msg"></div>
   <div class="col-md-12">
   <center>
   <input class="btn btn-primary" type="submit" name="submit" value="Enviar" onsubmit = "return valido()">
   <button type="reset" class="btn btn-danger" onclick="location. href= 'index.php'">Cancelar</button>
   </center>
   </div>  		
  </div>
  </div>
  </div>
</form>  	
</body>
</html>