<?php 
if (!isset($_SESSION) || !$_SESSION)
{
    session_start();
}
use PHPMailer\PHPMailer\PHPMailer;
include_once '../../Conectar.class.php';


Class Senha
{
    public function CpfEmail($email, $cpf)
    {
        $con = npaluno::conectar();
        $stm = $con->prepare("select * from professor where email = (?) and cpf = (?)");
        $stm->bindParam(1, $email);
        $stm->bindParam(2, $cpf);
        $stm->execute();
        $dados = $stm->fetchAll(PDO::FETCH_ASSOC);
        if(count($dados) == 1)
        {
            return true;
        }
        else
        {
            $_SESSION['msg'] = '<div class="alert alert-danger alert-dismissible fade show" role="alert"><strong>Dados Inválidos! CPF ou E-mail não encontra-se cadastrados no sistema.</strong><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span>';
            header('location: ../../views/login/esqueciSenha.php');
            
        }
        
    }

public function EnviaEmail($email, $assunto, $corpo)
{  TRY{
    
    include_once '../PHPMailer/src/PHPMailer.php';
    include_once '../PHPMailer/src/SMTP.php';
    
    $erro = true;
    
    $Mailer = new PHPMailer();
    $Mailer->charset = "utf8";
    $Mailer->SMTPDebug = 0;
    $Mailer->isSMTP();
    $Mailer-> Host = "smtp-mail.outlook.com";
    $Mailer-> SMTPAuth = true;
    $Mailer-> Username = "fredericossouza@hotmail.com";
    $Mailer-> Password = "frd1ss36369898";
    $Mailer-> SMTPSecure = "tls";
    $Mailer-> Port =    587;
    $Mailer-> FromName = "NP Alunos";
    $Mailer-> From = "fredericossouza@hotmail.com";
    $Mailer-> addAddress($email);
    $Mailer-> isHTML(true);
    $Mailer-> Subject = $assunto;
    $Mailer-> Body= $corpo;
    if($Mailer-> send())
    {
        return true;
        $erro = false;
    } 
}
catch (PDOException $p){
    return false;
    
    }
}

public function geraSenha($string) : string
{
    return md5(uniqid(time()));;
}

public function validaID($id)
{
    $con = npaluno::conectar();
    $stm = $con->prepare("select * from esqueci_senha where id = (?) and data >= NOW()");
    $stm->bindParam(1, $id);
    $stm->execute();
    $dados = $stm->fetchAll(PDO::FETCH_ASSOC);
    if(count($dados) == 1)
    {
        return true;
    }
    else
    {      
        $_SESSION['autenticado'] = false;
        $_SESSION['msg'] = '<div class="alert alert-danger alert-dismissible fade show" role="alert"><strong>Sua solicitação de redefinição de senha expirou ou não foi encontrada. Por gentileza solicite uma nova senha!</strong><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span>';
        header('location: ../../views/login/index.php');   
    }
}

public function SalvaNovaSenha($id, $email)
{
    try {
        #Conecta no banco de dados
        $con = npaluno::conectar();
        
        #inserção de cadastro de professor
        $sql = "insert into esqueci_senha(id, email, data) values (?,?, NOW()  + INTERVAL 1 DAY)";
        $stm = $con->prepare($sql);
        $stm->bindValue(1,$id);
        $stm->bindValue(2,$email);
        $stm->execute();
    } catch (PDOException $p){
        $_SESSION['msg'] = '<div class="alert alert-danger alert-dismissible fade show" role="alert"><strong>Ocorreu uma incoformidade. Tente novamente mais tarde!</strong><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span>';
        header('location: ../../views/login/index.php');   
    }
}
public function SalvaID($senha, $id)
{
        #Conecta no banco de dados
        $con = npaluno::conectar();
        
        #Altera a senha do professor
        $sql = "update professor a set senha = (?) where a.email in (select email from esqueci_Senha b where a.email = b.email and b.id = '$id')";
        $stm = $con->prepare($sql);
        $senha1 = md5($senha);
        $stm->bindParam(1, $senha1);
        $stm->execute();                  

}
public function deletaID($id)
{
    #Conecta no banco de dados
    $con = npaluno::conectar();
    
    #Deleta chave ID de recuperação de senha
    $sql = "delete from esqueci_senha where id = (?)";
    $stm = $con->prepare($sql);
    $stm->bindParam(1, $id);
    $stm->execute();
    
}
public function ValidaSenhaAtual($senha, $cpf)
{
    $senha1 = md5($senha);
    $con = npaluno::conectar();
    $stm = $con->prepare("select * from professor where senha = (?) and cpf = (?)");
    $stm->bindParam(1, $senha1);
    $stm->bindParam(2, $cpf);
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

public function AlteraSenha($senha, $usuario)
{   
    $senha1 = md5($senha);
    #Conecta no banco de dados
    $con = npaluno::conectar();
    #Altera a senha do professor
    $sql = "update professor a set senha = (?) where cpf = (?)";
    $stm = $con->prepare($sql);
    $stm->bindParam(1, $senha1);
    $stm->bindParam(2, $usuario);
    $stm->execute();
    
}


}

?>