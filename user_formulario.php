<!DOCTYPE html>
<html>
<head>
	<title>ViaBike.me</title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="admin/css/style.css">
	<link href='https://fonts.googleapis.com/css?family=Raleway' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
	<script src="https://maps.googleapis.com/maps/api/js"></script>
	<script src="//code.jquery.com/jquery-1.11.3.min.js"></script>
</head>
<body>
	<div id="wrapper">

		<div id="header">

			<a href="index.php"><img src="imagens/viabike2.png" alt="ViaBike.me" class="logo"></a>

			<div id="nav-header">
				<ul>
					<li><a href="equipe.php">EQUIPE</a></li>
					<li><a href="sobre.php">SOBRE</a></li>
					<li><a href="index.php">HOME</a></li>
				</ul>
			</div>
		</div>

		<div id="container">
			<div id="content">

				<CENTER>
				<div id='form_user'>
					<form action="user_confirmaCad.php" class="form_user1" method="POST" style="border-right: 1px solid #bdc3c7;">
						<h1>Cadastre-se</h1><br>
						Nome Completo:<input type="text" name="nome" class="form" placeholder="Ex: Exemplo de Nome" required><br>
						E-mail:<input type="email" name="email" class="form" placeholder="Ex: ex@exemplo.com" required><br>
						Senha:<input type="password" name="senha" class="form" required><br>
						Confirme sua senha:<input type="password" name="senha_confirma" class="form" required><br>
						<input type="submit" value="Cadastrar" class="button">
					</form>

					<form action="confirma_login.php" class="form_user2" method="POST">
						<h1>Entrar</h1><br>
						E-mail:<input type="email" name="email" class="form" placeholder="Ex: ex@exemplo.com" required><br>
						Senha:<input type="password" name="senha" class="form" required><br>
						<input type="submit" value="Entrar" class="button">
					</form>
				</div>
				</CENTER>

			</div>
		</div>
		<div id="footer">
			<center><p>&copy ViaBike.me - 2015 <br>Site em desenvolvimento</p></center>
		</div>
	</div>
</body>
</html>
