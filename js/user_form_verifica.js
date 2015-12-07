$(document).ready(function() {
        $("#emailIndisponivel").hide();
        $("#senhasDiferentes").hide();
        $("#senhasIguais").hide();
        $("#botaoOk").hide();

        $("#campoConfSenha").blur(function() {
            var senha = $("#campoSenha").val();
            var confSenha = $(this).val();

            if (confSenha === "") {
                $("#senhasDiferentes").hide();
                $("#senhasIguais").hide();
            }
            else {
                if (confSenha === senha) {
                    $("#senhasDiferentes").hide();
                    $("#senhasIguais").show();
                    $("#botaoOk").show();
                    $("#botaoNotOK").hide();
                }
                else {
                    $("#senhasIguais").hide();
                    $("#senhasDiferentes").show();
                }
            }

        });
        $("#campoemail").keyup(function() {
            var email = $(this).val();

            if (email === "") {
                $("#emailIndisponivel").hide();
            }
            else {
                $.ajax({
                    type: "POST",
                    url: "user_form_verifica_email.php",
                    data: "email=" + email,
                    success: function(resultado) {
                        var retorno = resultado;
                        getMessage(retorno);
                    },
                    error: function() {
                        alert("Erro ao verificar os detalhes do usuario!");
                    }
                });
            }
        });
    });
    function getMessage(type) {
        if (type == 1) {
            $("#emailIndisponivel").show();
        }
        else {
            $("#emailIndisponivel").hide();
        }
    }
