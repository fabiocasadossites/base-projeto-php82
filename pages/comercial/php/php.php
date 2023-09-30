<?php
date_default_timezone_set("America/Sao_Paulo");
setlocale(LC_ALL, 'pt_BR');
require '../../../Bootstrap/app.php';

//GERENCIAR AS FUNÇÕES DE AUXILIO
use App\Helpers\Check as HelpersCheck;

//CLASSE DE AUTENTICAÇÃO
use App\Helpers\Authenticate;

$envia_email = new App\Helpers\EnvioEmail();

$dataHora = date('Y-m-d H:i:s');
$hora = date('H:i:s');
$data = date('Y-m-d');

$acao = trim(strip_tags($_POST['acao']));

// VERIFICAR SE O CÓDIGO DE ATUENTICAÇÃO NÃO EXPIROU
if ($_POST['valid'] == '' || $acao == '') {
    $dados = [
        "recarregar" => "",
        "page" => "",
        "message" => "<div class='alerta error alertas' style='width: 100%'><p style='margin-bottom: 0;'>Desculpe, existem campos em branco 2</p></div>",
    ];
    echo $retorno = json_encode($dados);
    exit();
}

$autenticar = new Authenticate;
$validar = $autenticar->autenticarJWT($_POST['valid']);

if ($validar != 7) {
    if ($validar == 6) {
        $dados = [
            "status" => "error",
            "code" => "6",
            "message" => "<div class='alerta error alertas' style='width: 100%'><p style='margin-bottom: 0;'>Desculpe, a autenticação falhou</p></div>",
        ];
        echo $retorno = json_encode($dados);
        exit();
    } elseif ($validar == 2) {
        $dados = [
            "status" => "error",
            "code" => "2",
            "message" => "<div class='alerta error alertas' style='width: 100%'><p style='margin-bottom: 0;'>Desculpe, você não tem permissão para acessar esse sistema.</p></div>",
        ];
        echo $retorno = json_encode($dados);
        exit();
    } elseif ($validar == 3) {
        $dados = [
            "status" => "error",
            "code" => "3",
            "message" => "<div class='alerta error alertas' style='width: 100%'><p style='margin-bottom: 0;'>Desculpe, você não tem permissão para acessar o sistema de outro ip.</p></div>",
        ];
        echo $retorno = json_encode($dados);
        exit();
    } elseif ($validar == 4) {
        $dados = [
            "status" => "error",
            "code" => "4",
            "message" => "<div class='alerta error alertas' style='width: 100%'><p style='margin-bottom: 0;'>Desculpe, seu token expirou atualize sua página para atualizar seu token.</p></div>",
        ];
        echo $retorno = json_encode($dados);
        exit();
    } elseif ($validar == 5) {
        $dados = [
            "status" => "error",
            "code" => "5",
            "message" => "<div class='alerta error alertas' style='width: 100%'><p style='margin-bottom: 0;'>Desculpe, seu token está inválido, atualize a página e tente novamente.</p></div>",
        ];
        echo $retorno = json_encode($dados);
        exit();
    }
}
// FIM DE VERIFICAR SE O CÓDIGO DE ATUENTICAÇÃO NÃO EXPIROU


switch ($acao) {
}
