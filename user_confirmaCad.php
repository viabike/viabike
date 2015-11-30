<?php

$user_conf = $conexao->prepare("INSERT INTO usuario (nome, email, senha, tipo_usuario, usuario_ativo) VALUES (:nome, :email, :senha, :tipo_usuario, :usuario_ativo)");
$user_conf->bindValue(":nome", $nome, PDO::PARAM_STR);
$user_conf->bindValue(":email", $email, PDO::PARAM_STR);
$user_conf->bindValue(":senha", $senhaC, PDO::PARAM_STR);
$user_conf->bindValue(":tipo_usuario", 'u', PDO::PARAM_STR);
$user_conf->bindValue(":usuario_ativo", true, PDO::PARAM_BOOL);
$user_conf->execute();

header("location: user_sucesso_cadastro.php");

?>