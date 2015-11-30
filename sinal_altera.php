<?php

require_once("conexao/conexao.php");
$conexao = conectar();

$alteraSinal = $conexao->prepare("UPDATE sinalizacao SET titulo = :titulo, categoria = :categoria, descricao = :descricao, longitude = :longitude, latitude = :latitude, data_public = :data_public WHERE id_sinal = :id_sinal");
$alteraSinal->bindValue(":titulo", $_POST['titulo']);
$alteraSinal->bindValue(":categoria", $_POST['categoria']);
$alteraSinal->bindValue(":descricao", $_POST['descricao']);
$alteraSinal->bindValue(":longitude", $_POST['longitude']);
$alteraSinal->bindValue(":latitude", $_POST['latitude']);
$alteraSinal->bindValue(":data_public", $_POST['data_public']);
$alteraSinal->bindValue(":id_sinal", $_POST['id_sinal']);
$alteraSinal->execute();

if ($alteraSinal) {
    echo "Alteração realizada com sucesso";
}
else {
    echo "oops";
}

