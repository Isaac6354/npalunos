<?php
session_start();
include_once "../../Conectar.class.php";
class professor
{
    public function inserirQuest($titulo, $publico_alvo, $validade, $aviso_resposta, $professor, $inicio, $publicar)
    {
        #Conecta no banco de dados
        $con = npaluno::conectar();
        
        #inserção de cadastro de professor
        $sql = "INSERT INTO questionario(titulo, publico_alvo, validade, aviso_resposta, professor, inicio, publicar, ativo) VALUES (?,?,?,?,?,?,?,?)";
        $stm = $con->prepare($sql);
        $stm->bindValue(1,$titulo);
        $stm->bindValue(2,$publico_alvo);
        $stm->bindValue(3,$validade);
        $stm->bindValue(4, $aviso_resposta);
        $stm->bindValue(5, $professor);
        $stm->bindValue(6, $inicio );
        $stm->bindValue(7, $publicar );
        $stm->bindValue(8, 1 );
        $stm->execute();
    }
    
    public function inserirPergunta($questionario, $pergunta, $tipo)
    {
        #Conecta no banco de dados
        $con = npaluno::conectar();
        
        #inserção de cadastro de professor
        $sql = "INSERT INTO pergunta( id_tipo_pergunta, codigo, desc_pergunta) VALUES (?,?,?);";
        $stm = $con->prepare($sql);
        $stm->bindValue(1,$tipo);
        $stm->bindValue(2,$questionario);
        $stm->bindValue(3,$pergunta);
        if($stm->execute())
        {
            return true;
        }
        else 
        {
            return false;
        }
    }
    
    public function getPerguntasQuestoes($quest) 
    {
        $con = npaluno::conectar();
        $stm = $con->prepare("select * from pergunta where codigo = (?) ");
        $stm->bindParam(1, $quest);
        if($stm->execute())
        {   
            $rows =$stm-> fetch(PDO::FETCH_ASSOC);
            $con = npaluno::conectar();
            $stm = $con->prepare("select * from opcoes_resposta where id_pergunta = (?) ");
            $stm->bindParam(1, $rows['id_pergunta']);
            $rs= $stm->fetch(PDO::FETCH_ASSOC);
            while($rows['id_pergunta'] > 0)
            {    
                
                while ($rs['id_opcoes_resposta'] > 0)
                {
                    
                }
            }
        }
    }
    
    public function inserirOpcoes($opcao, $pergunta)
    {
        #Conecta no banco de dados
        $con = npaluno::conectar();
        $sql = "INSERT INTO opcoes_resposta(id_pergunta, desc_opcoes_resposta) VALUES (?,?);";
        $stm = $con->prepare($sql);
        $stm->bindValue(1,$pergunta);
        $stm->bindValue(2,$opcao);
        $stm->execute();
    }
    public function getUltimPerg($quest)
    {
        $con = npaluno::conectar();
        $stm = $con->prepare("SELECT max(id_pergunta) FROM pergunta WHERE codigo = (?)");
        $stm->bindParam(1, $quest);
        $stm->execute();
        $dados = $stm->fetch(PDO::FETCH_ASSOC);
        return $dados["max(id_pergunta)"];
    }
    
    
    public function editarQuest($titulo, $publico_alvo, $validade, $aviso_resposta, $inicio, $codigo)
    {
        try{
            #Conecta no banco de dados
            $con = npaluno::conectar();
            
            #inserção de cadastro de professor
            $sql = "update questionario set titulo = (?), publico_alvo = (?), validade = (?), aviso_resposta = (?), inicio = (?) where codigo = (?)";
            $stm = $con->prepare($sql);
            $stm->bindValue(1,$titulo);
            $stm->bindValue(2,$publico_alvo);
            $stm->bindValue(3,$validade);
            $stm->bindValue(4, $aviso_resposta);
            $stm->bindValue(5, $inicio );
            $stm->bindValue(6, $codigo );
            $stm->execute();
        } catch (PDOException $p){
            throw new Exception ("Ocorreu um erro ao tentar salvar os dados: ". $p->getMessage());
        }
    }
    
    
    
    public function getUltimQuest($cpf)
    {
        $con = npaluno::conectar();
        $stm = $con->prepare("SELECT max(codigo) FROM questionario WHERE professor = (?)");
        $stm->bindParam(1, $cpf);
        $stm->execute();
        $dados = $stm->fetch(PDO::FETCH_ASSOC);
        return $dados["max(codigo)"];
    }

    public function getQuestionarioAtivo($cpf)
    {
        $con = npaluno::conectar();
        $stm = $con->prepare("select * from questionario where ativo = 1 and professor = (?)");
        $stm->bindParam(1, $cpf);
        if($stm->execute())
        {
            while ($rs= $stm->fetch(PDO::FETCH_ASSOC))
            {
                ?>						<tr>
              			<td><?php echo $rs['codigo'];?> </td>
                    	<td> <?php echo $rs['titulo']; ?> </td>
                    	<td><?php echo date('d/m/Y',strtotime($rs['inicio'])); ?></td>
                    	<td><?php echo date('d/m/Y',strtotime($rs['validade'])); ?></td>
                    	<td><?php if ($rs['publicar'] == '0'){ echo 'Encerrado';} else{echo 'Ativo';}?></td>
                    	<td> <div>
                    	<button class = "btn btn-primary btn-sm" onclick="location. href= 'addPergunta.php?&ida=<?php echo $rs['codigo'];?>'">Adicionar Pergunta</button>
                    	<button class = "btn btn-info btn-sm" onclick="location. href= '../../views/professor/editarQuestionario.php?&codigo=<?php echo $rs['codigo'];?>&titulo=<?php echo $rs['titulo'];?>&publico_alvo=<?php echo $rs['publico_alvo'];?>&inicio=<?php echo $rs['inicio'];?>&validade=<?php echo $rs['validade']?>&aviso_resposta=<?php echo $rs['aviso_resposta']?>'">Editar</button>
                    	<?php if ($rs['publicar'] == 1)
                    	{?>
                    		<button class = "btn btn-success btn-sm" disabled onclick="location. href= '../../models/professor/ativarQuest.php?&ida=<?php echo $rs['codigo'];?>'">Publicar</button>
               				
               			<?php 
                    	}
               			else{
               			    ?>
               			    <button class = "btn btn-success btn-sm" onclick="location. href= '../../models/professor/ativarQuest.php?&ida=<?php echo $rs['codigo'];?>'">Publicar</button>
               			  <?php }?>
                    	<?php if ($rs['publicar'] == 0)
                    	{?>
                    		<button class = "btn btn-secondary btn-sm" disabled onclick="location. href= '../../models/professor/encerrarQuest.php?&ida=<?php echo $rs['codigo']?>'; return encerrarQuest()">Encerrar</button>
               			
               			<?php 
                    	}
               			else{
               			    ?>
               			    <button class = "btn btn-secondary btn-sm" onclick="location. href= '../../models/professor/encerrarQuest.php?&ida=<?php echo $rs['codigo']?>'; return encerrarQuest()">Encerrar</button>
               			  <?php }?>      
               			<button class = "btn btn-danger btn-sm" onclick="location. href= '../../models/professor/excluirQuestionario.php?&ida=<?php echo $rs['codigo']?>'; return confirmacaoQuest()">Exluir</button>
               			</div>
               		</td>
               	</tr>
               	
          		<?php                
            }
         }  
        
    }
    public function excluirQuest($codigo)
    {
        $con = npaluno::conectar();
        #Deleta chave cadastro de professor
        $sql = "update questionario set ativo = 0 where codigo = (?)";
        $stm = $con->prepare($sql);
        $stm->bindParam(1, $codigo);
        $stm->execute();
    }
    public function encerrarQuest($codigo)
    {
        $con = npaluno::conectar();
        #Deleta chave cadastro de professor
        $sql = "update questionario set publicar = 0 where codigo = (?)";
        $stm = $con->prepare($sql);
        $stm->bindParam(1, $codigo);
        $stm->execute();
    }
    public function ativarQuest($codigo)
    {
        $con = npaluno::conectar();
        #Deleta chave cadastro de professor
        $sql = "update questionario set publicar = 1 where codigo = (?)";
        $stm = $con->prepare($sql);
        $stm->bindParam(1, $codigo);
        $stm->execute();
    }
}