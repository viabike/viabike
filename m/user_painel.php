<?php
include("../conexao/conexao.php");
include("template/header.php");

$conexao = conectar();//Conexao com o banco de dados viabike_db

$user_buscador = $conexao -> prepare("SELECT * FROM usuario WHERE email = '".$_COOKIE['email']."'");//pegando todos os usuarios cadastrados

$user_buscador -> execute();//executando a query de uma maneira segura

$user = $user_buscador->fetchAll(PDO::FETCH_OBJ);?>

<?php foreach ($user as $usuario): ?>
			<!-- 
				FALTA AINDA UMA CONFIRMAÇÃO PARA NAO DESATIVAR POR ENGANO
			-->
			Nome: <?=$usuario->nome?>
			<br>
			Email: <?=$usuario->email?>
		
			<form action="user_desativar.php" method="post">
				<input type="hidden" name="id_usuario" value="<?=$usuario->id_usuario?>">
				<input class="button" type="submit" value="Desativar Conta">
			</form>
			
			<br>
			
			<form action="user_altera_form.php" method="post">
				<input type="hidden" name="id_usuario" value="<?=$usuario->id_usuario?>">
				<input class="button" type="submit" value="Alterar">
			</form>
		
<?php endforeach;
include("template/footer.php");
?>
