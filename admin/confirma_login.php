<?php
session_start();
require_once("../conexao/conexao.php");
// dados vindos da página index
$user	=	$_POST['email'];
$senha	=	sha1(strtolower($_POST['senha']));
$conexao = conectar();
//cria as vários com dados do banco
$userb;
$senhab;
$tipob;
//pega os dados do banco
$consulta = $conexao->query('SELECT email, senha, tipo_usuario FROM usuario where id_usuario = 1');
while	($linha = $consulta->fetch(PDO::FETCH_OBJ)){
	// dados vindos do banco, por isso o "b"
	$userb	= $linha->email;
	$senhab	= $linha->senha;
	$tipob	= $linha->tipo_usuario;
}
if ($user == $userb AND $senha == $senhab AND $tipob == "a") {// verifica se usuário, senha estão corretos e se ele é administrador
	if (count($consulta) > 0) {
		$_SESSION['email'] = $userb;
		$_SESSION['tipo'] = 'admin';
		if(isset($_POST['conectado'])){
			setcookie('admin_email', $userb, time()+3600);
		}
		else{
			setcookie('admin_email');
		}
		header("location:consulta_pontos.php");
	}
	else {
		header("location:index.php");
	}
}
else {
	header("location:admin_erro_login.php");
}
?>
