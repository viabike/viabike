<?php

require_once("conexao/conexao.php");
$conexao = conectar();

$filtro_sinal = $_GET['filtro_sinal'];

if ($filtro_sinal == "TODOS") {
    $consulta = $conexao->query("SELECT * FROM sinalizacao");
}
else {
    $consulta = $conexao->query("SELECT * FROM sinalizacao WHERE categoria = '" . $filtro_sinal . "'");
}


$linha = $consulta->fetchAll(PDO::FETCH_OBJ);


echo json_encode($linha);
