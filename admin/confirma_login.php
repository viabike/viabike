<?php
session_start();
include("../conexao/conexao.php");

// dados vindos da página index
$user	=	$_POST['username'];
$senha	=	sha1(strtolower($_POST['senha']));

$conexao = conectar();

//cria as vários com dados do banco
$userb;
$senhab;
$tipob;

//pega os dados do banco
$consulta = $conexao->query('SELECT username, senha, tipo_usuario FROM usuario');
while	($linha = $consulta->fetch(PDO::FETCH_OBJ)){
	// dados vindos do banco, por isso o "b"
	$userb	= $linha->username;
	$senhab	= $linha->senha;
	$tipob	= $linha->tipo_usuario;
}

if ($user == $userb AND $senha == $senhab AND $tipob == "a") {// verifica se usuário, senha estão corretos e se ele é administrador

	if (count($consulta) > 0) {
		$_SESSION['username'] = $userb;
		$_SESSION['tipo'] = 'admin';

		if(isset($_POST['conectado'])){
			setcookie('username', $userb, time()+3600);
		}
		else{
			setcookie('username');
		}

		header("location:consulta_pontos.php");
	}
	else {
		header("location:index.php");
	}
}
else {
	header("location:erro_login.php");
}
?>
