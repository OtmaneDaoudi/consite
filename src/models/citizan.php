<?php namespace site\src\models;

use DateTime;

class Citizan extends User
{
    private string $cin;
    private DateTime $birthDate; 
    private string $address; 
    private string $phoneNumber;
    private string $gender; 

    public function __construct(int $id, string $firstName, string $lastName, string $email,string $gender, string $password, string $cin, DateTime $birthDate, string $address, string $phoneNumber)
    {
        parent::__construct($id, $firstName, $lastName, $email, $password); 
        $this->cin = $cin; 
        $this->birthDate = $birthDate;
        $this->address = $address;
        $this->phoneNumber = $phoneNumber; 
        $this->gender = $gender;
    }
    public function getCin()
    {
        return $this->cin;
    }

    public function setCin($cin)
    {
        $this->cin = $cin;
    }

    public function getBirthDate()
    {
        return $this->birthDate;
    }

    public function setBirthDate($birthDate)
    {
        $this->birthDate = $birthDate;
    }
    public function getAddress()
    {
        return $this->address;
    }

    public function setAddress($address)
    {
        $this->address = $address;
    }

    public function getPhoneNumber()
    {
        return $this->phoneNumber;
    }

    public function setPhoneNumber($phoneNumber)
    {
        $this->phoneNumber = $phoneNumber;
    }

    public function getGender()
    {
        return $this->gender;
    }

    public function setGender($gender)
    {
        $this->gender = $gender;
    }
}
?>