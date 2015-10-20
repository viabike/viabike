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
	<script src="//code.jquery.com/jquery-1.11.3.min.js"></script>
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

		<div id="entar">
			<p><center><a href="#">Cadastre-se / Entrar</a></center></p>
		</div>

		<div id="mapa"></div>

		<script>

//Variavel do mapa
var map;
var infowindow = new google.maps.InfoWindow();
var pontos = [
<?php  
foreach ($linha as $linhas):	
	echo '['.$linhas->id_ponto.', '.$linhas->latitude.', '.$linhas->longitude.', "'.$linhas->categoria.'", "'.$linhas->nome.'"],';
endforeach;
  ?>];

//Função que inicia o mapa
function initMap() {
  map = new google.maps.Map(document.getElementById('mapa'), {
  	center: {lat: -23.6255903, lng: -45.4241453},
  	zoom: 15,
  	mapTypeId: google.maps.MapTypeId.ROADMAP
  });
  loadKmlLayer('http://viabike.me/mapa/mapa-das-ciclovias-v2.kml', map);

  for (var i = 0; i < pontos.length; i++) {
  	var ponto = pontos[i];
  	var myLatLng = new google.maps.LatLng(ponto[1], ponto[2]);
  	var iconPonto = '';
  	if (ponto[3] == "PG") {
		iconPonto = 'http://maps.google.com/mapfiles/kml/pal2/icon21.png';
	}else if (ponto[3] == "BC") {
		iconPonto = 'imagens/viabike_ico.png';
	}
  	marker = new google.maps.Marker({
  		position: myLatLng,
  		map:map,
  		title:ponto[4].toString(),
  		icon:iconPonto
  	});
  	var id = ponto[0].toString();
  	google.maps.event.addListener(marker, "click", infoCallback(infowindow, marker, id));
  };

}

function getContentPonto(id){
	
   $.ajax({
       type: "GET",
       url: "/viabike/get_info_ponto.php?id="+id,
       dataType: "json",
       success: function(data){    
          $('#marker'+id).html('Teste nome='+data.nome+' teste outro='+data['nome']);
          $('#marker'+id).css('background','none');
       }
   });
}


//FUNÇÃO QUE EXIBE JANELA DE INFORMAÇÕES DO PONTO
function infoCallback (infowindow, marker, id) {
	return function() {
		infowindow.setContent('<div id="marker'+id+'" style="background: url(imagens/loading.gif) no-repeat center center; width: 450px; height: 200px"></div>');
		infowindow.open(map, marker);
		getContentPonto(id);
	}
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
			<center><p>Copyright &copy 2015</p></center>
		</div>
	</div>
</body>
</html>
