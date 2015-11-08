<?php
include("../conexao/conexao.php");
include("template/header.php");


echo '<h1 style="float: left; text-align: left">Editar Perfil</h1>
<a href="user_senha.php"><button class="button" style="float: right;">Alterar senha</button></a></h1><br>';

$conexao = conectar(); //Conexao com o banco de dados viabike_db

$user_buscador = $conexao->prepare("SELECT * FROM usuario WHERE email = '" . $_COOKIE['email'] . "'"); //pegando todos os usuarios cadastrados

$user_buscador->execute(); //executando a query de uma maneira segura

$user = $user_buscador->fetchAll(PDO::FETCH_OBJ);


foreach ($user as $usuario):
    ?>
    <form action="user_altera.php" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="id_usuario" value="<?= $usuario->id_usuario ?>">
        Nome:<input type="text" name="nome" class="input" value="<?= $usuario->nome ?>" placeholder="Ex: Exemplo de Nome" required><br>
        E-mail:<input type="email" name="email" class="input" value="<?= $usuario->email ?>" placeholder="Ex: ex@exemplo.com" required><br>
        <img src="imagens/users/<?= $usuario->foto ?>" width="400px">
        Foto:<input type="file" name="foto" class="input"><br>
        <input type="hidden" name="foto_velha" value="<?= $usuario->foto ?>">

        <hr style="border:1px; padding:2px; margin-bottom:10px; border-radius:5px; background-color:rgba(204,204,204, 0.25);">

        Confirme sua senha:<input type="password" name="senha" id="senha" class="input" required><br>

        <a href="user_desativar.php?id_usuario=<?= $usuario->id_usuario ?>" style="float: left;font-size:14px; line-height:65px; color:#535455;">Desativar conta</button></a>

        <input type="submit" value="Alterar" class="button" style="float: right" id="botaoOk">
    </form>

<?php
endforeach;
include("template/footer.php");
?>
