<?php
include("conexao/conexao.php");
include("template/header.php");

$conexao = conectar();//Conexao com o banco de dados viabike_db

$user_buscador = $conexao -> prepare("SELECT * FROM usuario where email = '".$_COOKIE['email']."'");//pegando todos os usuarios cadastrados

$user_buscador -> execute();//executando a query de uma maneira segura

$user = $user_buscador->fetchAll(PDO::FETCH_OBJ);?>

<?php foreach ($user as $usuario): ?>
    <table>
        
    </table>
<?php endforeach;
include("template/footer.php");
?>
