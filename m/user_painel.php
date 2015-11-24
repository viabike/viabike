<?php
require_once("../conexao/conexao.php");
require_once("template/header.php");


echo '<center><h1>Editar Perfil</h1></center>';
// <a href="user_senha.php"><button class="button" style="float: left;">Alterar senha</button></a></h1><br>';

$conexao = conectar(); //Conexao com o banco de dados viabike_db

$user_buscador = $conexao->prepare("SELECT * FROM usuario WHERE email = '" . $_COOKIE['email'] . "'"); //pegando todos os usuarios cadastrados

$user_buscador->execute(); //executando a query de uma maneira segura

$user = $user_buscador->fetchAll(PDO::FETCH_OBJ);


foreach ($user as $usuario):
    ?>
    <form action="user_altera.php" method="POST" enctype="multipart/form-data" style="float:left;">
        <input type="hidden" name="id_usuario" value="<?= $usuario->id_usuario ?>">
        <span style="font-size: 2em">Nome:</span><input type="text" name="nome" class="form" value="<?= $usuario->nome ?>" placeholder="Ex: Exemplo de Nome" required><br>
        <span style="font-size: 2em">E-mail:</span><input type="email" name="email" class="form" value="<?= $usuario->email ?>" placeholder="Ex: ex@exemplo.com" required><br>
        <img src="../imagens/users/<?= $usuario->foto ?>" width="100%">
        <span style="font-size: 2em">Foto:</span><input type="file" name="foto" class="form"><br>
        <input type="hidden" name="foto_velha" value="<?= $usuario->foto ?>">

        <hr style="border:1px; padding:2px; margin-bottom:10px; border-radius:5px; background-color:rgba(204,204,204, 0.25);">

        <span style="font-size: 2em">Confirme sua senha:</span><input type="password" name="senha" id="senha" class="form" required><br>

        <a onClick="confirmaDesativar()" style="float: left;font-size:14px; line-height:65px; color:#535455;">Desativar conta</button></a>

        <input type="submit" value="Alterar" class="button" style="float: right" id="botaoOk">
    </form>

    <script>
    function confirmaDesativar() {
        var confirma1 = confirm("Deseja desativar sua conta? \nVocê pode reativá-la simplesmente fazendo login novamente.");
        if (confirma1) {
           var confirma2 = confirm("Tem certeza? \nAs sinalizações cadastradas por você não apareceram mais no mapa.");
           if (confirma2) {
               location.href="user_desativar.php?id_usuario=<?= $usuario->id_usuario ?>";
           }
        }
    }
    </script>
<?php
endforeach;
require_once("template/footer.php");
