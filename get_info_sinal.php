<?php
require_once("conexao/conexao.php");

$id_sinal = $_GET['id'];
$pdo = conectar();

$buscaPonto = $pdo -> prepare("SELECT * FROM sinalizacao WHERE id_sinal = $id_sinal");

$buscaPonto -> execute();
$linha = $buscaPonto->fetchAll(PDO::FETCH_OBJ);

$linhas = $linha[0];

echo json_encode($linhas);
