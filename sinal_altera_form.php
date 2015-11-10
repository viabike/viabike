<?php
require_once("conexao/conexao.php");

$conexao = conectar();

$id_sinal = $_POST['id_sinal']; //Requisição vinda da pag sinal_exibir...OBS: mudar depois, definir nome

//preparando a query
$sinal_buscador = $conexao -> prepare("SELECT * from sinalizacao where id_sinal = :id_sinal");
    $sinal_buscador -> bindValue(":id_sinal" , $id_sinal);
$sinal_buscador -> execute();
//executando a query

//associando todos os objetos
$sinal = $sinal_buscador->fetchAll(PDO::FETCH_OBJ);

foreach ($sinal as $sinalizacao) :?>
<form class="" action="sinal_altera.php" method="post">
    <input type="hidden" name="id_sinal" value="<?=$sinalizacao->id_sinal?>">
    Titulo:<input type="text" name="titulo" value="<?=$sinalizacao->titulo?>"><br>
    Categoria:<select name="categoria">
    <option value="OB" selected>Obras</option>
    <option value="IT">Interditado</option>
    <option value="AC">Acidentado</option>
    <option value="OT">Outros</option>
    </select><br>
    Descrição:<textarea name="descricao" value="<?=$sinalizacao->descricao?>">
    </textarea><br>
    Longitude<input type="number" name="longitude" value="<?=$sinalizacao->longitude?>"><br>
    Latitude:<input type="number" name="latitude" value="<?=$sinalizacao->latitude?>"><br>
    Data de publicação:<input type="date" name="data_public" value="<?=$sinalizacao->data_public?>">
    <input type="submit" name="name" value="alterar">
</form>
<?php endforeach; ?>
