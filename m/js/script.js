$(document).ready(function() {
    // Menu de navegação
    $("#menu").hide();
    var aux = 0;

    $("#nav").click(function() {
        if (aux === 0) {
            aux = 1;
            $("#menu").show();
        }
        else {
            $("#menu").hide();
            aux = 0;
        }
    });

    /*
     * Filtros
     *
     */
    $("#filtros-menu").hide();
    var aux = 0;

    $("#filtros").click(function() {
        if (aux === 0) {
            aux = 1;
            $("#filtros-menu").show();
        }
        else {
            $("#filtros-menu").hide();
            aux = 0;
        }
    });

    $("#filtro-cancel").click(function() {
        $("#filtros-menu").hide();
    });
    
     $("#filtro-conf").click(function() {
        $("#filtros-menu").hide();
    });

    /*
     * Menu user
     *
     */
    $("#menu_user").hide();
    var aux = 0;

    $("#user").click(function() {
        if (aux === 0) {
            aux = 1;
            $("#menu_user").show();
        }
        else {
            $("#menu_user").hide();
            aux = 0;
        }
    });
});
