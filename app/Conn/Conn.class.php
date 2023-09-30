<?php

/**
 * Conn.class [ CONEÇÃO ]
 * Classe abstrata de coneção. Padrão Singleton.
 * Retorna um objeto PDO pelo método estático getCoon();
 * @copyright (c) 2014, Fabio Augusto CASA DOS SITES
 */
class Conn
{

    /** @var PDO */
    private static $Connect = null;

    /** conecta com o banco de dados com pattern singleton
     * retorna um objeto PDO
     */
    private static function Connectar()
    {
        try {
            if (self::$Connect == NULL) :
                $dsn = 'mysql:host=' . HOST . ';dbname=' . DBSA;
                $options = [PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES UTF8'];
                self::$Connect = new PDO($dsn, USER, PASS, $options);
            endif;
        } catch (PDOException $e) {
            echo  $e->getCode();
            echo $e->getMessage();
            echo $e->getFile();
            echo $e->getLine();
            die; 
        }
        self::$Connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return self::$Connect;
    }

    /** Retorna um objeto PDO singleton patterm. */
    public static function getConn()
    {
        return self::Connectar();
    }
}
