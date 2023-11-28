<?php

use site\src\dao\DiscussionDao;
use site\src\models\Discussion;

require_once("../../vendor/autoload.php");

//suppose all set
$dao = new DiscussionDao(); 
echo $_GET["id"]." ".$_POST["msgText"];
$discussion = new Discussion($_GET["id"], $_POST["msgText"], 'CA');
$dao->insert($discussion); 
header("Location: support.php?id={$_GET["id"]}");
?>