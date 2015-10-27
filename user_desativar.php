<?php
include("conexao/conexao.php");

$conexao = conectar();

$id_usuario = $_POST['id_usuario'];

$user_desativa = $conexao -> prepare("UPDATE `viabike_db`.`usuario` SET `usuario_ativo` = false WHERE `usuario`.`id_usuario` = $id_usuario;");
$user_desativa -> bindValue(":id_usuario" , $id_usuario, PDO::PARAM_INT);
$user_desativa -> execute();

header("location:user_painel.php"); die();
?>
