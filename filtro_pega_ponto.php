<?php

// NAO TERMINADO
require_once("conexao/conexao.php");
$conexao = conectar();


$filtro_ponto = $_POST['filtro_ponto'];

$consulta = $conexao->prepare("SELECT * FROM ponto_interesse WHERE categoria = :filtro_ponto");
    $consulta->bindValue(":filtro_ponto" , $filtro_ponto);
    $consulta->execute();

$linha = $consulta->fetch(PDO::FETCH_OBJ);

foreach ($linhe as $linhas){
    echo json_encode($linhas);
}
