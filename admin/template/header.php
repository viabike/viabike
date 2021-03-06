<?php
ob_start();
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
	<script src="//code.jquery.com/jquery-1.11.3.min.js"></script>
	<script src="../js/bootstrap.js"></script>
</head>
<body>
	<!-- //var_dump($_SESSION); //mostrar se a sessão esta criada -->
	<div id="wrapper">

		<div id="header">

			<?php if(adminLogado()){ ?>
			<a href="consulta_pontos.php"><img src="../imagens/viabike2.png" alt="ViaBike.me" class="logo" width="150px"></a>
			<?php }else{ ?>
			<a href="index.php"><img src="../imagens/viabike2.png" alt="ViaBike.me" class="logo" width="150px"></a>
			<?php } ?>

			<?php if(adminLogado()){ ?>
				<div id="nav-header">
					<ul>
						<li><a href="logout.php">SAIR</a></li>
						<!-- <li><a href="logout.php"><?=$_SESSION['username']; ?></a></li> -->
						<li><a href="consulta_pontos.php">PRINCIPAL</a></li>
					</ul>
				</div>
			<?php } ?>
		</div>

		<div id="container">
		<div id="content">
