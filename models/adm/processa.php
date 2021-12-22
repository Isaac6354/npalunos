<?php
session_start();
include_once '../../Conectar.class.php';
class pesquisa{
  
    public function tabelaProfessores()
    {
        $con = npaluno::conectar();
        $sql= "SELECT a.cpf, a.cod_setor, a.nome, a.senha, a.status, a.email, a.admin, a.telefone, a.acesso, b.descricao FROM professor a, setor b where a.cod_setor = b.cod_setor";
        $stm = $con->prepare($sql);
        $stm->execute();
        $dados = $stm->fetch(PDO::FETCH_ASSOC);
        if($dados > 0)
        {
            while ($rs= $stm->fetch(PDO::FETCH_ASSOC))           
                {
?>						<tr>
              			<td><?php echo $rs['nome'];?> </td>
                    	<td> <?php echo $rs['email']; ?> </td>
                    	<td><?php echo $rs['cpf'] ?></td>
                    	<td><?php echo $rs['descricao'] ?></td>
                    	<td><?php if($rs['acesso'] == 0){ echo 'Pendente';} else{echo date('d/m/Y H:i:s',strtotime($rs['acesso']));} ?></td>
                    	<td> <div>
                    	<button class = "btn btn-primary btn-sm" onclick="location. href= '../../views/adm/editarCadastro.php?&nome=<?php echo $rs['nome']?>&ida=<?php echo $rs['cpf']?>&email=<?php echo $rs['email']?>&telefone=<?php echo $rs['telefone']?>&setor=<?php echo $rs['descricao']?>&cod_setor=<?php echo $rs['cod_setor']?>' ; return confirmacaoE()">Editar</button>
						<button class = "btn btn-danger btn-sm" onclick="location. href= '../../models/adm/excluirCadastro.php?&ida=<?php echo $rs['cpf']?>'; return confirmacao()">Exluir</button></div></td>
               	</tr>
               	
          		<?php
                }
         }       
    }
    
    public function PesquisaProfessoresInativos()
    {
            $con = npaluno::conectar();
            $sql= "SELECT a.*, b.descricao FROM professor a, setor b where a.cod_setor = b.cod_setor and status = 0 order by nome";
            $stm = $con->prepare($sql);
            if($stm->execute())
            {
                while ($rs= $stm->fetch(PDO::FETCH_ASSOC))
                {
                    ?>						<tr>
              			<td><?php echo $rs['nome'];?> </td>
                    	<td> <?php echo $rs['email']; ?> </td>
                    	<td><?php echo $rs['cpf'] ?></td>
                    	<td><?php echo $rs['descricao']; ?></td>
                    	<td><button class = "btn btn-primary btn-sm" onclick="location. href= '../../models/adm/ativarCadastro.php?&ida=<?php echo $rs['cpf'];?>&email=<?php echo $rs['email'];?>'">Ativar</button>
               	</tr>
          		<?php   
                }
         }
   
    }
    public function pesquisaProfessores($cpf, $nome, $setor)
    {
        $con = npaluno::conectar();
        $stm = $con->prepare("SELECT P.nome,P.cpf, P.email, P.acesso,S.descricao FROM professor P 
        INNER JOIN setor S ON P.cod_setor = S.cod_setor
        WHERE cpf LIKE '%".$cpf."%' && nome LIKE '%".$nome."%' && descricao LIKE '%".$setor."%' order by P.nome");
        if($stm->execute())
        {   while($rs= $stm->fetch(PDO::FETCH_ASSOC))
            {
                ?>
            	<tr>
            			<td><?php echo $rs['nome'];?> </td>
                    	<td> <?php echo $rs['email']; ?> </td>
                    	<td><?php echo $rs['cpf'] ;?></td>
                    	<td><?php echo $rs['descricao']; ?></td>
                    	<td><?php if($rs['acesso'] == 0){ echo 'Pendente';} else{echo date('d/m/Y H:i:s',strtotime($rs['acesso']));} ?></td>
                    	<td> <div>
                    	<button class = "btn btn-primary btn-sm" onclick="location. href= '../../models/adm/editarCadastro.php?&nome=<?php echo $rs['nome']?>&ida=<?php echo $rs['cpf']?>&email=<?php echo $rs['email']?>&telefone=<?php echo $rs['telefone']?>&setor=<?php echo $rs['descricao']?>&cod_setor=<?php echo $rs['cod_setor']?>'; return confirmacaoE()">Editar</button>
						<button class = "btn btn-danger btn-sm" onclick="location. href= '../../models/adm/excluirCadastro.php?&ida=<?php echo $rs['cpf']?>'; return confirmacao()">Exluir</button></div></td>
               	</tr><?php 
        	}
        }
        else
        {
            echo"Desculpe nenhum registro foi encontrado!";
        }
    }
    
    public function PesquisaProfessoresInativosBalao()
    {
        $con = npaluno::conectar();
        $sql= "SELECT count(cpf) as num_rows FROM professor where status = 0";
        $stm = $con->prepare($sql);
        
        $stm->execute();
        
        $num_rows = $stm->fetchColumn();
        echo "Professores inativos: ".$num_rows;
        
    }
    
    
}
    ?>