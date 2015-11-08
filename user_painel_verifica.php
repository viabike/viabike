<?php
session_start();
include("conexao/conexao.php");
$conexao = conectar();

$id_usuario = $_POST['id_usuario'];
$senha = sha1($_POST['senha']);

$consulta = $conexao->query("SELECT senha FROM usuario WHERE id_usuario = '".$id_usuario."'");

while ($linha = $consulta->fetch(PDO::FETCH_OBJ)) {
	$senhab = $linha->senha;
}

if ($senha == $senhab)
	echo 1;
else
	echo 0;
?>