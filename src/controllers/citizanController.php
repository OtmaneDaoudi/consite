<?php namespace site\src\controllers;

use site\src\dao\DemandDao;
use site\src\dao\DiscussionDao;

class CitizanController
{
    public function fetchDemands()
    {
        // session_start();
        return (new DemandDao())->select(["idCitizan" => unserialize($_SESSION["user"])->getId()]);    
    }


    // public function fethcDiscussions()
    // {
    //     return (new DiscussionDao())->select(["idCitizan" => unserialize($_SESSION["user"])->getId()]);
    // }
}

?>