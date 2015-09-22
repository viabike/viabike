<?php
function conectar() {
	$conexao = new PDO("mysql:host=localhost;dbname=viabike_db", "root", ""); 
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