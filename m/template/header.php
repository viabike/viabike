<?php
session_start();
require_once("../conexao/conexao.php");
include_once("funcoes/funcoes.php");

//  SELECIONA TODOS OS REGISTROS DE PONTOS DE INTERESSE DO BANCO VIABIKE_DB
$pdo = conectar();
$buscaPonto = $pdo -> prepare("SELECT * FROM ponto_interesse");
//Executando a QUERY
$buscaPonto -> execute();
// FIM DA SELEÇÃO 

$linha = $buscaPonto->fetchAll(PDO::FETCH_OBJ);
 ?>
<!DOCTYPE html>
<html>
    <head>
        <title>Viabike.me</title>
        <meta charset="UTF-8">
        <link rel="stylesheet" type="text/css" href="css/style.css">
        <script src="http://code.jquery.com/jquery-1.11.3.min.js"></script>
		<link href='https://fonts.googleapis.com/css?family=Raleway' rel='stylesheet' type='text/css'>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
		<script src="https://maps.googleapis.com/maps/api/js"></script>
        <script src="js/script.js"></script>
    </head>
    <body>
        <div id="wrapper">
            <div id="header">
                <div id="logo">
                    <a href="index.php"><img src="imagens/viabike2.png" alt="ViaBike.me logo" style="width:100%;"></a>
                </div>
                <div id="nav">
                    <i class="fa fa-bars fa-5x icon-menu"></i>
                </div>
            </div>
  
           <div id="menu">
                <ul>
					<?php 
					if(userLogado())
					{
						echo "
						<li><a href='user_painel.php'>".$_SESSION['nome']."</a><a href='user_logout.php'>SAIR</a></li>";
					} 
					?>
						<li><a href="equipe.php">EQUIPE</a></li>
						<li><a href="sobre.php">SOBRE</a></li>
					<?php 
					if(!userLogado())
					{
						echo '<li><a href="user_login.php">LOGIN</a></li>';
					} 
					?>
				</ul>
            </div>
			
		</div>

			<div id="container">