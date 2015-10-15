<?php
function conectar() {
  $host = "localhost";
  $dbn  = "admvb_viabike_db";
  $user = "admvb_adminvb";
  $pass = "3web15";

	$conexao = new PDO("mysql:dbname=$dbn; host=$host", $user, $pass);
	return $conexao;
}

conectar();

if (!conectar()) {
	echo "Erro ao tentar conectar com o banco.";
}

/*
	LEMBRETE EM TODAS AS PAGINAS QUE HOUVER CONEXÃO COM O BANCO DE DADOS USAR:
	require_once('conexao/conexao.php');
	SE FOR PARTE ADMINISTRATIVA LEMBAR DE COLOCAR UM NÍVEL ACIMA:
	require_once('../conexao/conexao.php');
	*/
?>
