<?php
session_start();
require_once("conexao/conexao.php");
require_once("admin/funcoes/funcoes.php");

$pdo = conectar();

// Pontos de interesse
$buscaPonto = $pdo->prepare("SELECT * FROM ponto_interesse");
$buscaPonto->execute();

$linhaPonto = $buscaPonto->fetchAll(PDO::FETCH_OBJ);

// Sinalizações
$buscaSinal = $pdo->prepare("SELECT `s`.* FROM `sinalizacao` as s 
INNER JOIN `usuario` as u ON `s`.`fk_id_usuario` = `u`.`id_usuario` WHERE `u`.`usuario_ativo` = 1 AND DATEDIFF(CURDATE(), `s`.`data_public`) <  60;");
$buscaSinal->execute();

$linhaSinal = $buscaSinal->fetchAll(PDO::FETCH_OBJ);
?>
<!DOCTYPE html>
<html>

    <title>ViaBike.me</title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <link rel="shortcut icon" href="imagens/favicon.ico" type="image/x-icon">
    <link rel="icon" href="imagens/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link href='https://fonts.googleapis.com/css?family=Raleway' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <script src="https://maps.googleapis.com/maps/api/js"></script>
    <script src="//code.jquery.com/jquery-1.11.3.min.js"></script>
	<link rel="stylesheet" href="/ui/css/black-tie/jquery-ui-1.10.4.custom.min.css" id="theme">
	<script src="/ui/js/jquery-ui.min.js"></script>
	<script>  
		//Tooltip config    
		$(function() {
		  $( document ).tooltip({
			position: {
			  my: "center bottom-15",
			  at: "center top",
			  using: function( position, feedback ) {
				$( this ).css( position );
				$( "<div>" )
				  .addClass( "arrow" )
				  .addClass( feedback.vertical )
				  .addClass( feedback.horizontal )
				  .appendTo( this );
			  }
			},
			 items: "[tooltip]",
			 content: function() {
					  return $(this).attr("tooltip");}        
		  });
		});
		$('#text-report_ifr').tooltip( "option", "disabled", true );
		$('#text-report_ifr *[title]').tooltip('disable');
		$('#text-report_ifr').tooltip('disable');        
	</script>

    <body>
        <div id="wrapper-index">

            <div id="header">
                <a href="index.php"><img src="imagens/viabike2.png" alt="ViaBike.me" class="logo"></a>

                <div id="nav-header">
                    <ul>
                        <?php
                        if (userLogado()) {
                            $conexao = conectar(); //Conexao com o banco de dados viabike_db
                            $user_buscador = $conexao->prepare("SELECT * FROM usuario WHERE email = '" . $_SESSION['email'] . "'"); //pegando todos os usuarios cadastrados
                            $user_buscador->execute(); //executando a query de uma maneira segura
                            $user = $user_buscador->fetchAll(PDO::FETCH_OBJ);
                            ?>

                            <?php
                            foreach ($user as $usuario):
                                echo "
						<li><a href='user_logout.php'>SAIR</a></li>
						<li><a href='user_painel.php'>" . $_SESSION['nome'] . "</a></li>
						<li><a href='user_painel.php'><img src='imagens/users/" . $usuario->foto . "' width='30px' height='30px'></a></li>
						<li style='color:#a7a7a7'> | </li>";
                            endforeach;
                        }
                        ?>
                        <?php if (!userLogado()) {
                            ?>
                            <li><a href="user_formulario.php"><button class="entrar">Entrar</button></a></li>
                        <?php } ?>
                        <li><a href="equipe.php">EQUIPE</a></li>
                        <li><a href="sobre.php">SOBRE</a></li>
                        <li><a href="index.php">HOME</a></li>
                    </ul>
                </div>
            </div>
        </div>


        <div id="content">

            <div id="mapa"></div>

            <div id="filtros">
                <i class="fa fa-sliders" style="font-size: 1em; color: #232"></i>
                <span style="font-family: Roboto, Arial, sans-serif; font-size: 13px; font-weight: bold;">Filtros:</span>
                <select id="filtro-ponto" style="font-family: Roboto, Arial, sans-serif; font-size: 13px; border: 1px solid #eee;">
                    <option value="TODOS" selected>Pontos de Interesse</option>
                    <option value="BC">Bicicletarias</option>
                    <option value="PG">Postos de Gasolina</option>
                    <option value="TODOS">Todos</option>
                    <option value="">Nenhum</option>
                </select>

                <select id="filtro-sinal" style="font-family: Roboto, Arial, sans-serif; font-size: 13px; border: 1px solid #eee;">
                    <option value="TODOS" selected>Sinalizações</option>
                    <option value="OB">Obras</option>
                    <option value="IT">Interditado</option>
                    <option value="AC">Acidentado</option>
                    <option value="OT">Outros</option>
                    <option value="TODOS">Todos</option>
                    <option value="">Nenhum</option>
                </select>
            </div>

            <div id="legenda">
                <p>Ciclovias: <span class="legenda-cic-ativa">&#9679;</span> Ativas | <span class="legenda-cic-obras">&#9679;</span> Obras</p>
            </div>

            <?php if (userLogado()) {
                ?>
                <div id="botao-sinalizacao">
                    <a href="sinal_form_cadastro.php"><button style="background: #e89401;" class="sinalizacao" >Sinalizar</button></a>
                </div>
            <?php } ?>
        </div>

        <script>

//Variavel do mapa
            var map;
            var infowindow = new google.maps.InfoWindow();
            var pontos = [
<?php
foreach ($linhaPonto as $linhasPontos):
    echo '[' . $linhasPontos->id_ponto . ', ' . $linhasPontos->latitude . ', ' . $linhasPontos->longitude . ', "' . $linhasPontos->categoria . '", "' . $linhasPontos->nome . '"],';
endforeach;
?>];
            var sinais = [
<?php
foreach ($linhaSinal as $linhasSinais):
    echo '[' . $linhasSinais->id_sinal . ', "' . $linhasSinais->titulo . '", "' . $linhasSinais->descricao . '", ' . $linhasSinais->latitude . ', ' . $linhasSinais->longitude . ', "' . $linhasSinais->categoria . '"],';
endforeach;
?>
            ];
            var markersPontos = [];
            var markersSinal = [];

//Função que inicia o mapa
            function initMap() {
                map = new google.maps.Map(document.getElementById('mapa'), {
                    center: {lat: -23.6255903, lng: -45.4241453},
                    zoom: 15,
                    mapTypeId: google.maps.MapTypeId.ROADMAP,
                    mapTypeControl: true,
                    mapTypeControlOptions: {
                        position: google.maps.ControlPosition.TOP_RIGHT
                    },
                    streetViewControl: true,
                    streetViewControlOptions: {
                        position: google.maps.ControlPosition.LEFT_BOTTOM
                    },
                    zoomControl: true,
                    zoomControlOptions: {
                        position: google.maps.ControlPosition.LEFT_BOTTOM
                    }
                });
                loadKmlLayer('http://viabike.me/mapa/mapa-das-ciclovias-v2.kml', map);

                // Pontos de Interesse
                for (var i = 0; i < pontos.length; i++) {
                    var ponto = pontos[i];
                    var myLatLng = new google.maps.LatLng(ponto[1], ponto[2]);
                    var iconPonto = '';
                    if (ponto[3] === "PG") {
                        iconPonto = 'imagens/ponto_posto.png';
                    } else if (ponto[3] === "BC") {
                        iconPonto = 'imagens/ponto_bicicletaria.png';
                    }
                    markerP = new google.maps.Marker({
                        position: myLatLng,
                        map: map,
                        title: ponto[4].toString(),
                        icon: iconPonto
                    });
                    markersPontos.push(markerP);
                    var id = ponto[0].toString();
                    google.maps.event.addListener(markerP, "click", infoCallbackPonto(infowindow, markerP, id));
                }
                ;

                // Sinalizações
                for (var i = 0; i < sinais.length; i++) {
                    var sinal = sinais[i];
                    var myLatLng = new google.maps.LatLng(sinal[3], sinal[4]);
                    var iconSinal = '';
                    if (sinal[5] === "OB") {
                        iconSinal = 'imagens/sinal_obras.png';
                    }
                    else if (sinal[5] === "IT") {
                        iconSinal = 'imagens/sinal_interditado.png';
                    }
                    else if (sinal[5] === "AC") {
                        iconSinal = 'imagens/sinal_acidentado.png';
                    }
                    else if (sinal[5] === "OT") {
                        iconSinal = 'imagens/sinal_outros.png';
                    }
                    markerS = new google.maps.Marker({
                        position: myLatLng,
                        map: map,
                        title: sinal[1].toString(),
                        icon: iconSinal
                    });
                    markersSinal.push(markerS);
                    var id = sinal[0].toString();
                    google.maps.event.addListener(markerS, "click", infoCallbackSinal(infowindow, markerS, id));
                }
                ;

            }

            function getContentPonto(id) {
                $.ajax({
                    type: "GET",
                    url: "/viabike/get_info_ponto.php?id=" + id, //online é somente /get...
                    dataType: "json",
                    success: function(data) {
                        $('#marker' + id).html(
                                '<h1>' + data.nome + '</h1>' +
                                '<p><i class="fa fa-map-marker"></i> ' + data.rua + ', ' + data.num + ' - ' + data.bairro + '</p>' +
                                '<p><i class="fa fa-phone"></i> (' + data.telefone.substr(0, 2) + ') ' + data.telefone.substr(3, 9) + '</p><br>' +
                                '<h4>Funcionamento</h4>' +
                                '<p><i class="fa fa-clock-o"></i> ' + data.hr_inicio.substr(0, 5) + ' às ' + data.hr_fecha.substr(0, 5) + '</p>'
                                );
                        $('#marker' + id).css('background', 'none');
                    }
                });
            }

            function getContentSinal(id) {
                $.ajax({
                    type: "GET",
                    url: "/viabike/get_info_sinal.php?id=" + id,
                    dataType: "json",
                    success: function(data) {
                        $('#marker' + id).html(
                                '<h1>' + data.titulo + '</h1>' +
                                '<p style="font-size:0.8em; margin: 0 0 10px 0">'
                                + 'Adicionado em ' + data.data_public.substr(8, 2) + data.data_public.substr(4, 3) + '-' + data.data_public.substr(0, 4) + '</p>'
                                + data.descricao
                                );
                        $('#marker' + id).css('background', 'none');
                    }
                });
            }

//FUNÇÃO QUE EXIBE JANELA DE INFORMAÇÕES DO PONTO
            function infoCallbackPonto(infowindow, marker, id) {
                return function() {
                    infowindow.setContent('<div class="infoWindow" id="marker' + id + '" style="width:auto; height:auto; background: url(imagens/loading.gif) no-repeat center center;"></div>');
                    infowindow.open(map, marker);
                    getContentPonto(id);
                };
            }

//FUNÇÃO QUE EXIBE JANELA DE INFORMAÇÕES DA SINALIZAÇÃO
            function infoCallbackSinal(infowindow, marker, id) {
                return function() {
                    infowindow.setContent('<div class="infoWindow" id="marker' + id + '" style="width:auto; height:auto; background: url(imagens/loading.gif) no-repeat center center;"></div>');
                    infowindow.open(map, marker);
                    getContentSinal(id);
                };
            }

// FUNÇÃO QUE CARREGA KML
            function loadKmlLayer(src, map) {
                var kmlLayer = new google.maps.KmlLayer(src, {
                    suppressInfoWindows: true,
                    preserveViewport: true,
                    map: map
                });
            }

//EVENTO QUE CHAMA FUNÇÃO initMap() QUANDO A JANELA FOR CARREGADA.
            google.maps.event.addDomListener(window, 'load', initMap);


            /*
             * Programação dos filtros
             */

// filtro-ponto (pontos de interesse)
// filtro-sinal (sinalizações)

            $(document).ready(function() {
                //pegando o valor do campo
                var filtro_ponto;
                var filtro_sinal;

                // Programaçao do botão "Pontos de Interesse"
                $("#filtro-ponto").change(function() {
                    filtro_ponto = $("#filtro-ponto").val();
                    $.ajax({
                        type: "GET",
                        url: "/viabike/filtro_pega_ponto.php?filtro_ponto=" + filtro_ponto,
                        dataType: "json",
                        success: function(resultado) {
                            while (markersPontos.length) {
                                markersPontos.pop().setMap(null);
                            }

                            $.each(resultado, function(i, ponto) {
                                var myLatLng = new google.maps.LatLng(ponto['latitude'], ponto['longitude']);
                                var iconPonto = '';
                                if (ponto['categoria'] === "PG") {
                                    iconPonto = 'imagens/ponto_posto.png';
                                } else if (ponto['categoria'] === "BC") {
                                    iconPonto = 'imagens/ponto_bicicletaria.png';
                                }
                                marker = new google.maps.Marker({
                                    position: myLatLng,
                                    map: map,
                                    title: ponto['nome'].toString(),
                                    icon: iconPonto
                                });
                                markersPontos.push(marker);
                                var id_ponto = ponto['id_ponto'].toString();
                                google.maps.event.addListener(marker, "click", infoCallbackPonto(infowindow, marker, id_ponto));
                            });
                        }
                    });

                });

                // Programação do botão "Sinalizações"
                $("#filtro-sinal").change(function() {
                    filtro_sinal = $("#filtro-sinal").val();
                    $.ajax({
                        type: "GET",
                        url: "/viabike/filtro_pega_sinal.php?filtro_sinal=" + filtro_sinal,
                        dataType: "json",
                        success: function(resultado) {
                            while (markersSinal.length) {
                                markersSinal.pop().setMap(null);
                            }

                            $.each(resultado, function(i, sinal) {
                                var myLatLng = new google.maps.LatLng(sinal['latitude'], sinal['longitude']);
                                var iconSinal = '';
                                if (sinal['categoria'] === "OB") {
                                    iconSinal = 'imagens/sinal_obras.png';
                                }
                                else if (sinal['categoria'] === "IT") {
                                    iconSinal = 'imagens/sinal_interditado.png';
                                }
                                else if (sinal['categoria'] === "AC") {
                                    iconSinal = 'imagens/sinal_acidentado.png';
                                }
                                else if (sinal['categoria'] === "OT") {
                                    iconSinal = 'imagens/sinal_outros.png';
                                }
                                markerS = new google.maps.Marker({
                                    position: myLatLng,
                                    map: map,
                                    title: sinal['titulo'].toString(),
                                    icon: iconSinal
                                });
                                markersSinal.push(markerS);
                                var id_sinal = sinal['id_sinal'].toString();
                                google.maps.event.addListener(markerS, "click", infoCallbackSinal(infowindow, markerS, id_sinal));
                            });
                        }
                    });

                });

            });

        </script>

    </body>
</html>
