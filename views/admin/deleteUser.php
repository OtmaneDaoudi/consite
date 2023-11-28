<?php

use site\src\controllers\AdminController;

require_once("../../vendor/autoload.php"); 

if(isset($_POST["submit"]))
{
    $id = $_POST["userId"]; 
    $controller = new AdminController(); 
    $controller->deleteCitizan($id); 
    header("Location: users.php");
}
?>