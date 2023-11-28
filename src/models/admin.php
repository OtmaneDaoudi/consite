<?php namespace site\src\models;

class Admin extends User
{
    public function __construct(int $id, string $firstName, string $lastName, string $email, string $password)
    {
        parent::__construct($id, $firstName, $lastName, $email, $password); 
    }
}
?>