<?php

// NAO TERMINADO
require_once("conexao/conexao.php");
$conexao = conectar();


$filtro_ponto = $_POST['filtro_ponto'];

$consulta = $conexao->query("SELECT * FROM ponto_interesse WHERE categoria = '".$filtro_ponto."'");

$valores = array();
while ($linha = $consulta->fetch(PDO::FETCH_OBJ)) {
	 $valores[] = $linha->categoria;
};

