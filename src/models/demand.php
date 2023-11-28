<?php namespace site\src\models;

use DateTime;

class Demand
{
    private int $id;    
    private int $idCitizan; 
    private int $idAdmin;
    private string $typeConstruction; 
    private float $space; 
    private string $state;
    private string $address;
    private DateTime $dateDeclared; 

    public function __construct(int $id,int $idCitizan, int $idAdmin, string $typeConstruction,float $space, string $state, string $address, DateTime $dateDeclared)
    {
        $this->id = $id; 
        $this->idCitizan = $idCitizan; 
        $this->idAdmin = $idAdmin; 
        $this->typeConstruction = $typeConstruction; 
        $this->space = $space; 
        $this->state = $state; 
        $this->address = $address; 
        $this->dateDeclared = $dateDeclared; 
    }

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getDateDeclared()
    {
        return $this->dateDeclared;
    }

    public function setDateDeclared($dateDeclared)
    {
        $this->dateDeclared = $dateDeclared;
    }

    public function getState()
    {
        return $this->state;
    }
    
    public function setState($state)
    {
        $this->state = $state;
    }

    public function getIdCitizan()
    {
        return $this->idCitizan;
    }

    public function setIdCitizan($idCitizan)
    {
        $this->idCitizan = $idCitizan;
    }

    public function getIdAdmin()
    {
        return $this->idAdmin;
    }

    public function setIdAdmin($idAdmin)
    {
        $this->idAdmin = $idAdmin;
    }

    public function getTypeConstruction()
    {
        return $this->typeConstruction;
    }

    public function setTypeConstruction($typeConstruction)
    {
        $this->typeConstruction = $typeConstruction;
    }

    public function getSpace()
    {
        return $this->space;
    }

    public function setSpace($space)
    {
        $this->space = $space;
    }

    public function getAddress()
    {
        return $this->address;
    }

    public function setAddress($address)
    {
        $this->address = $address;
    }
}

?>