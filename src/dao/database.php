<?php namespace site\src\dao;

use \PDO;
use \PDOException;

class Database
{
    private static $connection; 
    const server = "localhost";
    const username = "root";
    const dbname = "construction";

    public function __construct()
    {
        try
        {
            $connection = new PDO("mysql:host=".self::server.";dbname=".self::dbname, self::username, "");
            $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
        catch(PDOException $e)
        {
            die("couldn't establish connection");
        }
    }

    public static function getConnection() : PDO
    {
        if(is_null(self::$connection))
        {
            try
            {
                self::$connection = new PDO("mysql:host=".self::server.";dbname=".self::dbname, self::username, "");
                self::$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            }
            catch(PDOException $e)
            {
                die("couldn't establish connection");
            }    
        }
        return self::$connection; 
    }
}
?>