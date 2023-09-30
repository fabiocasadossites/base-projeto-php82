<?php
require __DIR__ . '/Bootstrap/app.php';

use Pecee\SimpleRouter\SimpleRouter;

/*
----------------------------------------------------------------------------------------------
## ACESSAR O SERVIDOR LOCAL NA SUA MAQUINA

Digite esse comando no terminal
-> composer server 
----------------------------------------------------------------------------------------------
*/

try {

  SimpleRouter::setDefaultNamespace('App\Controller');

  /*
    ROTAS DO SITE
    */
  SimpleRouter::get('/', 'Web@home');
  /*
    ROTAS DE ERRO
    */
  SimpleRouter::get('/404', 'Web@oops404');
  SimpleRouter::start();
} catch (Pecee\SimpleRouter\Exceptions\NotFoundHttpException $ex) {
  header("location: 404");
  //echo $ex->getMessage();

}
