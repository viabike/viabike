<?php
session_start();
include("funcoes/funcoes.php");
?>
<!DOCTYPE html>
<html>
<head>
	<title>ViaBike.me</title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<link href='https://fonts.googleapis.com/css?family=Raleway' rel='stylesheet' type='text/css'>
	<script src="https://maps.googleapis.com/maps/api/js"></script>
	<link href="http://netdna.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">
</head>
<body>
	<!-- //var_dump($_SESSION); //mostrar se a sessão esta criada -->
	<div id="wrapper">

		<div id="header">

			<a href="consulta_pontos.php"><img src="../imagens/viabike2.png" alt="ViaBike.me" class="logo" width="150px"></a>

			<?php if(adminLogado()){ ?>
				<div id="nav-header">
					<ul>
						<li><a href="logout.php">SAIR</a></li>
						<!-- <li><a href="logout.php"><?=$_SESSION['username']; ?></a></li> -->
						<li><a href="insere_ponto.php">CADASTRAR</a></li>
						<li><a href="consulta_pontos.php">CONSULTAR</a></li>
					</ul>
				</div>
			<?php } ?>
		</div>

		<div id="container">
		<div id="content">
