<?php
include("conexao/conexao.php");

$conexao = conectar();//Conexao com o banco de dados viabike_db

// $user_buscador = $conexao -> prepare("SELECT * FROM usuario where email = 'haryelllc@gmail.com'");//pegando todos os usuarios cadastrados

$user_buscador -> execute();//executando a query de uma maneira segura

$user = $user_buscador->fetchAll(PDO::FETCH_OBJ);?>

<?php foreach ($user as $usuario): ?>
    <table>
        <tr>
            <td>Nome:</td>
            <td>Apelido:</td>
        </tr>

        <tr>
            <td><?=$usuario->nome?></td>
            <td><?=$usuario->email?></td>
        </tr>
        <tr>
            <td>
                <form class="" action="user_desativar.php" method="post">
                    <input type="hidden" name="id_usuario" value="<?=$usuario->id_usuario?>">
                    <input type="submit" value="Desativar Conta">
                </form>
            </td>
            <td>
                <form class="" action="user_altera_form.php" method="post">
                    <input type="hidden" name="id_usuario" value="<?=$usuario->id_usuario?>">
                    <input type="submit" value="Alterar">
                </form>
            </td>
        </tr>
    </table>
<?php endforeach; ?>
