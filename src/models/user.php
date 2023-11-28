<?php namespace site\src\models; 

class User
{
    private int $id; 
    private string $firstName;
    private string $lastName;
    private string $email;
    private string $password; //hashed

    public function __construct(int $id, string $firstName, string $lastName, string $email, string $password)
    {
        $this->id = $id; 
        $this->firstName =$firstName; 
        $this->lastName = $lastName;
        $this->email = $email; 
        $this->password = $password;
    }
    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getFirstName()
    {
        return $this->firstName;
    }

    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;
    }

    public function getLastName()
    {
        return $this->lastName;
    }

    public function setLastName($lastName)
    {
        $this->lastName = $lastName;
    }
    public function getEmail()
    {
        return $this->email;
    }
    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function setPassword($password)
    {
        $this->password = $password;
    }
}
?>