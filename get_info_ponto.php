<?php
require_once("conexao/conexao.php");

$id_ponto = $_GET['id'];
$pdo = conectar();

$buscaPonto = $pdo -> prepare("SELECT * FROM ponto_interesse where id_ponto =$id_ponto");
//Executando a QUERY
$buscaPonto -> execute();
$linha = $buscaPonto->fetchAll(PDO::FETCH_OBJ);

foreach ($linha as $linhas):

 echo json_encode($linhas);

endforeach;
?>