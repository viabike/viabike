<?php
ob_start();
include("template/header.php");
if(adminLogado()){
	header("location:consulta_pontos.php");
	exit();
}else{
	if(isset($_COOKIE['admin_email'])) {
		$login = $_COOKIE['admin_email'];
	}
	else{
		$login = '';
	}

	echo"
	<center>
	<h1>Login Administrativo</h1><br>
	<form method='POST' name='login' action='confirma_login.php'>
		<input type='text'		name='email' placeholder='Ex: ex@exemplo.com' class='form' value='$login' required><br>
		<input type='password'	name='senha'	class='form' required><br>
		<input type='submit'	name='login'		class='button'	value='Entrar'>
		<input type='checkbox'	name='conectado'	class='check'> Lembrar nome de usuário
	</form>
	</center>
	";
}
include("template/footer.php");
?>
