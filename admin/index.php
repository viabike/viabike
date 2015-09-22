<?php
include("template/header.php");
if(!adminLogado()){

if(isset($_COOKIE['username'])) {
		$login = $_COOKIE['username'];
	}
	else {
		$login = '';
	}
?>

<?php if($_SESSION['tipo'] = 'admin'){ ?>
<center>
<h1>Login Administrativo</h1><br>
<form method="POST" name="login" action="confirma_login.php">
	<input type="text"		name="username"		class="form"	placeholder="Nome de Usuário" required value="<?php echo $login; ?>"><br>
	<input type="password"	name="senha"		class="form"	placeholder="Senha" required><br>
	<input type="submit"	name="login"		class="button"	value="Entrar" required>
	<input type="checkbox"	name="conectado"	class="check"> Lembrar nome de usuário
</form>
</center>

<?php
	}else{
	header("location:consulta_pontos.php");
	}
}
	 include("template/footer.php");
?>
