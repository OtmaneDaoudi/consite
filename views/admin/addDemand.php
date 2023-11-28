<?php
use site\src\controllers\AdminController;
use site\src\models\Demand;

require_once("../../vendor/autoload.php"); 


$state = ''; 

session_start(); 
$admin = unserialize($_SESSION["user"]);

$controller = new AdminController(); 
$citizans = $controller->fetchCitizans(); 

if(isset($_POST["save"])) //form submitted
{
    $demand = new Demand(-1, $_POST["citizanId"], $admin->getId(), $_POST["typeConstruction"], $_POST["space"], "Processing",$_POST['address'],new DateTime());
    if($controller->addDemand($demand)) $state = "added";
}
?>
<!DOCTYPE html>
<html>
	<head></head>
		<!-- Basic Page Info -->
		<meta charset="utf-8" />
		<title>Add new demand</title>

		<!-- Google Font -->
		<link
			href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap"
			rel="stylesheet"
		/>
		<!-- CSS -->
		<link rel="stylesheet" type="text/css" href="../../public/css/core.css" />
		<link
			rel="stylesheet"
			type="text/css"
			href="../../public/css/icon-font.min.css"
		/>
		<link
			rel="stylesheet"
			type="text/css"
			href="../../public/plugins/datatables/css/dataTables.bootstrap4.min.css"
		/>
		<link
			rel="stylesheet"
			type="text/css"
			href="../../public/plugins/datatables/css/responsive.bootstrap4.min.css"
		/>
		<link rel="stylesheet" type="text/css" href="../../public/css/style.css" />

	</head>
	<body>
        <div class="header">
            <div class="header-left">
			</div>
			<div class="header-right">
				<div class="user-info-dropdown" style="padding-right: 10%;">
					<div class="dropdown">
						<a
							class="dropdown-toggle"
							href="#"
							role="button"
							data-toggle="dropdown"
                            >
							<span class="user-icon">
								<img src="../../public/images//photo1.jpg" alt="" />
							</span>
							<span class="user-name"><?=$admin->getFirstName()." ".$admin->getLastName()?></span>
						</a>
						<div
							class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list"
						>
							<a class="dropdown-item" href="../index.php"
								><i class="dw dw-logout"></i> Log Out</a
							>
						</div>
					</div>
				</div>
			</div>
		</div>

		<div class="right-sidebar">
			<div class="sidebar-title">
			</div>
			<div class="right-sidebar-body customscroll">
				<div class="right-sidebar-body-content">
					<div class="sidebar-btn-group pb-30 mb-10">
						<a
							href="javascript:void(0);"
							class="btn btn-outline-primary sidebar-light"
							>White</a
						>
						<a
							href="javascript:void(0);"
							class="btn btn-outline-primary sidebar-dark active"
							>Dark</a
						>
					</div>
					<div class="reset-options pt-30 text-center">
						<button class="btn btn-danger" id="reset-settings">
							Reset Settings
						</button>
					</div>
				</div>
			</div>
		</div>
        
		<div class="left-side-bar">
			<div class="brand-logo" style="background-color: white;">
				<a href="#" >
					<img src="../../public/images/deskapp-logo.svg" alt="" class="dark-logo" />
					<img
						src="../../public/images/deskapp-logo-white.svg"
						alt=""
						class="light-logo"
                        />
                    </a>
			</div>
			<div class="menu-block customscroll" style="background-color: white;">
				<div class="sidebar-menu">
					<ul id="accordion-menu">
						<li>
							<a href="users.php" class="dropdown-toggle no-arrow">
								<span class="micon bi bi-people"></span
								><span class="mtext">Citizans</span>
							</a>
						</li>
						<li>
                            <a href="demands.php" class="dropdown-toggle no-arrow">
                                <span class="micon bi bi-list-nested"></span
								><span class="mtext">Demands</span>
							</a>
						</li>
						<li>
                            <a href="addUser.php" class="dropdown-toggle no-arrow">
                                <span class="micon bi bi-person-plus"></span
								><span class="mtext">Add Citizan</span>
							</a>
						</li>
						<li>
                            <a href="addDemand.php" class="dropdown-toggle no-arrow">
                                <span class="micon bi bi-list-ul"></span>
								<span class="mtext">Add demand</span>
							</a>
						</li>
						<li>
                            <a href="support.php" class="dropdown-toggle no-arrow">
                                <span class="micon bi bi-chat-right-dots"></span
								><span class="mtext">Support</span>
							</a>
						</li>
					</ul>
				</div>
			</div>
		</div>
		<div class="mobile-menu-overlay"></div>
		<div class="main-container">
            <!-- Default Basic Forms Start -->
            <div class="pd-20 card-box mb-30">
                    <div class="clearfix">
                        <div class="pull-left">
                            <h4 class="text-blue h4">Add new demand</h4>
                        </div>
                    </div>
                    <form method="POST" action="addDemand.php">
                        <div class="form-group row">
                            <label class="col-sm-12 col-md-2 col-form-label">Citizan</label>
                            <div class="col-sm-12 col-md-10">
                                <select class="custom-select col-12" name="citizanId">
                                    <?php foreach($citizans as $citizan): ?>
                                        <option value="<?= $citizan->getId()?>" ><?=$citizan->getFirstName()." ".$citizan->getLastName()?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-12 col-md-2 col-form-label">Type of construction</label>
                            <div class="col-sm-12 col-md-10">
                                <select class="custom-select col-12" name="typeConstruction">
                                    <option value="Cafe" selected>Cafe</option>
                                    <option value="House">House</option>
                                    <option value="Residance">Residance</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-12 col-md-2 col-form-label">Space (m²)</label>
                            <div class="col-sm-12 col-md-10">
                                <input class="form-control" type="number" step="0.5" autocomplete="off" maxlength="10" name="space" required/>
                            </div>
                        </div>
                        
                        <div class="form-group row">
                            <label class="col-sm-12 col-md-2 col-form-label">Address</label>
                            <div class="col-sm-12 col-md-10">
                                <input class="form-control" type="text" maxlength="50" name="address" autocomplete="off" required />
                            </div>
                        </div>
                        <input type="submit" class="btn btn-primary" value="Save" name="save" style="width: 20%; margin-left: 40%;"></input>
                    </form>                
                </div>
                <a href="#" id="toClick" class="btn-block" data-toggle="modal" data-target="#success-modal" type="button" style="display: none;"></a>
                    <div class="modal fade" id="success-modal" tabindex="-1" role="dialog"
                        aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-body text-center font-18">
                                    <h3 class="mb-20">Form Submitted!</h3>
                                    <div class="mb-30 text-center">
                                        <img src="../../public/images/success.png" />
                                    </div>
                                    Demand has been successfully issued.
                                </div>
                                <div class="modal-footer justify-content-center">
                                    <button type="button" class="btn btn-primary" data-dismiss="modal" onclick="window.location.replace('demands.php');">
                                        Done
                                    </button>
                                </div>
                            </div>
                        </div>
                        <?php
                            if($state == "added")
                                echo "<script>document.addEventListener('DOMContentLoaded', function(){document.getElementById('toClick').click();console.log('clicked');})</script>";
                        ?>
                </div>
		</div>
		<!-- js -->
		<script src="../../public/js/core.js"></script>
		<script src="../../public/js/script.min.js"></script>
		<script src="../../public/js/process.js"></script>
		<script src="../../public/js/layout-settings.js"></script>
		<!-- <script src="src/plugins/apexcharts/apexcharts.min.js"></script> -->
		<script src="../../public/plugins/datatables/js/jquery.dataTables.min.js"></script>
		<script src="../../public/plugins/datatables/js/dataTables.bootstrap4.min.js"></script>
		<script src="../../public/plugins/datatables/js/dataTables.responsive.min.js"></script>
		<script src="../../public/plugins/datatables/js/responsive.bootstrap4.min.js"></script>
	</body>
</html>