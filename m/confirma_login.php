<?php
session_start();
require_once("../conexao/conexao.php");

// dados vindos da página index
$user	=	$_POST['email'];
$senha	=	sha1(strtolower($_POST['senha']));

$conexao = conectar();

//cria as vários com dados do banco
$nomeb;
$userb;
$senhab;
$tipob;

//pega os dados do banco
$consulta = $conexao->query("SELECT nome, email, senha, tipo_usuario FROM usuario where email = '".$user."'");
while	($linha = $consulta->fetch(PDO::FETCH_OBJ)){
	// dados vindos do banco, por isso o "b"
	$nomeb	= $linha->nome;
	$userb	= $linha->email;
	$senhab	= $linha->senha;
	$tipob	= $linha->tipo_usuario;
}

if($user == $userb AND $senha == $senhab AND $tipob == "u"){// verifica se usuário, senha estão corretos e se ele é administrador

	if (count($consulta) > 0) {
		$_SESSION['email'] = $user;
		$_SESSION['nome'] = strtoupper($nomeb);
		$_SESSION['tipo'] = 'user';

		setcookie('email', $user, time()+3600);

		header("location:index.php");

	}else{
		 header("location:index.php");
	}
}else{
 	header("location:erro_login.php");
}
?>
