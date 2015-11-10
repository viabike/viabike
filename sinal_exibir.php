<?php
require_once("conexao/conexao.php");
$conexao = conectar();

$exibir_sinal = $conexao ->prepare("SELECT * FROM sinalizacao");
$exibir_sinal->execute();

$exibir = $exibir_sinal->fetchAll(PDO::FETCH_OBJ);?>

<table>
  <tr>
    <td>Titulo</td>
    <td>Categoria</td>
    <td>Descricao</td>
    <td>Data de Publicação</td>
  </tr>
  <?php foreach ($exibir as $sinal): ?>
  <tr>
    <td><?=$sinal->titulo?></td>
    <td><?=$sinal->categoria?></td>
    <td><?=$sinal->descricao?></td>
    <td><?=$sinal->data_public?></td>
  </tr>
  <?php endforeach; ?>
</table>
