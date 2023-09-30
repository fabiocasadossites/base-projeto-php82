var urlbase = $('link[rel="base"]').attr("href");

$(function () {
  // CRIANDO VARIAVEIS DE LINKS
  var urlphp = "" + urlbase + "php/php.php";

  // PEGANDO A CLASSE ENVIAR E ATRIBUINDO O SUBMIT NO TYPO DO FORM
  var botao = $(".enviar");
  botao.attr("type", "submit");

  // PEGANDO TODOS OS FORMS E CANCELANDO O ENVIO PELO NAVEGADO E TRAZENDO PARA O JQUERY
  var forms = $("form");
  forms.submit(function () {
    return false;
  });

  // CONFIGURANDO OP AJAX
  $.ajaxSetup({
    url: urlphp,
    type: "POST",
    error: "",
  });

  //INICIANDO O SHODOWBOX
  Shadowbox.init();

  // MASCARAS DE FORMULÁRIOS COM CLASSE SERVE PARA VÁRIOS E ID APENAS UM INPUT
  $("#mascara_celular").mask("(99)99999-9999");

  // MASCARA DE VALOR MONETÁRIO EM INPUT COM CLASSE SERVE PARA VÁRIOS E ID APENAS UM INPUT
  $("#mascara_valor").maskMoney({
    showSymbol: true,
    symbol: "",
    decimal: ",",
    thousands: ".",
    allowZero: false,
  });

  // MASCARA PARA DATE EM INPUT COM CLASSE SERVE PARA VÁRIOS E ID APENAS UM INPUT
  $("#dataapenasdodia").datepicker({
    language: "pt-BR",
    minDate: new Date(),
  });

  // PEGA TODOS OS SELECTS E TRANSFORMA EM DINÁMICO
  $("select").select2();
});
