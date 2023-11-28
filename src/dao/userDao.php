<?php namespace site\src\dao; 

use \PDO;
use site\src\models\User;

class UserDao
{
    public function select(array $params = [])
    {
        $query = "SELECT * FROM USER";
        $checkPassword = false; 

        if(count($params) != 0) $query = $query." WHERE ";  
        $appendAnd = false; 
        foreach($params as $column => $value)
        {
            if(strcmp($column, "password") == 0) 
            {
                $checkPassword = true; 
                continue; //skip password in where clause => check later for hash
            }
            $query = $query.($appendAnd ? " AND " : "")." {$column} = ".(is_string($value) ? "'$value'" : $value);
            if(!$appendAnd) $appendAnd = true; 
        } 

        $stmt = Database::getConnection()->query($query, PDO::FETCH_ASSOC);
        $result = $stmt->fetchAll(); 
        
        //password filter
        if($checkPassword)
        {
            $password = $params["password"];
            $result = array_filter($result, function($value) use ($password){
                return password_verify($password, $value["password"]);
            }); 
        }

        //encapsulate result
        $finalRes = array_map(function($value)
        {
            return new User($value["id"], $value["firstName"], $value["lastName"], $value["email"], $value["password"]);
        }, array_values($result)); 
        
        return $finalRes;
    }

    public function getLastId() : int
    {
        $stmt = Database::getConnection()->prepare("SELECT MAX(id) AS TOTAL FROM USER");
        $stmt->execute();
        return $stmt->fetchColumn();
    }

    public function updatePassword($password, $email)
    {
        $hashed = password_hash($password, PASSWORD_DEFAULT);
        Database::getConnection()->prepare("UPDATE USER SET PASSWORD = '$hashed' WHERE EMAIL = '$email'")->execute(); 
    }
} 
?>