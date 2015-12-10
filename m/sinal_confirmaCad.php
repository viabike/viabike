<?php
session_start();
require_once("../conexao/conexao.php");
$conexao = conectar();

// Pega o ID do usuário que está cadastrando o ponto
$email = $_SESSION['email'];
$buscaId = $conexao->prepare("SELECT id_usuario FROM usuario WHERE email = '".$email."'");
$buscaId->execute();
$linhaId = $buscaId->fetch(PDO::FETCH_ASSOC);
$id_usuario = $linhaId["id_usuario"];


//DADOS VINDOS DA PÁGINA SINAL_FORM_CADASTRO_PART2.PHP
$titulo = addslashes(trim($_POST['titulo']));
$categoria = addslashes(trim($_POST['categoria']));
$descricao = addslashes(trim($_POST['descricao']));
$longitude = addslashes(trim($_POST['longitude']));
$latitude = addslashes(trim($_POST['latitude']));
$fk_id_usuario = $id_usuario;
$data_public = date("Y-m-d");


$addsinal = $conexao->prepare("INSERT INTO sinalizacao (titulo, descricao, latitude, longitude, categoria, data_public, fk_id_usuario) values(:titulo, :descricao, :latitude, :longitude, :categoria, :data_public, :fk_id_usuario)");
$addsinal->bindValue(":titulo", $titulo);
$addsinal->bindValue(":descricao", $descricao);
$addsinal->bindValue(":latitude", $latitude);
$addsinal->bindValue(":longitude", $longitude);
$addsinal->bindValue(":categoria", $categoria);
$addsinal->bindValue(":data_public", $data_public);
$addsinal->bindValue(":fk_id_usuario", $fk_id_usuario);
$addsinal->execute();

$NovoSinal = $conexao->prepare("SELECT `id_sinal` FROM `sinalizacao` ORDER BY `id_sinal` DESC LIMIT 1");
$NovoSinal->execute();
foreach ($NovoSinal as $value) {
    $idNovoSinal = $value['id_sinal'];
}

if ($addsinal) {
    header("location: index.php?idns=$idNovoSinal&lat=$latitude&long=$longitude");
}
else {
    echo "Erro ao cadastrar ponto.";
}