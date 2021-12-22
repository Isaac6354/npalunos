function validaSenha (){
	var se = document.getElementById("senha").value;
	var re = document.getElementById("senha1").value;
	if (se!=re)
	{ 
		//window.alert("Senhas diferentes");
		document.getElementById("msg").innerHTML= '<div class="alert alert-danger alert-dismissible fade show" role="alert"> <strong>Senha e confirmação de senha encontram-se divergentes!</strong> <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span>'
		document.getElementById("senha").focus();
		return false;
	}
	else{
	return true;	
	}
}
function validaSenhaAtual (){
	var se = document.getElementById("senhaAtual").value;
	var re = document.getElementById("senha").value;
	if (se!=re)
	{ 
		return true;
	}
	else{
		//window.alert("Senhas diferentes");
		document.getElementById("msg").innerHTML= '<div class="alert alert-danger alert-dismissible fade show" role="alert"> <strong>Senha atual não pode ser igual a nova senha!</strong> <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span>'
		document.getElementById("senha").focus();
		return false;
	}
}

function confirmacao() {
    var resposta = confirm("Deseja remover esse registro?");

    if (resposta == false) {
         window.location.href = "Professores.php";
    }
}
function confirmacaoE() {
   var resposta = confirm("Deseja editar esse registro?");

   if (resposta == false) {
        window.location.href = "Professores.php";
   }
}
function confirmacaoQuest() {
    var resposta = confirm("Deseja remover esse registro?");

    if (resposta == false) {
         window.location.href = "questionario.php";
    }
}
function encerrarQuest() {
    var resposta = confirm("Deseja encerrar este questionario ?");

    if (resposta == false) {
         window.location.href = "questionario.php";
    }
}




$(document).ready(function () { 
    var $seuCampoCpf = $("#CPF");
    $seuCampoCpf.mask('000.000.000-00', {reverse: true});
});

function senha(){
	

var senha = document.getElementById("senha").value;
var regex = /^(?=(?:.*?[A-Z]){3})(?=(?:.*?[0-9]){2})(?=(?:.*?[!@#$%*()_+^&}{:;?.]){1})(?!.*\s)[0-9a-zA-Z!@#$%;*(){}_+^&]*$/; 

if(senha.length < 6)
{
	document.getElementById("msg").innerHTML="<div class='alert alert-danger col-sm-12'>A senha deve conter no minímo 6 digitos!</div>";
    document.getElementById("senha").focus();
    return false;
}
else(!regex.exec(senha))
{	
	document.getElementById("msg").innerHTML="<div class='alert alert-danger col-sm-12'>A senha deve conter no mínimo 3 caracteres em maiúsculo, 2 números e 1 caractere especial!</div>";
    document.getElementById("senha").focus();
    return false;
}

function funcao1()
{
var x;
var r=confirm("Deseja excluir o cadastro deste usuário?");
if (r==true)
  {
		
  }
else
  {
		x="Você pressionou Cancelar!";
  }
}

