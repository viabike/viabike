<?php
require_once("conexao/conexao.php");
$conexao = conectar();
//REQUISIÇÕES VINDAS DA PÁGINA SINAL_FORMULARIO.PHP
$titulo      = addslashes(trim($_POST['titulo'     ]));
$categoria   = addslashes(trim($_POST['categoria'  ]));
$descricao   = addslashes(trim($_POST['descricao'  ]));
$longitude   = addslashes(trim($_POST['longitude'  ]));
$latitude    = addslashes(trim($_POST['latitude'   ]));
$data_public = addslashes(trim($_POST['data_public']));

$addsinal = $conexao -> prepare("INSERT INTO sinalizacao (titulo, descricao, latitude, longitude, categoria, data_public) values(:titulo, :descricao, :latitude, :longitude, :categoria, :data_public)");
$addsinal->bindValue(":titulo"      , $titulo      );
$addsinal->bindValue(":descricao"   , $descricao   );
$addsinal->bindValue(":latitude"    , $latitude    );
$addsinal->bindValue(":longitude"   , $longitude   );
$addsinal->bindValue(":categoria"   , $categoria   );
$addsinal->bindValue(":data_public" , $data_public );
$addsinal->execute();

if($addsinal) {
  echo "sinal add com sucesso";
}else {
  echo "faio";
}

 ?>
