<?php

namespace App\Helpers;

/**
 * Check.class [ HELPER ]
 * CLASSE E RESPONSÁVEL PARA VALIDAR OS DADOS.
 * @copyright (c) 2014 ~ 2021, Fabio Augusto CASA DOS SITES
 */
class Check
{

  private static $Data;
  private static $Format;

  /**
   * ****************************************
   * ********** VALIDA E-MAIL ***************
   * ****************************************
     COMO USAR:
   * *****************************************
     $Email = 'contato@casadossites.com';
     if(Check::Email($Email)):
     echo 'Válido!';
     else:
     echo 'inválido!';
     endif;
   */
  public static function Email($Email)
  {
    self::$Data = (string) $Email;
    self::$Format = '/[a-z0-9_\.\-]+@[a-z0-9_\.\-]*[a-z0-9_\.\-]+\.[a-z]{2,4}$/';

    if (preg_match(self::$Format, self::$Data)) :
      return true;
    else :
      return false;
    endif;
  }

  /**
   * ****************************************
   * ********** CRIAR URL AMIGÁVEIS  ********
   * ****************************************
     COMO USAR:
   * *****************************************
     $nome = 'Estamos aprendendo PHP. Veja você com é!';
     echo  Check::Name($nome);
   */
  public static function Name($Name)
  {
    self::$Format = array();
    self::$Format['a'] = 'ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÚÛÜüÝÞßàáâãäåæçèéêëìíîïðñòóôõöøùúûýýþÿRr"!@#$%&*()_-+={[}]/?;:.,\\\'<>°ºª';
    self::$Format['b'] = 'aaaaaaaceeeeiiiidnoooooouuuuuybsaaaaaaaceeeeiiiidnoooooouuuyybyRr                                 ';

    self::$Data = strtr(utf8_decode($Name), utf8_decode(self::$Format['a']), self::$Format['b']);
    self::$Data = strip_tags(trim(self::$Data));
    self::$Data = str_replace(' ', '-', self::$Data);
    self::$Data = str_replace(array('-----', '----', '---', '--'), '-', self::$Data);

    return strtolower(utf8_encode(self::$Data));
  }

  /**
   * ****************************************
   * ****** VALIDAR FORMATO DA DATA  ********
   * ****************************************
     COMO USAR:
   * *****************************************
     $data = '27/11/2016 10:00:00';
     Esta e a formatação padrão sem o $format;
     Caso chame o $format você pode criar o padrão que quiser;
     exemplo: $format = 'Y-m-d';
     echo  Check::validaData($date, $format);
   */
  public static function validaData($date, $format = 'd/m/Y H:i:s')
  {
    if (!empty($date) && $v_date = date_create_from_format($format, $date)) {
      $v_date = date_format($v_date, $format);
      return ($v_date && $v_date == $date);
    }
    return false;
  }

  public static function validaData__($dat)
  {
    $data = explode("/", "$dat"); // fatia a string $dat em pedados, usando / como referência
    $d = $data[0];
    $m = $data[1];
    $y = $data[2];

    // verifica se a data é válida!
    // 1 = true (válida)
    // 0 = false (inválida)
    $res = checkdate($m, $d, $y);
    if ($res == 1) {
      return true;
    } else {
      return false;
    }
  }

  /**
   * ****************************************
   * *ALTERAR FORMATO DA DATA COM HORA *****
   * ****************************************
     COMO USAR:
   * *****************************************
     $data = '27/11/2016 10:00:00'; = $format = true
     $data = '2016-11-27 10:00:00'; = $format = null
     echo  Check::alterarDataHora($dateHora, $format = null);
   */
  public static function alterarDataHora($dateHora, $format = null)
  {

    if ($format) :
      $data_final_data = Check::TimesData(substr($dateHora, 0, 10));
      $data_final_data_hora = substr($dateHora, 11, 18);
      return $data_final = $data_final_data . ' ' . $data_final_data_hora;
    else :
      $data_final_data = Check::Datastamp(substr($dateHora, 0, 10));
      $data_final_data_hora = substr($dateHora, 11, 18);
      return $data_final = $data_final_data . ' ' . $data_final_data_hora;
    endif;
  }

  /**
   * ****************************************
   * ***** TRANSFORMA DATA EM TIMESTAMP  ****
   * ****************************************
     COMO USAR:
   * *****************************************
     $data = '05/01/2014';
     echo Check::Datastamp($data);
   */
  public static function Datastamp($Data)
  {
    self::$Format = explode(' ', $Data);
    self::$Data = explode('/', self::$Format[0]);

    //if (empty(self::$Format[1])):
    //  self::$Format[1] = date('H:i:s');
    // endif;

    self::$Data = self::$Data[2] . '-' . self::$Data[1] . '-' . self::$Data[0]; //. ' ' . self::$Format[1];
    return self::$Data;
  }

  /**
   * ****************************************
   * ***** TRANSFORMA TIMESTAMP EM DATA  ****
   * ****************************************
     COMO USAR:
   * *****************************************
     $data = '2015-01-15';
     echo Check::TimesData($data);
   */
  public static function TimesData($Data)
  {
    self::$Format = explode(' ', $Data);
    self::$Data = explode('-', self::$Format[0]);

    //        if (empty(self::$Format[1])):
    //            self::$Format[1] = date('H:i:s');
    //        endif;

    self::$Data = self::$Data[2] . '/' . self::$Data[1] . '/' . self::$Data[0];
    return self::$Data;
  }

  /**
   * ****************************************
   * ******* LIMITADOR DE PALAVRAS  *********
   * ****************************************
     COMO USAR:
   * *****************************************
     $string = 'Olá mundo, estamos estudando PHP na Casa dos sites!';
     echo Check::Limitador($string, 5, '. <small>Continuer lendo</small>');
   */
  public static function Limitador($String, $Limite, $Pointer = null)
  {
    self::$Data = strip_tags(trim($String));
    self::$Format = (int) $Limite;

    $ArrWords = explode(' ', self::$Data);
    $NumWords = count($ArrWords);
    $NewWords = implode(' ', array_slice($ArrWords, 0, self::$Format));

    $Pointer = (empty($Pointer) ? '...' : ' ' . $Pointer);
    $Result = (self::$Format < $NumWords ? $NewWords . $Pointer : self::$Data);
    return $Result;
  }

  /**
   * ****************************************
   * ****** LIMITADOR DE CARACTERES  ********
   * ****************************************
     COMO USAR:
   * *****************************************
     $string = 'Olá mundo, estamos estudando PHP na Casa dos sites!';
     echo Check::limitcaracter($string, 5,);
   */
  public static function limitcaracter($texto, $limite, $quebra = true)
  {
    $tamanho = strlen($texto);
    // Verifica se o tamanho do texto é menor ou igual ao limite
    if ($tamanho <= $limite) {
      $novo_texto = $texto;
      // Se o tamanho do texto for maior que o limite
    } else {
      // Verifica a opção de quebrar o texto
      if ($quebra == true) {
        $novo_texto = trim(substr($texto, 0, $limite)) . '...';
        // Se não, corta $texto na última palavra antes do limite
      } else {
        // Localiza o útlimo espaço antes de $limite
        $ultimo_espaco = strrpos(substr($texto, 0, $limite), ' ');
        // Corta o $texto até a posição localizada
        $novo_texto = trim(substr($texto, 0, $ultimo_espaco)) . '...';
      }
    }
    // Retorna o valor formatado
    return $novo_texto;
  }


  /**
   * ****************************************
   * ******* CRIADOR CODIGOS       **********
   * ****************************************
     COMO USAR:
   * *****************************************
     Check::NewPass($tamanho = 8, $maiusculas = true, $numeros = true, $simbolos = false);
   */
  public static function NewPass($tamanho = 8, $maiusculas = true, $numeros = true, $simbolos = false)
  {
    $lmin = 'abcdefghijklmnopqrstuvwxyz';
    $lmai = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $num = '1234567890';
    $simb = '!@#$%*-';
    $retorno = '';
    $caracteres = '';

    $caracteres .= $lmin;
    if ($maiusculas) :
      $caracteres .= $lmai;
    endif;
    if ($numeros) :
      $caracteres .= $num;
    endif;
    if ($simbolos) :
      $caracteres .= $simb;
    endif;

    $len = strlen($caracteres);
    for ($n = 1; $n <= $tamanho; $n++) {
      $rand = mt_rand(1, $len);
      $retorno .= $caracteres[$rand - 1];
    }
    return $retorno;
  }


  /**
   * ****************************************
   * ********** criar mascara numéricas ************
   * ****************************************
     COMO USAR:
   * *****************************************
   * ex: $val = 92992483522 
   * $mask =(##)######### 
   * Returna (92)992484522
     echo Check::mask($val, $mask);
   */
  public static function mask($val, $mask)
  {
    $maskared = '';
    $k = 0;
    for ($i = 0; $i <= strlen($mask) - 1; $i++) {
      if ($mask[$i] == '#') {
        if (isset($val[$k])) {
          $maskared .= $val[$k++];
        }
      } else {
        if (isset($mask[$i])) {
          $maskared .= $mask[$i];
        }
      }
    }
    return $maskared;
  }


  /**
   * ****************************************
   * ********** Verifica CPF ************
   * ****************************************
     COMO USAR:
   * *****************************************
   * ex: $cpf = 99999999999
   * Retorno tru ou false 
     echo Check::validaCPF($cpf);
   */
  public static function validaCPF($cpf)
  {

    // Extrai somente os números
    $cpf = preg_replace('/[^0-9]/is', '', $cpf);

    // Verifica se foi informado todos os digitos corretamente
    if (strlen($cpf) != 11) {
      return false;
    }

    // Verifica se foi informada uma sequência de digitos repetidos. Ex: 111.111.111-11
    if (preg_match('/(\d)\1{10}/', $cpf)) {
      return false;
    }

    // Faz o calculo para validar o CPF
    for ($t = 9; $t < 11; $t++) {
      for ($d = 0, $c = 0; $c < $t; $c++) {
        $d += $cpf[$c] * (($t + 1) - $c);
      }
      $d = ((10 * $d) % 11) % 10;
      if ($cpf[$c] != $d) {
        return false;
      }
    }
    return true;
  }

  /**
   * ****************************************
   * ********** Verifica CNPJ ************
   * ****************************************
     COMO USAR:
   * *****************************************
   * ex: $cpf = 9999999999999999
   * Retorno tru ou false 
     echo Check::validaCNPJ($cnpj);
   */
  public static function validaCNPJ($cnpj)
  {
    $cnpj = preg_replace('/[^0-9]/', '', (string) $cnpj);

    // Valida tamanho
    if (strlen($cnpj) != 14)
      return false;

    // Verifica se todos os digitos são iguais
    if (preg_match('/(\d)\1{13}/', $cnpj))
      return false;

    // Valida primeiro dígito verificador
    for ($i = 0, $j = 5, $soma = 0; $i < 12; $i++) {
      $soma += $cnpj[$i] * $j;
      $j = ($j == 2) ? 9 : $j - 1;
    }

    $resto = $soma % 11;

    if ($cnpj[12] != ($resto < 2 ? 0 : 11 - $resto))
      return false;

    // Valida segundo dígito verificador
    for ($i = 0, $j = 6, $soma = 0; $i < 13; $i++) {
      $soma += $cnpj[$i] * $j;
      $j = ($j == 2) ? 9 : $j - 1;
    }

    $resto = $soma % 11;

    return $cnpj[13] == ($resto < 2 ? 0 : 11 - $resto);
  }


  /**
   * ****************************************
   * ****** Será senha para o banco *********
   * ****************************************
     COMO USAR:
   * *****************************************
   * ex: $data = 9999999999999999
   * Retorno senha para gravar no banco de dados
     echo Check::senhaform($data);
   */
  public static function senhaform($data)
  {
    $senha = password_hash($data, PASSWORD_DEFAULT);
    return $senha;
  }


  /**
   * ****************************************
   * ****** Comparar a senha do banco *********
   * ****************************************
     COMO USAR:
   * *****************************************
   * ex: $senhaform = senha que vem do formulário
   * ex: $senhadb = senha que está gravada no banco
   * Retorno true ou false
     echo Check::senhadb($data);
   */
  public static function senhadb($senhaform, $senhadb)
  {
    if (password_verify($senhaform, $senhadb)) {
      return true;
    } else {
      return false;
    }
  }


  /**
   * ****************************************
   * ****** Faz a limpeza total de uma variável *********
   * ****************************************
     COMO USAR:
   * *****************************************
   * ex: $data = (92)99999-999 9
   * Retorno 92999999999
     echo Check::limpezaTotal($data);
   */
  public static function limpezaTotal($data)
  {
    $data = str_replace("(", "", $data);
    $data = str_replace(")", "", $data);
    $data = str_replace("-", "", $data);
    $data = str_replace("_", "", $data);
    $data = str_replace("/", "", $data);
    $data = str_replace("\/", "", $data);
    $data = str_replace(" ", "", $data);
    $data = str_replace(".", "", $data);
    $data = str_replace(",", "", $data);
    $data = str_replace(";", "", $data);
    $data = str_replace("  ", "", $data);
    $data = str_replace(":", "", $data);
    $data = str_replace("?", "", $data);
    $data = str_replace("[", "", $data);
    $data = str_replace("]", "", $data);
    $data = str_replace("%", "", $data);
    $data = str_replace("@", "", $data);
    $data = str_replace("*", "", $data);
    $data = str_replace("#", "", $data);
    $data = str_replace("!", "", $data);
    return $data;
  }

  /**
   * ****************************************
   * ****** Faz a limpeza total de uma variável *********
   * ****************************************
     COMO USAR:
   * *****************************************
   * ex: $data = (92)99999-999 9
   * Retorno 92999999999
     echo Check::limpezaTotal($data);
   */
  public static function valor_original($data)
  {
    $data = str_replace(" ", "", $data);
    $data = str_replace(".", "", $data);
    $data = str_replace(",", ".", $data);
    return $data;
  }
}
