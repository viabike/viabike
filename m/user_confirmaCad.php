<?php

require_once("../conexao/conexao.php");

$conexao = conectar(); //Funcão de conexão com o banco de dados viabike_db

$nome = addslashes(trim($_POST["nome"])); //requisição vinda do arquivo user_formulario.php
$email = addslashes(trim($_POST["email"])); //requisição vinda do arquivo user_formulario.php
$senha = sha1(strtolower($_POST['senha'])); //requisição vinda do arquivo user_formulario.php

$user_verif = $conexao->prepare("SELECT * from usuario where email = :email");
$user_verif->bindValue(":email", $email);
$user_verif->execute();
$num_rows = $user_verif->fetchColumn();

if ($num_rows == 1) {
    echo "Usuário já cadastrado!";
}
else {
    $user_conf = $conexao->prepare("INSERT INTO usuario (nome, email, senha, tipo_usuario, usuario_ativo, foto) VALUES (:nome, :email, :senha, :tipo_usuario, :usuario_ativo, :foto)");
    $user_conf->bindValue(":nome", $nome, PDO::PARAM_STR);
    $user_conf->bindValue(":email", $email, PDO::PARAM_STR);
    $user_conf->bindValue(":senha", $senha, PDO::PARAM_STR);
    $user_conf->bindValue(":tipo_usuario", 'u', PDO::PARAM_STR);
    $user_conf->bindValue(":usuario_ativo", true, PDO::PARAM_BOOL);
    $user_conf->bindValue(":foto", 'nouser.png', PDO::PARAM_STR);
    $user_conf->execute();

    $_SESSION['email'] = $email;
    $_SESSION['nome'] = strtoupper($nome);
    $_SESSION['tipo'] = 'user';

    setcookie('email', $email, time() + 3600);
    header("location: user_painel.php");
}
