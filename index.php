<?php
session_start();
require_once("conexao/conexao.php");
require_once("admin/funcoes/funcoes.php");
// ======== SELECIONA TODOS OS REGISTROS DE PONTOS DE INTERESSE DO BANCO VIABIKE_DB =============
$pdo = conectar();
$buscaPonto = $pdo->prepare("SELECT * FROM ponto_interesse");
//Executando a QUERY
$buscaPonto->execute();
// ========= FIM DA SELEﾃ�ﾃグ ==============================================

$linha = $buscaPonto->fetchAll(PDO::FETCH_OBJ);
?>
<!DOCTYPE html>
<html>

    <title>ViaBike.me</title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link href='https://fonts.googleapis.com/css?family=Raleway' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <script src="https://maps.googleapis.com/maps/api/js"></script>
    <script src="//code.jquery.com/jquery-1.11.3.min.js"></script>


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
                        <?php if (!userLogado()) { ?>
                            <li><a href="user_formulario.php">ENTRAR</a></li>
                        <?php } ?>
                        <li><a href="equipe.php">EQUIPE</a></li>
                        <li><a href="sobre.php">SOBRE</a></li>
                        <li><a href="index.php">HOME</a></li>
                    </ul>
                </div>
            </div>
            <!---
            <?php // if(!userLogado()){ ?>
        <div id="entrar">
                            <p><center><a href="user_formulario.php">Cadastre-se / Entrar</a></center></p>
                    </div>
            <?php // }  ?>
            -->
        </div>


        <div id="content">

            <div id="mapa"></div>

            <div id="filtros">
                <i class="fa fa-sliders" style="font-size: 3em; color: #232323"></i>
                Filtros: 
                <select id="filtro-ponto">
                    <option selected>PONTOS DE INTERESSE</option>
                    <option value="BC">Bicicletarias</option>
                    <option value="PG">Postos de Gasolina</option>
                </select>

                <select id="filtro-sinal">
                    <option selected>SINALIZAﾇﾕES</option>
                    <option value="OB">Obras</option>
                    <option value="IT">Interditado</option>
                    <option value="AC">Acidentado</option>
                    <option value="OT">Outros</option>
                </select>
            </div>   

            <!--
                    <div id="info-viabike">
                            <p>Para os ciclistas de Caraguatatuba que querem economizar tempo e encontrar uma rota segura o ViaBike.me ﾃｩ um sistema web que mostra um mapa de ciclovias.</p>
                    </div>
            
            
                        <div class="text-home">
                                <p>Para os ciclistas de Caraguatatuba que querem economizar tempo e encontrar uma rota segura. O ViaBike.me ﾃｩ um sistema web que mostra um mapa de ciclovias.</p>
                        </div>
            
                        <div class="legenda-home" style="text-align:right">
                                <ul>
                                        <li>Ciclovia Ativa <span class="legenda-cic-ativa">&#9679;</span></li>
                                        <li>Ciclovia em Obras <span class="legenda-cic-obras"> &#9679;</span></li></li>
                                </ul>
                        </div>
                    </div>
            
                    <div id="footer">
                    <center><p>&copy ViaBike.me - 2015</p></center>
            -->
        </div>


        <script>

//Variavel do mapa
            var map;
            var infowindow = new google.maps.InfoWindow();
            var pontos = [
<?php
foreach ($linha as $linhas):
    echo '[' . $linhas->id_ponto . ', ' . $linhas->latitude . ', ' . $linhas->longitude . ', "' . $linhas->categoria . '", "' . $linhas->nome . '"],';
endforeach;
?>];

//Funﾃｧﾃ｣o que inicia o mapa
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
                    if (ponto[3] === "PG") {
                        iconPonto = 'imagens/posto1.png';
                    } else if (ponto[3] === "BC") {
                        iconPonto = 'imagens/bike1.png';
                    }
                    marker = new google.maps.Marker({
                        position: myLatLng,
                        map: map,
                        title: ponto[4].toString(),
                        icon: iconPonto
                    });
                    var id = ponto[0].toString();
                    google.maps.event.addListener(marker, "click", infoCallback(infowindow, marker, id));
                }
                ;

            }

            function getContentPonto(id) {

                $.ajax({
                    type: "GET",
                    url: "/viabike/get_info_ponto.php?id=" + id, //online ﾃｩ somente /get...
                    dataType: "json",
                    success: function (data) {
                        $('#marker' + id).html(
                                '<h1>' + data.nome + '</h1>' +
                                '<p><i class="fa fa-map-marker"></i> ' + data.rua + ', ' + data.num + ' - ' + data.bairro + '</p>' +
                                '<p><i class="fa fa-phone"></i> (' + data.telefone.substr(0, 2) + ') ' + data.telefone.substr(3, 9) + '</p><br>' +
                                '<h4>Funcionamento</h4>' +
                                '<p><i class="fa fa-clock-o"></i> ' + data.hr_inicio.substr(0, 5) + ' ﾃs ' + data.hr_fecha.substr(0, 5) + '</p>'
                                );
                        $('#marker' + id).css('background', 'none');
                    }
                });
            }


//FUNﾃ�ﾃグ QUE EXIBE JANELA DE INFORMAﾃ�ﾃ髭S DO PONTO
            function infoCallback(infowindow, marker, id) {
                return function () {
                    infowindow.setContent('<div class="infoWindow" id="marker' + id + '" style="width:auto; height:auto; background: url(imagens/loading.gif) no-repeat center center;"></div>');
                    infowindow.open(map, marker);
                    getContentPonto(id);
                };
            }

// FUNﾃ�ﾃグ QUE CARREGA KML
            function loadKmlLayer(src, map) {
                var kmlLayer = new google.maps.KmlLayer(src, {
                    suppressInfoWindows: true,
                    preserveViewport: true,
                    map: map
                });
            }

//EVENTO QUE CHAMA FUNﾃ�ﾃグ initMap() QUANDO A JANELA FOR CARREGADA.
            google.maps.event.addDomListener(window, 'load', initMap);


            /*
             * 
             * Programa鈬o dos filtros
             * (por william e itallo)   
             *                 
             */

// filtro-ponto (pontos de interesse)
// filtro-sinal (sinaliza鋏es)

    
     $(document).ready(function(){
     //pegando o valor do campo 
        var filtro_ponto;
        var filtro_sinal;

        $("#filtro-ponto").change(function(){
            filtro_ponto = $("#filtro-ponto").val();
            $.ajax({
                type: "POST",
                url: "filtro_pega_ponto.php",
                data:"filtro_ponto="+filtro_ponto,
                success:function(resultado){
                console.log(resultado);
                },
                error: function(){
                    alert("Erro");
                }
            });
            
        });

        $("#filtro-sinal").change(function(){
            filtro_sinal = $("#filtro-sinal").val();
        });

     //busca os no banco de acordo com o filtro
//        $("#filtro-ponto").change(function(){
//            $.ajax({
//                type: "POST",
//                url: "filtro_pega_ponto.php",
//                data:"filtro_ponto="+filtro_ponto,
//                success:function(resultado){
//                console.log(resultado);
//                },
//                error: function(){
//                    alert("Erro");
//                }
//            });
//        });

     // Para fazer: Pegar os valores retornados do banco e exibilos no mapa

     });

        </script>

    </body>
</html>
