<?php
session_start();
require_once("../conexao/conexao.php");
$conexao = conectar();

$email = $_POST['email'];

$consulta = $conexao->query("SELECT email FROM usuario WHERE email = '$email'");

while ($linha = $consulta->fetch(PDO::FETCH_OBJ)) {
	$emailb= $linha->email;
}

if ($email == $emailb)
	echo 1;
else
	echo 0;
