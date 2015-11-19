<?php
require_once("template/header.php");
?>
<form action="user_confirmaCad.php" class="form_user1" method="POST">
	<center><h1>Cadastre-se</h1></center><br>
	<span style="font-size: 2em">Nome Completo:</span><input type="text" name="nome" class="form" placeholder="Ex: Exemplo de Nome" required><br>
	<span style="font-size: 2em">E-mail:</span><input type="email" name="email" class="form" placeholder="Ex: ex@exemplo.com" required><br>
	<span style="font-size: 2em">Senha:</span><input type="password" name="senha" class="form" required><br>
	<span style="font-size: 2em">Confirme sua senha:</span><input type="password" name="senha_confirma" class="form" required><br>
	<a href="user_login.php" style="float: left; font-size:2em; line-height:65px; color:#535455;">Entrar</button></a>
	<input type="submit" value="Cadastrar" class="button" style="float:right">
</form>
<?php
require_once("template/footer.php");
?>
