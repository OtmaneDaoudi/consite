<?php
namespace site\src\dao;

use DateTime;
use PDO;
use site\src\models\Citizan;

class CitizanDao
{
    public function select(array $params = [])
    {
        $query = "SELECT * FROM CITIZAN JOIN USER ON USER.id = CITIZAN.id";
        if (count($params) != 0)
            $query = $query . " WHERE ";
        $appendAnd = false;
        foreach ($params as $column => $value) {
            $query = $query . ($appendAnd ? " AND " : "") . (strcmp($column, "id") == 0 ? " USER." : '') . "{$column} = " . (is_string($value) ? "'$value'" : $value);
            if (!$appendAnd)
                $appendAnd = true;
        }
        $stmt = Database::getConnection()->prepare($query);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_ASSOC);

        $finalRes = array_map(function ($value) {
            $birthDate = DateTime::createFromFormat('Y-m-d', $value["birthDate"]);

            return new Citizan($value["id"], $value["firstName"], $value["lastName"], $value["email"], $value["gender"], $value["password"], $value["cin"], $birthDate, $value["address"], $value["phoneNumber"]);
        }, array_values($stmt->fetchAll()));

        return $finalRes;
    }
    public function insert(Citizan $data)
    {
        if (is_null($data))
            return false;
        $userDao = new userDao();

        $hashedPassword = password_hash($data->getPassword(), PASSWORD_DEFAULT);
        $query1 = "INSERT INTO USER VALUES (NULL, '{$data->getFirstName()}', '{$data->getLastName()}', '{$data->getEmail()}', '$hashedPassword')";
        if (!Database::getConnection()->exec($query1))
            return false;

        $lastID = $userDao->getLastId();
        $query2 = "INSERT INTO CITIZAN VALUES ($lastID, '{$data->getCin()}', '{$data->getBirthDate()->format("Y-m-d")}','{$data->getGender()}',  '{$data->getAddress()}', '{$data->getPhoneNumber()}')";

        if (!Database::getConnection()->exec($query2))
            return false;
        return true;
    }

    public function delete(int $id)
    {
        // delete discussions
        $sql = "DELETE FROM DISCUSSION WHERE idDemand in (SELECT idDemand FROM DEMAND WHERE idCitizan = $id)";
        $stmt = Database::getConnection()->prepare($sql)->execute();

        // delete demandes
        $sql = "DELETE FROM DEMAND WHERE idCitizan = $id";
        $stmt = Database::getConnection()->prepare($sql)->execute();

        // delete citizan
        $sql = "DELETE FROM CITIZAN WHERE id = $id";
        $stmt = Database::getConnection()->prepare($sql)->execute();

        // delete user
        $sql = "DELETE FROM USER WHERE id = $id";
        $stmt = Database::getConnection()->prepare($sql)->execute();
    }
}
?>