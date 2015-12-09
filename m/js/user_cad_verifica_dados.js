$(document).ready(function() {
        $("#emailIndisponivel").hide();
        
        $("#campoConfSenha").blur(function() {
            var senha = $("#campoSenha").val();
            var confSenha = $(this).val();

            if (confSenha !== senha) {
                alert("As senhas não conferem!");
            }
        });
        
        $("#campoemail").blur(function() {
            var email = $(this).val();
      
            $.ajax({
                type: "POST",
                url: "user_form_verifica_email.php",
                data: "email=" + email,
                success: function(resultado) {
                    var retorno = resultado;
                    getMessage(retorno);
                },
                error: function() {
                    alert("Erro ao verificar os detalhes do usuário!");
                }
            });
        });
    });
    function getMessage(type) {
        if (type == 1) {
            $("#campoemail").css("border", "1px solid #f00");
            $("#emailIndisponivel").show();  
        }
        else {
            $("#campoemail").css("border", "1px solid #40bd68");
            $("#emailIndisponivel").hide();
        }
    }