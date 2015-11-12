<?php
require_once("conexao/conexao.php");

$conexao = conectar();


//preparando a query
$sinal_buscador = $conexao -> prepare("SELECT * from sinalizacao where id_sinal = :id_sinal");
$sinal_buscador -> bindValue(":id_sinal" , $_POST['id_sinal']);
$sinal_buscador -> execute();
//executando a query

//associando todos os objetos
$sinal = $sinal_buscador->fetchAll(PDO::FETCH_OBJ);

foreach ($sinal as $sinalizacao) :?>
<form class="" action="sinal_altera.php" method="post">
    <input type="hidden" name="id_sinal" value="<?=$sinalizacao->id_sinal?>">
    Titulo:<input type="text" name="titulo" value="<?=$sinalizacao->titulo?>"><br>
    Categoria:<select name="categoria">
    <option value="OB" <?=($sinalizacao->categoria == "OB")?'selected':''?>>Obras</option>
    <option value="IT" <?=($sinalizacao->categoria == "IT")?'selected':''?>>Interditado</option>
    <option value="AC" <?=($sinalizacao->categoria == "AC")?'selected':''?>>Acidentado</option>
    <option value="OT" <?=($sinalizacao->categoria == "OT")?'selected':''?>>Outros</option>
    </select><br>
    Descrição:<textarea name="descricao">
    </textarea><br>
    Longitude<input type="number" name="longitude" value="<?=$sinalizacao->longitude?>"><br>
    Latitude:<input type="number" name="latitude" value="<?=$sinalizacao->latitude?>"><br>
    Data de publicação:<input type="date" name="data_public" value="<?=$sinalizacao->data_public?>">
    <input type="submit" name="name" value="alterar">
</form>
<?php endforeach; ?>
