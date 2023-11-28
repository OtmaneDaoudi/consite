<?php namespace site\src\dao;

use DateTime;
use PDO;
use site\src\models\Discussion;

class DiscussionDao
{
    public function select(array $params = [])
    {
        $query = "SELECT * FROM DISCUSSION";
        if(count($params) != 0) $query = $query." WHERE "; 
        $appendAnd = false; 
        foreach($params as $column => $value)
        {
            $query = $query.($appendAnd ? " AND " : "")." {$column} = ".(is_string($value) ? "'$value'" : $value);
            if(!$appendAnd) $appendAnd = true; 
        } 

        $stmt = Database::getConnection()->prepare($query);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_ASSOC); 

        $finalRes = array_map(function($value)
        {            
            return new Discussion($value["idDemand"], $value["message"], $value["sens"]);
        }, array_values($stmt->fetchAll()));
        
        return $finalRes; 
    }

    public function insert(Discussion $data)
    {
        if(is_null($data)) return false; 
        $query = "INSERT INTO DISCUSSION VALUES ({$data->getIdDemand()}, '{$data->getMessage()}', '{$data->getSens()}')";
        if(!Database::getConnection()->exec($query)) return false;         
        return true;
    }
}

?>