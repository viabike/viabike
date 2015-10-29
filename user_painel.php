<?php
include("conexao/conexao.php");
include("template/header.php");

echo '<h1 style="float: left; text-align: left">Editar Perfil</h1>
<a href="#"><button class="button" style="float: right;">Alterar senha</button></a></h1><br>';

$conexao = conectar();//Conexao com o banco de dados viabike_db

$user_buscador = $conexao -> prepare("SELECT * FROM usuario WHERE email = '".$_COOKIE['email']."'");//pegando todos os usuarios cadastrados

$user_buscador -> execute();//executando a query de uma maneira segura

$user = $user_buscador->fetchAll(PDO::FETCH_OBJ);?>

<?php foreach ($user as $usuario): ?>
			<!--
				FALTA AINDA UMA CONFIRMAÇÃO PARA NAO DESATIVAR POR ENGANO
			-->

			<form action="user_altera.php" method="POST">
				<input type="hidden" name="id_usuario" value="<?=$usuario->id_usuario?>">
				Nome:<input type="text" name="nome" class="input" value="<?=$usuario->nome?>" placeholder="Ex: Exemplo de Nome" required><br>
				E-mail:<input type="email" name="email" class="input" value="<?=$usuario->email?>" placeholder="Ex: ex@exemplo.com" required><br>
				<hr style="border:1px; padding:2px; margin-bottom:10px; border-radius:5px; background-color:rgba(204,204,204, 0.25);">
				Senha:<input type="password" name="senha" class="input" required><br>
				<a href="user_desativar.php" style="float: left;font-size:14px; line-height:65px; color:#535455;">Dasativar conta</button></a>
				<input type="submit" value="Alterar" class="button" style="float: right">
			</form>

<?php endforeach;
include("template/footer.php");
?>
