<?php
include("conexao/conexao.php");

$conexao = conectar();

$id_usuario = $_POST['id_usuario']; //Requisição vinda da pag user consulta...OBS: mudar para painel do usuario

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
    nome completo:<input type="text" name="nome" value="<?=$usuario->nome?>"><br>
    apelido:<input type="text" name="apelido" value="<?=$usuario->apelido?>"><br>
    <input type="submit" name="name" value="alterar">
</form>
<?php endforeach; ?>
