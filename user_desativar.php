<?php
include("conexao/conexao.php");

$conexao = conectar();

$id_usuario = $_POST['id_usuario'];

//========================= QUERY DELETE =========================
$user_desativa = $conexao -> prepare("DELETE FROM usuario where id_usuario = :id_usuario");
  $user_desativa -> bindValue(":id_usuario" , $id_usuario, PDO::PARAM_INT);
$user_desativa -> execute();

header("location:user_painel.php"); die();
?>
