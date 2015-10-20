<?php
include("conexao/conexao.php");

$conexao = conectar();

$id_usuario = $_POST['id_usuario'];

$user_alterar = $conexao -> prepare("UPDATE usuario set nome = :nome, username = :username where id_usuario = :id_usuario");
    $user_alterar -> bindValue(":nome"       , $_POST['nome']);
    $user_alterar -> bindValue(":username"    , $_POST['username']);
    $user_alterar -> bindValue(":id_usuario" , $id_usuario);
$user_alterar -> execute();

?>
