<?php
include("../conexao/conexao.php");
include("template/header.php");

$conexao = conectar();

$id_usuario = $_POST['id_usuario']; //Requisição vinda da pag user_consulta...OBS: mudar para painel do usuario

//preparando a query
$user_buscador = $conexao -> prepare("SELECT * from usuario where id_usuario = :id_usuario");
    $user_buscador -> bindValue(":id_usuario" , $id_usuario);
$user_buscador -> execute();
//executando a query

//associando todos os objetos
$user = $user_buscador->fetchAll(PDO::FETCH_OBJ);

foreach ($user as $usuario) :?>
<form class="" action="user_altera.php" method="post">
    <input type="hidden" name="id_usuario" value="<?=$usuario->id_usuario?>">
    Nome completo:<input type="text" name="nome" class="form" value="<?=$usuario->nome?>"><br>
    E-mail:<input type="email" name="email" class="form" value="<?=$usuario->email?>"><br>
    senha:<input type="password" name="senha" class="form" value="">
    <input type="submit" name="name" class="button" value="alterar">
</form>
<?php endforeach; ?>
