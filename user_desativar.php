<?php
require_once("conexao/conexao.php");
require_once("verificaSessao.php");

$conexao = conectar();

$id_usuario = $_GET['id_usuario'];

$user_desativa = $conexao -> prepare("UPDATE usuario SET usuario_ativo = false WHERE id_usuario = :id_usuario");
$user_desativa -> bindValue(":id_usuario" , $id_usuario, PDO::PARAM_INT);
$user_desativa -> execute();

header("location:user_logout.php");
?>
