<?php
require_once("conexao/conexao.php");
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
	<title>ViaBike.me</title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<link href='https://fonts.googleapis.com/css?family=Raleway' rel='stylesheet' type='text/css'>
	<script src="https://maps.googleapis.com/maps/api/js"></script>
</head>
<body>
	<div id="wrapper">

		<div id="header">

			<a href="index.php"><img src="imagens/viabike2.png" alt="ViaBike.me" class="logo"></a>

			<div id="nav-header">
				<ul>
					<li><a href="equipe.php">EQUIPE</a></li>
					<li><a href="sobre.php">SOBRE</a></li>
					<li><a href="index.php">HOME</a></li>
				</ul>
			</div>

		</div>

		<div id="entrar">
			<p><center><a href="#">Cadastre-se / Entrar</a></center></p>
		</div>

		<div id="mapa"></div>

		<script>

//Variavel do mapa
var map;

//Função que inicia o mapa
function initMap() {
  map = new google.maps.Map(document.getElementById('mapa'), {
  	center: {lat: -23.6255903, lng: -45.4241453},
  	zoom: 15,
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
		iconPonto = 'imagens/viabike_ico.png';
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

// FUNÇÃO QUE CARREGA KML
function loadKmlLayer(src, map){
	var kmlLayer = new google.maps.KmlLayer(src, {
		suppressInfoWindows: true,
		preserveViewport: true,
		map: map
	});
}

//EVENTO QUE CHAMA FUNÇÃO initMap() QUANDO A JANELA FOR CARREGADA.
google.maps.event.addDomListener(window, 'load', initMap);

		</script>

		<div id="content">
			<div class="text-home">
				<p>Para os ciclistas de Caraguatatuba que querem economizar tempo e encontrar uma rota segura o ViaBike.me é um sistema web que mostra um mapa de ciclovias.</p>
			</div>

			<div class="legenda-home" style="text-align:right">
				<ul>
					<li>Ciclovia Ativa <span class="legenda-cic-ativa">&#9679;</span></li>
					<li>Ciclovia em Obras <span class="legenda-cic-obras"> &#9679;</span></li></li>
				</ul>
			</div>
		</div>

		<div id="footer">
  		<center><p>&copy ViaBike.me - 2015 <br>Site em desenvolvimento</p></center>
		</div>
	</div>
</body>
</html>
