<?php

require_once("../conexao/conexao.php");
$conexao = conectar();


$filtro_ponto = $_GET['filtro_ponto'];


if ($filtro_ponto == "TODOS") {
    $consulta = $conexao->query("SELECT * FROM ponto_interesse");
}
else {
    $consulta = $conexao->query("SELECT * FROM ponto_interesse WHERE categoria = '" . $filtro_ponto . "'");
}

$linha = $consulta->fetchAll(PDO::FETCH_OBJ);


echo json_encode($linha);

