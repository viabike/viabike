<?php
ob_start();
include("template/header.php");
if(adminLogado()){
	header("location:consulta_pontos.php");
	exit();
}else{
	if(isset($_COOKIE['username'])) {
		$login = $_COOKIE['username'];
	}
	else {
		$login = '';
	}
	
	echo"
	<center>
	<h1>Login Administrativo</h1><br>
	<form method='POST' name='login' action='confirma_login.php'>
		<input type='text'		name='username'		class='form'	placeholder='Nome de Usuário' required value=$login><br>
		<input type='password'	name='senha'		class='form'	placeholder='Senha' required><br>
		<input type='submit'	name='login'		class='button'	value='Entrar' required>
		<input type='checkbox'	name='conectado'	class='check'> Lembrar nome de usuário
	</form>
	</center>
	";
}
include("template/footer.php");
?>