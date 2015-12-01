<?php
ob_start();
session_start();
require_once("../conexao/conexao.php");
require_once("funcoes/funcoes.php");
require_once '../libs/Mobile_Detect.php';
$detect = new Mobile_Detect;
if (!$detect->isMobile() ) {
   header('Location: http://viabike.me/');
}

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
    <head>
        <title>Viabike.me</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="shortcut icon" href="imagens/favicon.ico" type="image/x-icon">
        <link rel="icon" href="imagens/favicon.ico" type="image/x-icon">
        <link rel="stylesheet" type="text/css" href="css/style.css">
        <script src="http://code.jquery.com/jquery-1.11.3.min.js"></script>
        <link href='https://fonts.googleapis.com/css?family=Raleway' rel='stylesheet' type='text/css'>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
        <script src="https://maps.googleapis.com/maps/api/js"></script>
        <script src="js/script.js"></script>
    </head>
    <body>
        <div id="wrapper">
            <div id="header">
                <div id="logo">
                    <a href="index.php"><img src="imagens/viabike2.png" alt="ViaBike.me logo" style="width:100px;"></a>
                </div>
                <div id="nav">
                    <i class="fa fa-bars fa-5x icon-menu" style="font-size: 1em; color: #fff;"></i>
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

                <?php
                if (userLogado()) {
                    $email = $_SESSION['email'];
                    $fotouser = $pdo->prepare("SELECT foto FROM usuario WHERE email = '" . $email . "'");
                    $fotouser->execute();
                    $fotolinha = $fotouser->fetchAll(PDO::FETCH_ASSOC);
                    ?><div id="user" style="background: url('../imagens/users/<?= $fotolinha[0]['foto'] ?>') no-repeat center center; background-size: cover;">
                    </div>
                <?php }
                if (userLogado()) {
                    echo "
                    <div id='botao-direito'>
                        <a href='sinal_form_cadastro_part1.php'><button class='button_direito' style='background-color: #BD4040;'>SINALIZAR</button></a>
                    </div>
                    ";
                }
                else {
                    echo "
                    <div id='botao-direito'>
                        <a href='user_login.php'><button class='button_direito'>ENTRAR</button></a>
                    </div>
                    ";
                }
                ?>

                <div id="filtros">
                    <i class="fa fa-sliders" style="font-size: 1.65em; color: #232323;"></i>
                </div>

                <div id="menu_user">
                  <ul>
                    <li><a href="user_painel.php">EDITAR PERFIL</a></li>
                    <li><a href="user_senha.php">ALTERAR SENHA</a></li>
                    <li><a href="user_logout.php">SAIR</a></li>
                  </ul>
                </div>

                <div id="filtros-menu">
                    <form id="filtro-ponto" style="margin-left:10%; margin-top:30px">
                        <h1 style="font-size:1em; font-weight:600; margin:0px 0px 5px 0px;">Pontos de Interesse</h1>
                        <input type="radio" name="filtro-ponto" value="BC" class="filtro-input"> Bicicletarias<br>
                        <input type="radio" name="filtro-ponto" value="PG" class="filtro-input"> Postos de Gasolina<br>
                        <input type="radio" name="filtro-ponto" value="TODOS" class="filtro-input"> Todos<br>
                        <input type="radio" name="filtro-ponto" value="" class="filtro-input"> Nenhum
                    </form>

                    <form id="filtro-sinal" style="margin-left:10%; margin-top:5px">
                        <h1 style="font-size:1em; font-weight:600; margin:0px 0px 5px 0px;">Sinalizações</h1>
                        <input type="radio" name="filtro-sinal" value="OB" class="filtro-input"> Obras<br>
                        <input type="radio" name="filtro-sinal" value="AC" class="filtro-input"> Acidentado<br>
                        <input type="radio" name="filtro-sinal" value="OT" class="filtro-input"> Outros<br>
                        <input type="radio" name="filtro-sinal" value="TODOS" class="filtro-input"> Todos<br>
                        <input type="radio" name="filtro-sinal" value="" class="filtro-input"> Nenhum
                    </form>

                    <br>
                    <div id="filtro-botoes" style="width:100%; float:left;">
                        <center><i class="fa fa-times" id="filtro-cancel" style="font-size:2em; color:#ccc"></i>&nbsp&nbsp&nbsp
                        <i class="fa fa-check" id="filtro-conf" style="font-size:2em; color:#ccc"></i></center>
                    </div>
                </div>
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
                        center: {lat: -23.6457413, lng: -45.4242261},
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
                        url: "/viabike/m/get_info_ponto.php?id=" + id, //online é somente /get...
                        dataType: "json",
                        success: function(data) {
                            $('#marker' + id).html(
                                    '<h1 style="font-size:1em;">' + data.nome + '</h1>' +
                                    '<p style="font-size:1em;"><i class="fa fa-map-marker"></i> ' +
                                    data.rua + ', ' + data.num +
                                    ' - ' + data.bairro + '</p>' +
                                    '<p style="font-size:1em;"><i class="fa fa-phone"></i> (' + data.telefone.substr(0, 2) + ') ' +
                                    data.telefone.substr(3, 9) + '</p><br>' + '<h4>Funcionamento</h4>' +
                                    '<p style="font-size:1em;"><i class="fa fa-clock-o"></i> ' +
                                    data.hr_inicio.substr(0, 5) + ' às ' +
                                    data.hr_fecha.substr(0, 5) + '</p>');
                            $('#marker' + id).css('background', 'none');
                        }
                    });
                }

                function getContentSinal(id) {
                    $.ajax({
                        type: "GET",
                        url: "/viabike/m/get_info_sinal.php?id=" + id,
                        dataType: "json",
                        success: function (data) {
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
                        infowindow.setContent('<div class="infoWindowSinal" id="marker' + id + '" style="width:auto; height:auto; background: url(imagens/loading.gif) no-repeat center center;"></div>');
                        infowindow.open(map, marker);
                        getContentSinal(id);
                    };
                }


                // FUNÇÃO QUE CARREGA KML
                function loadKmlLayer(src, map) {
                    var kmlLayer = new google.maps.KmlLayer(src, {suppressInfoWindows: true, preserveViewport: true,
                        map: map
                    });
                }

                //EVENTO QUE CHAMA FUNÇÃO initMap() QUANDO A JANELA FOR CARREGADA.
                google.maps.event.addDomListener(window, 'load', initMap);

                /*
                 * Programação dos filtros
                 *
                 * filtro-ponto (pontos de interesse)
                 * filtro-sinal (sinalizações)
                 */

                $(document).ready(function() {
                    var filtro_ponto;
                    var filtro_sinal;

                    // Programaçao do botão "Pontos de Interesse"
                    $("#filtro-ponto").change(function() {
                        filtro_ponto = $("input[name='filtro-ponto']:checked").val();
                        $("#filtro-conf").click(function() {
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
                            $("#filtros-menu").hide();
                        });
                    });

                    // Programação do botão "Sinalizações"
                    $("#filtro-sinal").change(function() {
                        filtro_sinal = $("input[name='filtro-sinal']:checked").val();
                        $("#filtro-conf").click(function() {
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
                            $("#filtros-menu").hide();
                        });
                    });
                });
            </script>
        </div>
    </body>
</html>
