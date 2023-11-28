<?php 
use site\src\controllers\loginController;
use site\src\models\Admin;
use site\src\models\Citizan;

require_once "../vendor/autoload.php"; 

//logout
session_start();
unset($_SESSION['user']);

if(isset($_POST["submit"])) 
{
	$controller = new LoginController(); 
	$user = null; 
	if(($user = $controller->login($_POST)) !== false)        
	{
		$location = ''; 
		if($user instanceof Admin) $location = "admin/users.php";
		elseif($user instanceof Citizan) $location = "citizan/demands.php"; 
		header("Location: $location"); 
	}
}
?>

<!DOCTYPE html>
<html>

<head>
    <!-- Basic Page Info -->
    <meta charset="utf-8" />
    <title>Login</title>

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet" />
    <!-- CSS -->
    <link rel="stylesheet" type="text/css" href="../public/css/core.css" />
    <link rel="stylesheet" type="text/css" href="../public/css/icon-font.min.css" />
    <link rel="stylesheet" type="text/css" href="../public/css/style.css" />
</head>

<body class="login-page">
    <div class="login-header box-shadow">
        <div class="container-fluid d-flex justify-content-between align-items-center">
            <div class="brand-logo" style="width: 80%; margin: auto;">
                <a href="#" >
                    <!-- main logo -->
                    <img src="../public/images/deskapp-logo.svg" alt="logo"/> 
                </a>
            </div>
        </div>
    </div>
    <div class="login-wrap d-flex align-items-center flex-wrap justify-content-center">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6 col-lg-7">
                    <img src="../public/images/login-page-img.png" alt="" />
                </div>
                <div class="col-md-6 col-lg-5">
                    <div class="login-box bg-white box-shadow border-radius-10">
                        <div class="login-title">
                            <h2 class="text-center text-primary">Login</h2>
                        </div>
                        <form method="POST" action="index.php">
                            <div class="input-group custom">
                                <input type="text" class="form-control form-control-lg" placeholder="Email" name="email"/>
                                <div class="input-group-append custom">
                                    <span class="input-group-text"><i class="icon-copy dw dw-user1"></i></span>
                                </div>
                            </div>
                            <div class="input-group custom">
                                <input type="password" class="form-control form-control-lg" placeholder="**********" name="password"/>
                                <div class="input-group-append custom">
                                    <span class="input-group-text"><i class="dw dw-padlock1"></i></span>
                                </div>
                            </div>
                            <div class="row pb-30">
                                <div class="col-6">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="customCheck1" />
                                        <label class="custom-control-label" for="customCheck1">Remember</label>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="forgot-password">
                                        <a href="forgotPassword.php">Forgot Password</a>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="input-group mb-0">                                        
                                        <input class="btn btn-primary btn-lg btn-block" type="submit" name="submit">                                       
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- js -->
    <script src="../public/js/core.js"></script>
    <script src="../public/js/script.min.js"></script>
    <script src="../public/js/process.js"></script>
    <script src="../public/js/layout-settings.js"></script>
</body>

</html>