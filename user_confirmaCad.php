<?php
include_once("conexao/conexao.php");

$conexao = conectar();//Funcão de conexão com o banco de dados viabike_db

$nome      = addslashes(trim($_POST["nome"   ]));//requisição vinda do arquivo user_formulario.php
$apelido   = addslashes(trim($_POST["apelido"]));//requisição vinda do arquivo user_formulario.php
$senha     = sha1(strtolower($_POST['senha'  ]));//requisição vinda do arquivo user_formulario.php

$user_conf = $conexao->prepare("INSERT INTO usuario (nome, apelido, senha) VALUES (:nome, :apelido, :senha)");
  $user_conf->bindValue(":nome"     , $nome     , PDO::PARAM_STR);
  $user_conf->bindValue(":apelido"  , $apelido  , PDO::PARAM_STR);
  $user_conf->bindValue(":senha"    , $senha    , PDO::PARAM_STR);
$user_conf->execute();

if($user_conf) {
  // header("location: user_login.php"); die();
}

?>
