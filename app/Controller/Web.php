<?php

namespace App\Controller;

// UAR A LEITURA DO BANCO DE DADOS SE HOUVER
use Read;

// USAR AS FUNÇÕES DE AUXÍLIO
use App\Helpers\Check as HelpersCheck;

class Web
{
    public function home(): void
    {
        echo "<h1>Em desenvolvimento</h1>";
    }

    public function oops404(): void
    {
        $loader = new \Twig\Loader\FilesystemLoader('pages/comercial/');
        $twig = new \Twig\Environment($loader, [
            'cache' => 'pages/cache/',
            'cache' => false,
        ]);
        $template = $twig->load('404.html');
        $valores = array(
            "HOME" => HOME, // PÁGINA CARNICAL
            "TITLE" => "OOOPS", // TÍTULO DA PÁGINA
            "MINIFIER" => MINIFIER, // CONFIGURAÇÃO DO MINIFICADOR
            "HOME_PAGE" => HOME . "/pages/comercial", // ENDEREÇO COMPLETO DA PÁGINA
            "EMPRESA" => "", // NOME DA EMPRESA DESENVOLVEDORA
            "DESCRICAO" => "", // DESCRIÇÃO DA PÁGINA
        );
        echo $template->render($valores);
    }
}
