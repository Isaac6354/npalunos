<?php
session_start();
include_once "../../Conectar.class.php";
class Usuario {
    
    public function confere($us,$se) {
        #Conecta no banco de dados
        $pass = md5($se);
        $con = npaluno::conectar();
        $stm = $con->prepare("select * from professor where cpf=? and senha=(?)");
        $stm->bindParam(1,$us);
        $stm->bindParam(2,$pass);
        $stm->execute();
        $dados = $stm->fetchAll(PDO::FETCH_ASSOC);
        if(count($dados) == 1)
        {
            return true;
        }
        else
        {
            return false;
        }
        
    }
    public function manter_logado ()
    {
        
        if (isset($_COOKIE["usuario_np"])){
            if ($_COOKIE["usuario_np"]!=""){
                $user =  base64_decode($_COOKIE["usuario_np"]);
                $con = npaluno::conectar();
                $stm = $con->prepare("select * from professor where cpf=?");
                $stm->bindParam(1,$user);
                $stm->execute();
                $dados = $stm->fetchAll(PDO::FETCH_ASSOC);
                if(count($dados) == 1)
                {
                    return true;
                }
                else
                {
                    $_SESSION['autenticado'] = false;
                    return false;
                }
            }
        }
    }
    
    public function liberado($cpf, $status)
    {
        $con = npaluno::conectar();
        $stm = $con->prepare("select * from professor where cpf = (?) and status = (?)");
        $stm->bindParam(1, $cpf);
        $stm->bindParam(2, $status);
        $stm->execute();
        $dados = $stm->fetchAll(PDO::FETCH_ASSOC);
        if(count($dados) == 1)
        {
            return true;
        }
        else
        {
            return false;
        }
    }
    public function atualizaAcesso($cpf)
    {
        $con = npaluno::conectar();
        $sql = "update professor set acesso = NOW() where cpf = (?)";
        $stm = $con->prepare($sql);
        $stm->bindParam(1, $cpf);
        $stm->execute(); 
    }
    public function dadosUsuario($cpf)
    {
        $con = npaluno::conectar();
        $stm = $con->prepare("select * from professor where cpf = (?)");
        $stm->bindParam(1, $cpf);
        $stm->execute();
        $dados = $stm->fetch(PDO::FETCH_ASSOC);
        if(count($dados) > 0)
        {
            $_SESSION['nome'] = $dados['nome'];
            $_SESSION['email'] = $dados['email'];
            return true;
        }
        else
        {
            return false;
        }
    }
    public function verificaAdmProf($cpf)
    {
        $con = npaluno::conectar();
        $stm = $con->prepare("select * from professor where cpf = (?) and admin = 1");
        $stm->bindParam(1, $cpf);
        $stm->execute();
        $dados = $stm->fetch(PDO::FETCH_ASSOC);
        if(count($dados) == 1)
        {
            return true;
        }
        else 
        {
            return false;
        }
    }
    public function GetContUsuarios()
    {
        $con = npaluno::conectar();
        $stm = $con->prepare("select count(*) from professor");
        $stm->execute();
        $dados = $stm->fetch(PDO::FETCH_ASSOC);
        return $dados;
    }
}
?>
