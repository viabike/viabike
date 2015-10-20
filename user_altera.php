<?php
include("conexao/conexao.php");

$conexao = conectar();

$id_usuario = $_POST['id_usuario'];

$user_alterar = $conexao -> prepare("UPDATE usuario set nome = :nome, apelido = :apelido where id_usuario = :id_usuario");
    $user_alterar -> bindValue(":nome"       , $_POST['nome']);
    $user_alterar -> bindValue(":apelido"    , $_POST['apelido']);
    $user_alterar -> bindValue(":id_usuario" , $id_usuario);
$user_alterar -> execute();

?>
