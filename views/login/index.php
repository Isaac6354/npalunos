<?php
session_start();
error_reporting(0);
include_once "../../models/login/Usuario.class.php";
$user = new usuario();
try {
    if($user->manter_logado() == true)
    {
        $_SESSION['autenticado'] = true;
        header('location: ../../models/login/validaUsuario.php');
        
    }
}
catch (Exception $e){
    $_SESSION['autenticado'] = false;
}
?>
<!doctype html>
<html lang="pt-br">
<head>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" ></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
<meta charset="UTF-8">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.0/jquery.mask.js"></script>
<meta name="viewport">
<link href="../../util/css/index.css" rel="stylesheet" type="text/css"/>
<title>NP Alunos</title>

</head>
<body>
<form action="../../models/login/login.php" method="post" id="loginform" class="form-horizontal" role="form">

<div>
<?php 
if(isset($_SESSION['msg'])){
    echo $_SESSION['msg'];
    unset($_SESSION['msg']);
}
?>
</div> 
    <div class="container login-container align-self-center">
            <div class="row">
                <div class="col-md-6 login-form-1">
                  <center>
  <figure>
    <img width="200"src="../../util/image/logo.png">
  </figure>
                        <div class="form-group">
                            <input id="login-username" type="text" class="form-control" name="usuario" autocomplete="off" onkeypress="$(this).mask('000.000.000-00')" value="" placeholder="CPF" required>
                        </div>
                        <div class="form-group">
                            <input  id="login-password" type="password" class="form-control" name="senha" placeholder="senha" required/>
                        </div>
                        <div class="col-sm-12 controls">
                                      <button type="submit" class="btn btn-success">Login  </button>
                         </div>
                         <p>
                         <p>
                                            <div class="form-group">
                            <a href= 'esqueciSenha.php'" class="ForgetPwd"><strong>Esqueceu a senha?</strong></a>
							<div><strong>Não tem usuário? </strong><a href="../../views/cadastro/cadastroProf.php"><strong>Cadastre-se.</strong></a></div>
							<div class="form-group form-check">
    							<input type="checkbox" class="form-check-input" id="exampleCheck1" name = "conectado" value = "1">
    							<label class="form-check-label" for="exampleCheck1"><strong> Memorizar o usuário neste computador</strong><br></label>
							</div>	
                        </div>
                    </form>
              </center> 
</body>
</html>
