<?php
include_once("template/header.php");
?>
<center>
	<form action="confirma_login.php" class="form_user2" method="POST">
		<h1>Entrar</h1><br>
		<span style="font-size: 2em">E-mail:</span><input type="email" name="email" class="form" placeholder="Ex: ex@exemplo.com" required><br>
		<span style="font-size: 2em">Senha:</span><input type="password" name="senha" class="form" required><br>
		<a href="user_cadastro.php" style="float: left; font-size:2em; line-height:65px; color:#535455;">Cadastre-se</button></a>
		<input type="submit" value="Entrar" class="button" style="float:right">
	</form>
</center>
<?php
include_once("template/footer.php");
?>
