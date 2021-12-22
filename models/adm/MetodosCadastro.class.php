<?php
session_start();
include_once "../../Conectar.class.php";
class InserirProf{
	public function novo($nome, $cpf, $email, $setor, $senha, $telefone, $status, $admin){
		try {
		    #Conecta no banco de dados
		    $con = npaluno::conectar();
			
		   #inserção de cadastro de professor
			$sql = "insert into professor (nome, cpf, email, cod_setor, senha, telefone, status, admin) values (?,?, ? ,?, ?, ?, ?, ?)";
			$stm = $con->prepare($sql);
			$stm->bindValue(1,$nome);
            $stm->bindValue(2,$cpf);
            $stm->bindValue(3,$email);
            $stm->bindValue(4,$setor);
            $stm->bindValue(5,md5($senha));
            $stm->bindValue(6,$telefone);
            $stm->bindValue(7, 0 );
            $stm->bindValue(8, 0 );
            $stm->execute();
		} catch (PDOException $p){
			throw new Exception ("Ocorreu um erro ao tentar salvar os dados: ". $p->getMessage());
		}
	}
	
	public function getSetor()
	{
	    $con = npaluno::conectar();
	    $sql = "select * from setor";
	    $stm = $con->prepare($sql);
	    if($stm->execute())
	    {	while($rs= $stm->fetch(PDO::FETCH_ASSOC))
	    { ?>
				<option value="<?php echo $rs['cod_setor'] ?>"><?php echo $rs['descricao'];?></option> <?php 
				mysqli_close($con);			
						}
        }
	}
	
	public function validaEmail($email){
	    $con = npaluno::conectar();
	    $stm = $con->prepare("select * from professor where email = (?)");
	    $stm->bindParam(1, $email);
	    $stm->execute();
	    $dados = $stm->fetchAll(PDO::FETCH_ASSOC);
	    
	    if(count($dados) > 0)
	    {
	       return false;
	        
	    }
	    else 
	    {
	        return true;
	    }
	    
	       
	}
	
	public function validaEmailEdicao($email, $cpf){
	    $con = npaluno::conectar();
	    $stm = $con->prepare("select * from professor where email = (?) and cpf <> (?)");
	    $stm->bindParam(1, $email);
	    $stm->bindParam(2, $cpf);
	    $stm->execute();
	    $dados = $stm->fetchAll(PDO::FETCH_ASSOC);
	    
	    if(count($dados) > 0)
	    {
	        return false;
	        
	    }
	    else
	    {
	        return true;
	    }
	    
	    
	}
	
	public function validaCpf($cpf){
	    $con = npaluno::conectar();
	    $stm = $con->prepare("select * from professor where cpf = (?)");
	    $stm->bindParam(1, $cpf);
	    $stm->execute();
	    $dados = $stm->fetchAll(PDO::FETCH_ASSOC);
	    
	    if(count($dados) > 0)
	    {
	        return false;       
	    }
	    else 
	    {
	        return true;
	    }
	    
	    
	}
	public function SalvarEdicaoCadastro ($nome, $cod_setor, $telefone, $email, $cpf)
	{
	    try {
	        #Conecta no banco de dados
	        $con = npaluno::conectar();
	        
	        #inserção de cadastro de professor
	        $sql = "update professor set nome = (?), cod_setor = (?), telefone = (?), email = (?) where cpf = (?)";
	        $stm = $con->prepare($sql);
	        $stm->bindParam(1,$nome);
	        $stm->bindParam(2,$cod_setor);
	        $stm->bindParam(3, $telefone);
	        $stm->bindParam(4, $email);
	        $stm->bindParam(5, $cpf);
	        $stm->execute();
	    } catch (PDOException $p){
	        throw new Exception ("Ocorreu um erro ao tentar salvar os dados: ". $p->getMessage());
	    }
	}
	
	public function ExcluirProfessor($cpf)
	{
	    #Conecta no banco de dados
	    $con = npaluno::conectar();
	    
	    #cria um backup do registro antes de apaga-lo
	    
	    $sql = "INSERT INTO professor_sda(cpf, cod_setor, nome, senha, status, email, admin, telefone)
select cpf, cod_setor, nome, senha, status, email, admin, telefone from professor where cpf = (?)";
	    $stm = $con->prepare($sql);
	    $stm->bindValue(1, $cpf);
	    $stm->execute();
	    
	    #Deleta chave cadastro de professor
	    $sql = "delete from professor where cpf = (?)";
	    $stm = $con->prepare($sql);
	    $stm->bindParam(1, $cpf);
	    $stm->execute();
	}
	
	public function AtivarProfessor($cpf)
	{
	    $con = npaluno::conectar();
	    #Alteração do status de 0 para 1
	    
	    $sql = "update professor set status = '1' where cpf = (?)";
	    $stm = $con->prepare($sql);
	    $stm->bindParam(1, $cpf);
	    $stm->execute(); 
	}
}
?>
 
