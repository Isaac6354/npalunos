<?php
	session_start();
	include_once '../../Conectar.class.php';
?>
<!DOCTYPE html>
<html lang="pt-br">
	<head>
		<meta charset="utf-8">
		<title>Pesquisa</title>
	<head>
	<body>
		<?php
		// Definimos o nome do arquivo que será exportado
		$arquivo = 'Professores.xls';
		
		// Criamos uma tabela HTML com o formato da planilha
		$html = '';
		$html .= '<table border="1">';
		$html .= '<tr>';
		$html .= '<td colspan="4">Planilha Lista dos Professores</tr>';
		$html .= '</tr>';
		$html .= '<tr>';
		$html .= '<td><b>Nome</b></td>';
		$html .= '<td><b>CPF</b></td>';
		$html .= '<td><b>Setor</b></td>';
		$html .= '<td><b>Acesso</b></td>';
		$html .= '</tr>';
		
		//Selecionar todos os itens da tabela 
		$con = npaluno::conectar();
		$stm = $con->prepare("SELECT P.nome,P.cpf,P.acesso, S.descricao FROM professor P INNER JOIN setor S ON P.cod_setor = S.cod_setor");
		$stm->execute();
		$stm->execute();
		$dados = $stm->fetch(PDO::FETCH_ASSOC);
		if($dados > 0)
		{
		    while ($row= $stm->fetch(PDO::FETCH_ASSOC))
		    {
		          $html .= '<tr>';
		          $html .= '<td>'.$row["nome"].'</td>';
		          $html .= '<td>'.$row["cpf"].'</td>';
		          $html .= '<td>'.$row["descricao"].'</td>';
		          $data = date('d/m/Y H:i:s',strtotime($row["acesso"]));
		          $html .= '<td>'.$data.'</td>';
		          $html .= '</tr>';
		    }
		}
		
		
		// Configurações header para forçar o download
		header ("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
		header ("Last-Modified: " . gmdate("D,d M YH:i:s") . " GMT");
		header ("Cache-Control: no-cache, must-revalidate");
		header ("Pragma: no-cache");
		header ("Content-type: application/x-msexcel");
		header ("Content-Disposition: attachment; filename=\"{$arquivo}\"" );
		header ("Content-Description: PHP Generated Data" );
		// Envia o conteúdo do arquivo
		echo $html;
		 ?>
	</body>
</html>