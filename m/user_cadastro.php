<!DOCTYPE html>

<html>
    <head>
        <title>Viabike.me</title>
        <meta charset="UTF-8">
        <link rel="stylesheet" type="text/css" href="css/style.css">
        <script src="http://code.jquery.com/jquery-1.11.3.min.js"></script>
		    <link href='https://fonts.googleapis.com/css?family=Raleway' rel='stylesheet' type='text/css'>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
        <script src="js/script.js"></script>
    </head>
    <body>
        <div id="wrapper">
            <div id="header">
                <div id="logo">
                    <a href="index.php"><img src="imagens/viabike2.png" alt="ViaBike.me logo" style="width:100%;"></a>
                </div>
                <div id="nav">
                    <img src="imagens/menu-icon.png" alt="Menu" style="width: 100px;">
                </div>
            </div>
            <div id="menu">
                <ul>
                    <li><a href="index.php">HOME</a></li>
                    <li><a href="sobre.php">SOBRE</a></li>
                    <li><a href="equipe.php">EQUIPE</a></li>
                </ul>
            </div>
			
			<div id="container">
				<div id="content">
					<center
					<div id='form_user'>
					<form action="user_confirmaCad.php" class="form_user1" method="POST">
						<h1>Cadastre-se</h1><br>
						Nome Completo:<input type="text" name="nome" class="form" placeholder="Ex: Exemplo de Nome" required><br>
						E-mail:<input type="email" name="email" class="form" placeholder="Ex: ex@exemplo.com" required><br>
						Senha:<input type="password" name="senha" class="form" required><br>
						Confirme sua senha:<input type="password" name="senha_confirma" class="form" required><br>
						<a href="user_login.php" style="float: left; font-size:28px; line-height:65px; color:#535455;">Entrar</button></a>
						<input type="submit" value="Cadastrar" class="button">
					</form>
					</center>
				
				</div>
			</div>
<?php
include("template/footer.php");
?>
</body>
</html>
