<?php namespace site\src\dao;

use DateTime;
use PDO;
use site\src\models\Demand; 

class DemandDao
{
    public function insert(Demand $data)
    {
        if(is_null($data)) return false; 
        $query = "INSERT INTO DEMAND VALUES (NULL, {$data->getIdCitizan()}, {$data->getIdAdmin()}, '{$data->getTypeConstruction()}', {$data->getSpace()},'{$data->getState()}','{$data->getAddress()}', NULL)";
        if(!Database::getConnection()->exec($query)) return false;         
        return true;
    }

    public function select(array $params = [])
    {
        $query = "SELECT * FROM DEMAND";
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
            $dateDeclared = DateTime::createFromFormat('Y-m-d H:i:s', $value["dateDeclared"]);
            
            return new Demand($value["id"], $value["idCitizan"], $value["idAdmin"],$value["typeConstruction"], $value["space"],$value["state"], $value["address"], $dateDeclared);
        }, array_values($stmt->fetchAll()));
        
        return $finalRes; 
    }
    
    public function delete(int $id)
    {
        //delete demandes
        $sql = "DELETE FROM DEMAND WHERE id = $id";
        Database::getConnection()->prepare($sql)->execute();
    }
}
?>