$(document).ready(function () {
    // Menu de navegação
    $("#menu").hide();
    var aux_menu = 0;

    $("#nav").click(function () {
        if (aux_menu === 0) {
            aux_menu = 1;
            $("#menu").show();
        }
        else {
            $("#menu").hide();
            aux_menu = 0;
        }
    });

    /*
     * Filtros
     *
     */

    $("#menu-filtro").hide();
    var aux_filtro = 0;

    $("#filtros").click(function () {
        if (aux_filtro === 0) {
            aux_filtro = 1;
            $("#menu-filtro").show();
        }
        else {
            $("#menu-filtro").hide();
            aux_filtro = 0;
        }
    });

    $("#filtro-cancel").click(function () {
        $("#filtros-menu").hide();
    });

    $("#filtro-conf").click(function () {
        $("#filtros-menu").hide();
    });




//    $("#filtros-menu").hide();
//    var aux = 0;
//
//    $("#filtros").click(function() {
//        if (aux === 0) {
//            aux = 1;
//            $("#filtros-menu").show();
//        }
//        else {
//            $("#filtros-menu").hide();
//            aux = 0;
//        }
//    });
//
//    $("#filtro-cancel").click(function() {
//        $("#filtros-menu").hide();
//    });
//    
//     $("#filtro-conf").click(function() {
//        $("#filtros-menu").hide();
//    });

    /*
     * Menu user
     *
     */
    $("#menu_user").hide();
    var aux_user = 0;

    $("#user").click(function () {
        if (aux_user === 0) {
            aux_user = 1;
            $("#menu_user").show();
        }
        else {
            $("#menu_user").hide();
            aux_user = 0;
        }
    });
    
    // fecha menu de usuário quando abre o menu de filtros
    $("#filtros").click(function () {
        if (aux_user === 1) {
            $("#menu_user").hide();
        }
    });
    
    // fecha menu de filtros quando abre o menu de usuários
    $("#user").click(function () {
        if (aux_filtro === 1) {
            $("#menu-filtro").hide();
        }

    }); 
});