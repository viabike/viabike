<?php
session_start();
include("conexao/conexao.php");

$conexao = conectar();

$id_usuario = $_POST['id_usuario'];

//futuramente as verificações de e-mail para saber se já existe
$_SESSION['email'] = $_POST['email'];
$_SESSION['nome'] = strtoupper($_POST['nome']);
setcookie('email', $_POST['email'], time()+3600);

$user_alterar = $conexao -> prepare("UPDATE usuario set nome = :nome, email = :email ,senha = :senha where id_usuario = :id_usuario");
    $user_alterar -> bindValue(":nome"       , $_POST['nome']);
    $user_alterar -> bindValue(":email"    , $_POST['email']);
    $user_alterar -> bindValue(":senha"    , sha1(strtolower($_POST['senha'])));
    $user_alterar -> bindValue(":id_usuario" , $id_usuario);
$user_alterar -> execute();

header("location:index.php");
?>
