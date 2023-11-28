<?php
require_once("../vendor/autoload.php");

use site\src\controllers\loginController;
use site\src\dao\UserDao;

$validEmail = true;
$showModal = false;

if (isset($_POST["submit"])) {
    $controller = new loginController();
    $emails = array_map(function ($value) {
        return $value->getEmail(); }, (new UserDao())->select());
    if (!in_array($_POST["email"], $emails))
        $validEmail = false;
    else //valid email
    {
        $controller->forgorPassword($_POST["email"]); 
        $showModal = true; 
    }
}

?>

<!DOCTYPE html>
<html>

<head>
    <!-- Basic Page Info -->
    <meta charset="utf-8" />
    <title>Forgot password</title>

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet" />
    <!-- CSS -->
    <link rel="stylesheet" type="text/css" href="../public/css/core.css" />
    <link rel="stylesheet" type="text/css" href="../public/css/icon-font.min.css" />
    <link rel="stylesheet" type="text/css" href="../public/css/style.css" />
</head>

<body>
    <div class="login-header box-shadow">
        <div class="container-fluid d-flex justify-content-between align-items-center">
            <div class="brand-logo">
                <a href="index.php">
                    <img src="../public/images/deskapp-logo.svg" alt="" />
                </a>
            </div>
            <div class="login-menu">
                <ul>
                    <li><a href="index.php">Login</a></li>
                </ul>
            </div>
        </div>
    </div>
    <div class="login-wrap d-flex align-items-center flex-wrap justify-content-center">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <img src="../public/images/forgot-password.png" alt="" />
                </div>
                <div class="col-md-6">
                    <div class="login-box bg-white box-shadow border-radius-10">
                        <div class="login-title">
                            <h2 class="text-center text-primary">Forgot Password</h2>
                        </div>
                        <h6 class="mb-20">
                            Enter your email address to reset your password
                        </h6>
                        <form action="" method="POST">
                            <div class="input-group custom">
                                <input type="email" class="form-control form-control-lg" placeholder="Email"
                                    name="email" required />
                                <div class="input-group-append custom">
                                    <span class="input-group-text"><i class="fa fa-envelope-o"
                                            aria-hidden="true"></i></span>
                                </div>
                            </div>
                            <?php
                            if (!$validEmail)
                                echo "<p style=\"text-align: center;height: 10px;color: red;\">Emais does not exists</p><br>";
                            ?>
                            <div class="row align-items-center">
                                <div class="col-5">
                                    <div class="input-group mb-0">
                                        <input class="btn btn-primary btn-lg btn-block" type="submit" value="Submit"
                                            name="submit">
                                    </div>
                                </div>
                                <div class="col-2">
                                    <div class="font-16 weight-600 text-center" data-color="#707373">
                                        OR
                                    </div>
                                </div>
                                <div class="col-5">
                                    <div class="input-group mb-0">
                                        <a class="btn btn-outline-primary btn-lg btn-block" href="index.php">Login</a>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <a href="#" id="toClick" class="btn-block" data-toggle="modal" data-target="#success-modal" type="button"></a>
    <div class="modal fade" id="success-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-body text-center font-18">
                    <h3 class="mb-20">Form Submitted!</h3>
                    <div class="mb-30 text-center">
                        <img src="../public/images/success.png" />
                    </div>
                    Email sent!<br>
                    An email with new credentials has been sent to that email!
                    <br>
                </div>
                <div class="modal-footer justify-content-center">
                    <button type="button" class="btn btn-primary" data-dismiss="modal"
                        onclick="window.location.replace('index.php');">
                        Done
                    </button>
                </div>
            </div>
        </div>
        <?php
        if ($showModal)
            echo "<script>document.addEventListener('DOMContentLoaded', function(){document.getElementById('toClick').click();console.log('clicked');})</script>";
        ?>
    </div>
    <!-- js -->
    <script src="../public/js//core.js"></script>
    <script src="../public/js/script.min.js"></script>
    <script src="../public/js/process.js"></script>
    <script src="../public/js/layout-settings.js"></script>
</body>

</html>