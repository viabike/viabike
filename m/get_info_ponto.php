<?php
require_once("../conexao/conexao.php");

$id_ponto = $_GET['id'];
$pdo = conectar();

$buscaPonto = $pdo -> prepare("SELECT * FROM ponto_interesse where id_ponto = $id_ponto");
$buscaPonto -> execute();

$linha = $buscaPonto->fetchAll(PDO::FETCH_OBJ);
$linhas = $linha[0];

echo json_encode($linhas);