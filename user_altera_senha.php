<?php

session_start();
require_once("conexao/conexao.php");
require_once("verificaSessao.php");

$conexao = conectar();

$nova_senha = sha1(strtolower($_POST['nova_senha']));
$conf_senha = sha1(strtolower($_POST['conf_senha']));
$email = $_SESSION['email'];

if ($nova_senha == $conf_senha) {
    $user_senha = $conexao->prepare("UPDATE usuario set senha = :nova_senha WHERE email = :email");
    $user_senha->bindValue(":nova_senha", $nova_senha);
    $user_senha->bindValue(":email", $email);
    // executando a QUERY
    $user_senha->execute();
    header("location: user_logout.php");
}
else {
    echo "Erro ao alterar.";
}
