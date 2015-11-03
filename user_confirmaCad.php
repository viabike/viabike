<?php
include_once("conexao/conexao.php");

$conexao = conectar();//Funcão de conexão com o banco de dados viabike_db

$nome      = addslashes(trim($_POST["nome"   ]));//requisição vinda do arquivo user_formulario.php
$email   = addslashes(trim($_POST["email"]));//requisição vinda do arquivo user_formulario.php
$senha     = sha1(strtolower($_POST['senha'  ]));//requisição vinda do arquivo user_formulario.php

$user_verif = $conexao->prepare("SELECT * FROM usuario WHERE email = :email");
$user_verif -> bindValue(":email", $email);
$user_verif -> execute();
$num_rows = $user_verif->fetchColumn();

if($num_rows == 1)
{
	echo "Usuário já cadastrado!";
}
else
{
	$user_conf = $conexao->prepare("INSERT INTO usuario (nome, email, senha, tipo_usuario, usuario_ativo) VALUES (:nome, :email, :senha, :tipo_usuario, :usuario_ativo)");
	$user_conf->bindValue(":nome", $nome, PDO::PARAM_STR);
	$user_conf->bindValue(":email", $email, PDO::PARAM_STR);
	$user_conf->bindValue(":senha", $senha, PDO::PARAM_STR);
	$user_conf->bindValue(":tipo_usuario", 'u', PDO::PARAM_STR);
	$user_conf->bindValue(":usuario_ativo", true, PDO::PARAM_STR);
	$user_conf->execute();

  header("location: user_sucesso_cadastro.php");
}



//========================================


?>
