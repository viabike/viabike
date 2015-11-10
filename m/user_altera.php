<?php

// Dados vindo da página user_painel.php
session_start();
include("../conexao/conexao.php");

$conexao = conectar();

$id_usuario = $_POST['id_usuario'];
$senha = sha1(strtolower($_POST['senha']));

if ($_FILES["foto"]["error"] == 0)
{
    $ext = substr($_FILES["foto"]["name"], strpos(strrev($_FILES["foto"]["name"]), ".") * -1);

    $foto = md5(time() . $_FILES["foto"]["name"]) . "." . $ext;
    if ($ext == 'png' or $ext == 'jpg' or $ext == 'jpeg' or $ext == 'PNG' or $ext == 'JPG' or $ext == 'JPEG')
    {
        if ($_POST['foto_velha'] != "nouser.png")
        {
            unlink('imagens/users/' . $_POST['foto_velha']);
        }
        move_uploaded_file($_FILES["foto"]["tmp_name"], "imagens/users/" . $foto);
    }
    else
    {
        $foto = $_POST['foto_velha'];
    }
}
else
{
    $foto = $_POST['foto_velha'];
}

//futuramente as verificações de e-mail para saber se já existe
$_SESSION['email'] = $_POST['email'];
$_SESSION['nome'] = strtoupper($_POST['nome']);
setcookie('email', $_POST['email'], time() + 3600);

// consulta o banco e pega a senha armazenada
$consulta = $conexao->query("SELECT senha FROM usuario WHERE id_usuario = '" . $id_usuario . "'");

while ($linha = $consulta->fetch(PDO::FETCH_OBJ))
{
    $senhab = $linha->senha;
}

// se a senha estiver correta altera os dados
if ($senha == $senhab)
{
    $user_alterar = $conexao->prepare("UPDATE usuario SET nome = :nome, email = :email, foto = :foto WHERE id_usuario = :id_usuario");
    $user_alterar->bindValue(":nome", $_POST['nome']);
    $user_alterar->bindValue(":email", $_POST['email']);
    $user_alterar->bindValue(":foto", $foto);
    $user_alterar->bindValue(":id_usuario", $id_usuario);

    $user_alterar->execute();
}
else
{
    header("location: user_painel_error.php");
    die();
}

header("location:index.php");
?>
