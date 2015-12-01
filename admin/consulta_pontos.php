<?php
require_once("template/header.php");
require_once("verificaAdmin.php");
?>
<h1 style="text-align: left">Consultar Pontos de Interesse
<a href="insere_ponto.php"><button class="button">Cadastrar</button></a></h1><br>
<?php
require_once("../conexao/conexao.php");
// =======================================================================
if (array_key_exists("removido", $_GET) && $_GET['removido'] == 'true'){ ?>
	<div class="alert alert-success alert-dismissable" role="alert"><strong><?=$_GET['name']?></strong> removido com sucesso!
	<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>
<?php
}

if ((array_key_exists("altera", $_GET) && $_GET['altera'] == 'true') and (array_key_exists("ant", $_GET))){ ?>
	<div class="alert alert-success alert-dismissable" role="alert"><strong><?=$_GET['ant']?></strong> foi alterado para
		<strong><?=$_GET['name']?></strong> com sucesso!
	<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>
<?php
}else if(array_key_exists("altera", $_GET) && $_GET['altera'] == 'true'){ ?>
	<div class="alert alert-success alert-dismissable" role="alert"> <strong><?=$_GET['name']?></strong> foi alterado para
		 com sucesso!
	<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>
<?php
 }

if (array_key_exists("cadponto", $_GET) && $_GET['cadponto'] == 'true'){ ?>
	<div class="alert alert-success alert-dismissable" role="alert"><strong><?=$_GET['name']?></strong> cadastrado com sucesso!
	<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>
<?php
}

// SELECIONA TODOS OS REGISTROS DO BANCO VIABIKE_DB
$pdo = conectar();
$buscaPonto = $pdo -> prepare("SELECT * FROM ponto_interesse order by id_ponto desc");
//Executando a QUERY
$buscaPonto -> execute();
//  FIM DA SELEÇÃO
?>

<?php
$linha = $buscaPonto->fetchAll(PDO::FETCH_OBJ);?>

<table border = '1' width='980px' cellspacing = '0' cellpadding = '0' class = 'tabela' style = 'background:white; border-color:#ddd'>
	<tr class="border-tr">
		<th class="border-esq">Nome</th>
		<th>Telefone</th>
		<th>Categoria</th>
		<th>Alterar</th>
		<th class="border-dir">Remover</th>
	</tr>

<?php foreach ($linha as $linhas):?>
		<tr align="center" class="border-tr">
			<td><?=$linhas->nome;?></td>
			<td><?=$linhas->telefone;?></td>
			<td><?=$linhas->categoria;?></td>
			<td>
				<a href="altera_ponto.php?id_ponto=<?php echo $linhas->id_ponto;?>"><i class="fa fa-pencil font-icon"></i></a>
			</td>

			<td>
			<!--
				CÓDIGO NAO FUNCIONAL, PROVAVELMENTE ERRO NA FUNÇÃO.

				<script>
					// function remove(id)
					// {
						// var remover = confirm('Deseja realmente remover este ponto?');
						// if (remover)
						// {
							// document.location.href = "delete_ponto.php?id_ponto=" + id;
						// }
						// else
						// {
							// alert('Remoção cancelada.');
						// }
					// }
				</script>
				<a onClick="remove(<?php echo $linhas->id_ponto;?>);"><i class="fa fa-times font-icon"></i></a>
				-->
				<a href="delete_ponto.php?id_ponto=<?=$linhas->id_ponto;?>&name=<?=$linhas->nome?>"><i class="fa fa-times font-icon"></i></a>
			</td>
		</tr>
<?php
endforeach;
?>
</table>
<?php

/*while($linha=$buscaPonto -> fetch(PDO::FETCH_ASSOC)){
	echo $linha['nome']."<br>";
}*/
?>
<?php
require_once("template/footer.php");
?>
