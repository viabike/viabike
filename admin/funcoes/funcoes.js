//formata campos de uma certa forma, como num campo de CEP
function formatar(mascara, documento)
{
  var i = documento.value.length;
  var saida = mascara.substring(0,1);
  var texto = mascara.substring(i)

  if (texto.substring(0,1) != saida)
  {
    documento.value += texto.substring(0,1);
  }
}

// enviar o formulário somente dpeois de verificar todos os campos
function validar()
{
  var nome    = form_adm.nome.value;
  var numero  = form_adm.num.value;
  var cep     = form_adm.cep.value;

  // Campo nome
  if (!apenas_letras(nome) == 1)
  {
    alert("Nome deve conter apenas letras.");
    form_adm.nome.focus();
    form_adm.nome.style.border='1px solid #bd4040';
    return false
  }

  // Campo número do endereço
  if (!apenas_nums(numero) == 1)
  {
    alert("Número do endereço deve conter apenas caracteres númericos.");
    form_adm.num.focus();
    form_adm.num.style.border='1px solid #bd4040';
    return false
  }

  // Campo CEP
  if (!apenas_nums(cep) == 1)
  {
    alert("CEP deve conter apenas caracteres númericos.");
    form_adm.cep.focus();
    form_adm.cep.style.border='1px solid #bd4040';
    return false
  }


}



// verifica se a string contém apenas letras
var letras="abcdefghyjklmnopqrstuvwxyz";

function apenas_letras(texto)
{
   texto = texto.toLowerCase();
   for(i=0; i<texto.length; i++)
   {
      if (letras.indexOf(texto.charAt(i),0)!=-1)
      {
         return 1;
      }
   }
   return 0;
}

// verifica se a string contém apenas números
var numeros="0123456789";

function apenas_nums(texto)
{
   for(i=0; i<texto.length; i++)
   {
      if (numeros.indexOf(texto.charAt(i),0)!=-1)
      {
         return 1;
      }
   }
   return 0;
}
