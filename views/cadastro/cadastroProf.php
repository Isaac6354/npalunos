<?php
session_start();
error_reporting(0);
include_once '../../models/adm/MetodosCadastro.class.php';
	?>
<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"> </script>
<meta charset="UTF-8">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.0/jquery.mask.js"></script>
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<link href="../../util/css/cadastro.css" rel="stylesheet" type="text/css"/>
<title>Cadastro de Professores</title>
<script type="text/JavaScript" src="../../util/js/valida.js"></script>
</head>
<body class = "cadastro">
<form name="form1" method="post" action="../../models/cadastro/cadastro.php" onsubmit = "return validaSenha()">
<div class="Cadastro">
<div class="container theme-showcase" role="main">
 <center>
  <figure>
    <img width="90"src="../../util/image/logo.png">
  </figure>
  </center>
<p></p><h3><font color="#000099">Cadastro de Professores: </font></h3><p></p> 
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
   <label for="campo1"><strong>Nome:</strong></label>
   <input name="nome" type="text" class="form-control" id="nome" placeholder="Digite o seu nome" required>
 </div>
 <div class="form-group col-md-6">
   <label for="campo2"><strong>CPF:</strong></label>
   <input type="text" class="form-control cpf-mask" placeholder="Ex.: 000.000.000-00" id="cpf" name = "cpf" autocomplete="off" onkeypress="$(this).mask('000.000.000-00')" required>
  </div>
  <div class="form-group col-md-6">
   <label for="campo222"><strong>Setor:</strong></label>
 <select id="setor" class="form-control" name = "setor" required>
        <option selected>Selecione o Setor</option>
         <?php	
        try {
                $setor = new InserirProf();
                $setor->getSetor();
            }
			catch (PDOException $erro) {
			    echo "Erro: ".$erro->getMessage();
			}
					?>
</select>
</div>	        
  <div class="form-group col-md-6">
   <label for="campo29"><strong>Telefone:</strong></label>
   <input name="telefone" type="text" class="form-control phone-ddd-mask" placeholder="(00) 00000-0000" autocomplete="off"  id="telefone" onkeypress="$(this).mask('(00) 0000-00009')" required>
 </div>
 <div class="form-group col-md-12">
   <label for="campo3"><strong>E-mail:</strong></label>
   <input name="email" type="email" class="form-control" id="email" placeholder="Digite o seu Email" required>
 </div>
    <div class="form-group col-md-6">
   <label for="campo8"><strong>Senha:</strong></label>
  <div id="erroSenhaForca"></div> 
   <input type="password" class="form-control" name="senha" id="senha" placeholder="Senha" required onkeyup="validarSenhaForca()"><br><br>
	<script src ="senhaPersonalizada.js"></script>
    </div> 
    <div class="form-group col-md-6">
   <label for="campo9"><strong>Confirme a senha:</strong></label>
   <input name="senha1" type="password" class="form-control" id="senha1" placeholder="Confirme a Senha" required>
   </div>
   <div id="msg"></div>
   <div class="col-md-12">
   <center>
   <input class="btn btn-primary" type="submit" name="submit" onclick="validaSenha(); senha()" value="Salvar">

   <button type="reset" class="btn btn-danger" onclick="location. href= '../login/index.php'">Cancelar</button>
   						</center>
   					</div>  		
  				</div>
  			</div>
	  </div>
	</form>  
</body>
</html>