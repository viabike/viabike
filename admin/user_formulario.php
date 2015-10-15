<?php include("template/header.php");?>
	<CENTER>
	<div id='form_user'>
		<form action="confirma_ponto.php" class="form_login" method="POST">
			<h1>Cadastre-se</h1><br>
			Nome Completo:<input type="text" name="nome" class="form"><br>
			Apelido:<input type="text" name="apelido" class="form"><br>
			Senha:<input type="text" name="email" class="form"><br>
			<input type="submit" value="Cadastrar" class="button">
		</form>
		<form action="confirma_ponto.php" class="form_cadastro" method="POST">
			<h1>Entrar</h1><br>
			Apelido:<input type="text" name="nome_usuario" class="form"><br>
			Senha:<input type="password" name="senha" class="form"><br>
			<input type="submit" value="Entrar" class="button">
		</form>
	</div>
	</CENTER>
<?php include("template/footer.php");?>
