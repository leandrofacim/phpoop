<?php

namespace Sts\Models\helper;

use PDO;
use PDOException;

if (!defined('URL')) {
    header('Location: /');
    exit();
}

/**
 * Description of StsConn
 *
 * copyrigt (c) year, Leandro Facim
 */
class StsConn
{
    public static $host = HOST;
    public static $user = USER;
    public static $pass = PASS;
    public static $dbname = DB_NAME;
    private static $connect = null;

    /**
     * @method Responsavel pela conexão com a base de dados
     * 
     * @return conexão
     */
    private static function conectar()
    {
        try {
            if (self::$connect === null) {
                self::$connect = new PDO(
                    'mysql:host=' . self::$host . ';dbname=' . self::$dbname,
                    self::$user,
                    self::$pass
                );
            }
        } catch (PDOException $ex) {
            // echo 'message: ' . $ex->getMessage();
            return false;
        }
        return self::$connect;
    }

    public function getConn()
    {
        return $this->conectar();
    }
}
