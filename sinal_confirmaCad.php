<?php
require_once("conexao/conexao.php");

$titulo    = addslashes(trim($_POST['titulo']   ));
$categoria = addslashes(trim($_POST['categoria']));
$descricao = addslashes(trim($_POST['descricao']));
$longitude = addslashes(trim($_POST['longitude']));
$latitude  = addslashes(trim($_POST['latitude'] ));

$addsinal = $conexao -> prepare("INSERT sinalizacao (titulo, latitude, longitude, categoria, descricao) values(:titulo, :latitude, :longitude, :categoria, :descricao)");
$addsinal->bindValue(":titulo"    , $titulo   );
$addsinal->bindValue(":latitude"  , $latitude );
$addsinal->bindValue(":longitude" , $longitude);
$addsinal->bindValue(":categoria" , $categoria);
$addsinal->bindValue(":descricao" , $descricao);
$addsinal->execute();

if($addsinal) {
  echo "sinal add com sucesso";
  echo var_dump($addsinal);
}else {
  echo "faio";
}

 ?>
