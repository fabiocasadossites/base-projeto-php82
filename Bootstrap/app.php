<?php
session_start();
date_default_timezone_set("America/Sao_Paulo");
setlocale(LC_ALL, 'pt_BR');

// CHAMANDO O AUTOLOAD
require __DIR__ . '/../vendor/autoload.php';

$_SESSION['tentativas'] = '0';

if (getenv('MINIFIER') == '1') {
    //CSS
    $minCSS = new \MatthiasMullie\Minify\CSS();
    $minCSS->add("src/styles/styles.css");
    $minCSS->add("src/styles/boot.css");
    $minCSS->add("src/icones/style.min.css");
    $minCSS->add("src/select2/select2.min.css");
    $minCSS->add("src/jPages/jPages.css");
    $minCSS->add("src/hover/hover.css");
    $minCSS->add("src/datepicker/dist/css/datepicker.min.css");
    $minCSS->add("src/animate/animate.css");
    $minCSS->add("src/styles/responsive.css");
    $minCSS->add("src/styles/shawdonbox/shadowbox.css");

    $minCSS->minify("src/styles/styles_min.css");

    //JAVASCRIPT
    $minJS = new \MatthiasMullie\Minify\JS();
    $minJS->add("src/js/modernizr.min.js");
    $minJS->add("src/js/html5shiv.js");
    $minJS->add("src/js/jquery-atual.js");
    $minJS->add("src/js/jquery.form.js");
    $minJS->add("src/jPages/jPages.js");
    $minJS->add("src/select2/select2.full.min.js");
    $minJS->add("src/datepicker/dist/js/datepicker.min.js");
    $minJS->add("src/datepicker/dist/js/i18n/datepicker.pt-BR.js");
    $minJS->add("src/js/rxscroll.min.js");
    $minJS->add("src/js/mascaradedinheiro.js");
    $minJS->add("src/js/mascaradata.js");
    $minJS->add("src/js/shadowbox.js");
    $minJS->add("src/js/js.js");

    $minJS->minify("src/js/js_min.js");
}
