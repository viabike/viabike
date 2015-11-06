<?php
include_once("template/header.php");
?>
<div id="container">
	<div id="content">
		<center>
			<form action="confirma_login.php" class="form_user2" method="POST">
				<h1>Entrar</h1><br>
				E-mail:<input type="email" name="email" class="form" placeholder="Ex: ex@exemplo.com" required><br>
				Senha:<input type="password" name="senha" class="form" required><br>
				<a href="user_cadastro.php" style="float: left; font-size:22px; line-height:65px; color:#535455;">Cadastre-se</button></a>
				<input type="submit" value="Entrar" class="button">
			</form>
		</div>
		</center>
	</div>
<?php
include_once("template/footer.php");
?>
