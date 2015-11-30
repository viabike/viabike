<?php

function conectar ()
{
    $host = "localhost";
    $dbn = "admvb_viabike_db"; //NOME DO BANCO
    $user = "root"; //USUARIO DO BANCO
    $pass = ""; //SENHA DO USUARIO DO  BANCO

    $conexao = new PDO("mysql:dbname=$dbn; host=$host", $user, $pass);

    return $conexao;
}

conectar();

if (!conectar()) {
    echo "Erro ao tentar conectar com o banco.";
}

/*
  LEMBRETE EM TODAS AS PAGINAS QUE HOUVER CONEXÃO COM O BANCO DE DADOS USAR:
  require_once('conexao/conexao.php');
  SE FOR PARTE ADMINISTRATIVA LEMBAR DE COLOCAR UM NÍVEL ACIMA:
  require_once('../conexao/conexao.php');
 */
?>
