<?php
include("conexao/conexao.php");

$conexao = conectar();

$user_altera = $conexao -> prepare("UPDATE usuario set nome = :nome, apelido = :apelido, senha = :senha WHERE id_usuario = :id_usuario");
  $user_altera -> bindValue(":nome" , $nome      );
  $user_altera -> bindValue(":apelido" , $apelido);
  $user_altera -> bindValue(":senha" , $senha    );
$user_altera -> execute();

?>
