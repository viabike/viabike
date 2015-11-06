<?php
session_start();
include("conexao/conexao.php");

$conexao = conectar();

$id_usuario = $_POST['id_usuario'];

if($_FILES["foto"]["error"] == 0){
	$ext = substr($_FILES["foto"]["name"],
						strpos(strrev($_FILES["foto"]["name"]),".")*-1);

	$foto = md5(time().$_FILES["foto"]["name"]).".".$ext;
	if($ext == 'png' or $ext == 'jpg' or $ext == 'jpeg' or $ext == 'PNG' or $ext == 'JPG' or $ext == 'JPEG'){
		if($_POST['foto_velha'] != "nouser.png"){
			unlink('imagens/users/'.$_POST['foto_velha']);
		}else{}
		move_uploaded_file($_FILES["foto"]["tmp_name"], "imagens/users/".$foto);
	}else{
		$foto =  $_POST['foto_velha'];
	}
}else{
	$foto =  $_POST['foto_velha'];
}

//futuramente as verificações de e-mail para saber se já existe
$_SESSION['email'] = $_POST['email'];
$_SESSION['nome'] = strtoupper($_POST['nome']);
setcookie('email', $_POST['email'], time()+3600);

$user_alterar = $conexao -> prepare("UPDATE usuario set nome = :nome, email = :email, foto = :foto where id_usuario = :id_usuario");
    $user_alterar -> bindValue(":nome"       , $_POST['nome']);
    $user_alterar -> bindValue(":email"      , $_POST['email']);
    $user_alterar -> bindValue(":foto"       , $foto);
    $user_alterar -> bindValue(":id_usuario" , $id_usuario);
$user_alterar -> execute();

header("location:index.php");
?>
