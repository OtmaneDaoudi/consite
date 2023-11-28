<?php namespace site\src\models; 

class Discussion
{
    private int $idDemand;
    private string $message; 
    private string $sens;
    
    
    public function __construct(int $idDemand, string $message, string $sens)
    {
        $this->idDemand = $idDemand; 
        $this->message = $message; 
        $this->sens = $sens; 
    }

    public function getIdDemand()
    {
        return $this->idDemand;
    }

    public function setIdDemand($idDemand)
    {
        $this->idDemand = $idDemand;
    }

    public function getMessage()
    {
        return $this->message;
    }
    public function setMessage($message)
    {
        $this->message = $message;
    }

    public function getSens()
    {
        return $this->sens;
    }

    public function setSens($sens)
    {
        $this->sens = $sens;
    }
}
?>