<?php

namespace App\Helpers;

use Firebase\JWT\JWT;

class Authenticate
{
    //public $valid;

    public function gerarJWT()
    {
        $chave_acesso = strtotime(date('Y-m-d') . ' ' . date('H:i:s')) . '|' . HOME . '|' . '|' . JWT . '|';

        $key = JWT;
        $payload = array(
            "chave" => base64_encode($chave_acesso),
        );
        $jwt = JWT::encode($payload, $key);
        return $jwt;
    }

    public function autenticarJWT($code)
    {
        $key = JWT;
        try {
            $decoded = JWT::decode($code, $key, array('HS256'));
        } catch (\Exception $e) {
            return 6;
        }

        $encript = base64_decode($decoded->chave);

        if ($encript) {
            $encript = explode("|", $encript);

            if ($encript['1'] != HOME) {
                return 2;
            }
            $data_transacao = $encript['0'];
            $hoje_verificar = strtotime(date("Y-m-d H:i:s", strtotime('+120 minutes')));

            if ($hoje_verificar < $data_transacao) {
                return 4;
            }
        } else {
            return 5;
        }
        return 7;
    }
}
