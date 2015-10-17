<?php
require_once("../conexao/conexao.php");
// ======== SELECIONA TODOS OS REGISTROS DE PONTOS DE INTERESSE DO BANCO VIABIKE_DB =============
$pdo = conectar();
$buscaPonto = $pdo -> prepare("SELECT * FROM ponto_interesse");
//Executando a QUERY
$buscaPonto -> execute();
// ========= FIM DA SELEÇÃO ==============================================

$linha = $buscaPonto->fetchAll(PDO::FETCH_OBJ);
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Viabike.me</title>
        <meta charset="UTF-8">
        <link rel="stylesheet" type="text/css" href="css/style.css">
        <script src="https://maps.googleapis.com/maps/api/js"></script>
        <script src="http://code.jquery.com/jquery-1.11.3.min.js"></script>
		<link href='https://fonts.googleapis.com/css?family=Raleway' rel='stylesheet' type='text/css'>
        <script src="js/script.js"></script>
    </head>
    <body>
        <div id="wrapper">
            <div id="header">
                <div id="logo">
                    <a href="index.php"><img src="imagens/viabike2.png" alt="ViaBike.me logo" style="width:100%;"></a>
                </div>
                <div id="nav">
                    <img src="imagens/menu-icon.png" alt="Menu" style="width: 100px;">
                </div>
            </div>
            <div id="menu">
                <ul>
                    <li><a href="index.php">HOME</a></li>
                    <li><a href="sobre.php">SOBRE</a></li>
                    <li><a href="equipe.php">EQUIPE</a></li>
                </ul>
            </div>

            <div id="containermap">
                <div id="mapa">
                </div>

                <!--
                <div id="filtros">
                    <img src="imagens/filtroicon.png" alt="Filtros" style="width: 100px;">
                </div>
                -->
            </div>

            <script>

//Variavel do mapa
var map;

//Função que inicia o mapa
function initMap() {
  map = new google.maps.Map(document.getElementById('mapa'), {
  	center: {lat: -23.6255903, lng: -45.4241453},
  	zoom: 16,
  	mapTypeId: google.maps.MapTypeId.ROADMAP
  });
  loadKmlLayer('http://viabike.me/mapa/mapa-das-ciclovias-v2.kml', map);
	var iconPonto;

	<?php
	$contador = 0;

	foreach ($linha as $linhas):
    $contador++;
  ?>

	if ("<?=$linhas->categoria;?>" == "PG") {
		iconPonto = 'http://maps.google.com/mapfiles/kml/pal2/icon21.png';
	}else if ("<?=$linhas->categoria;?>" == "BC") {
		iconPonto = '../imagens/viabike_ico.png';
	}


  la<?=$contador?> = parseFloat(<?=$linhas->latitude; ?>);
  lo<?=$contador?> = parseFloat(<?=$linhas->longitude;?>);

  local<?=$contador?> = {lat: la<?=$contador?>, lng: lo<?=$contador?>};

  addMarker(local<?php echo $contador?>, map, iconPonto);

	<?php
  endforeach;
  ?>
}

var marker;
// FUNÇÃO QUE ADICIONA MARCAS NO MAPA
function addMarker(location, map, myIcon) {
	  marker = new google.maps.Marker({
		position: location,
    icon: myIcon,
    map: map
	});
}

function loadKmlLayer(src, map) {
    var kmlLayer = new google.maps.KmlLayer(src, {
        suppressInfoWindows: true,
        preserveViewport: true,
        map: map
    });
}

google.maps.event.addDomListener(window, 'load', initMap);
            </script>
        </div>
    </body>
</html>
