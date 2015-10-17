<?php
include("conexao/conexao.php");

$conexao = conectar();
$id_usuario = addslashes(trim($_POST['id_usuario']));

$user_altera = $conexao ->prepare("SELECT * FROM usuario where id_usuario =".$id_usuario);
$user_altera -> execute();

$user = $user_altera->fetchAll(PDO::FETCH_OBJ);

foreach($user as $usuario) :
?>
<form action="user_altera.php" method="post">
    <input type="hodden" name="id_usuario" value="<?=$usuario->id_usuario?>">
    nome:<input type="text" name="nome" value="<?=$usuario->nome?>"><br>
    apelido: <input type="text" name="apelido" value="<?=$usuario->apelido?>"><br>
    senha: <input type="password" name="senha" value="<?=$usuario->senha?>"><br>
    <input type="submit" value="Alterar">
</form>

<?php
endforeach;
?>
