$(document).ready(function() {
        $("#campoemail").css("border", "1px solid #bdc3c7");
        $("#campoSenha").css("border", "1px solid #bdc3c7");
        $("#campoConfSenha").css("border", "1px solid #bdc3c7");
        $("#emailIndisponivel").hide();
        $("#senhasDiferentes").hide();
        $("#senhasIguais").hide();
        $("#botaoOk").hide();
        
        $("#campoConfSenha").blur(function() {
            var senha = $("#campoSenha").val();
            var confSenha = $(this).val();
            
            if (confSenha === "") {
                $("#campoConfSenha").css("border", "1px solid #bdc3c7");
                $("#senhasDiferentes").hide();
                $("#senhasIguais").hide();
            }
            else {
                if (confSenha === senha) {
                    $("#campoConfSenha").css("border", "1px solid #40bd68");
                    $("#senhasDiferentes").hide();
                    $("#senhasIguais").show();
                    $("#botaoOk").show();
                    $("#botaoNotOK").hide();
                    
                    var senhaIgual = '$("#senhasIguais").hide()';
                    window.setTimeout(senhaIgual, 2500);
                }
                else {
                    $("#campoConfSenha").css("border", "1px solid #f00");
                    $("#senhasIguais").hide();
                    $("#senhasDiferentes").show();
                    
                    var senhaDiferente = '$("#senhasDiferentes").hide()';
                    window.setTimeout(senhaDiferente, 2500);
                }
            }
            
        });
        $("#campoemail").keyup(function() {
            var email = $(this).val();
      
            if (email === "") {
                $("#campoemail").css("border", "1px solid #bdc3c7");
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
            $("#campoemail").css("border", "1px solid #f00");
            $("#emailIndisponivel").show();  
            
            var emailIndis = '$("#emailIndisponivel").hide()';
            window.setTimeout(emailIndis,2500);
        }
        else {
            $("#campoemail").css("border", "1px solid #40bd68");
            $("#emailIndisponivel").hide();
        }
    }