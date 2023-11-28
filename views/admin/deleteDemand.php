<?php 

require_once("../../vendor/autoload.php");

use site\src\controllers\AdminController;

if(isset($_POST["submit"]))
{
    $controller = new AdminController();
    $controller->deleteDemand($_POST["demandId"]);
    header("Location: demands.php");
}

?>