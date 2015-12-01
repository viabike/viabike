<?php
require_once("../conexao/conexao.php");
$pdo = conectar();
$id = $_GET['id_ponto']; //ESTA REQUISIÇÃO VEM DA PAGINA consulta_pontos.php
$nome = $_GET['name'];

$removePonto = $pdo -> prepare("DELETE from ponto_interesse WHERE id_ponto = :id_ponto");
	$removePonto -> bindValue(":id_ponto", $id , PDO::PARAM_INT);
	$removePonto -> execute();

if ($removePonto) {
	header("location:consulta_pontos.php?removido=true&name=$nome");
}
else {
	alert("erro");
}
?>
