<?php

use site\src\controllers\AdminController;
use site\src\dao\CitizanDao;
use site\src\models\Citizan;

require_once("../../vendor/autoload.php");

session_start();
$admin = unserialize($_SESSION['user']);

$state = "";

$validEmail = true;
$validCin = true;

$firstName = "";
$lastName = "";
$email = '';
$gender = '';
$cin = '';
$birthDate = '';
$address = '';
$phone = "";

if (isset($_POST["save"])) //form submitted
{
	$state = "submitted";

	$controller = new AdminController();
	$cins = $controller->getAllCins();
	$emails = $controller->getAllEmails();

	$firstName = $_POST["firstName"];
	$lastName = $_POST["lastName"];
	$email = $_POST["email"];
	$gender = $_POST["gender"];
	$cin = $_POST["cin"];
	$birthDate = $_POST["birthDate"];
	$address = $_POST["address"];
	$phone = $_POST["phoneNumber"];

	//chcek email and cin
	if (in_array($_POST["email"], $emails))
		$validEmail = false; //not a valid email
	else if (in_array($_POST["cin"], $cins))
		$validCin = false; //not a valid   cin 
	else {
		$characters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNsOPQRSTUVWXYZ';
		$randomString = '';
		for ($i = 0; $i < 10; $i++)
			$randomString .= $characters[mt_rand(0, strlen($characters) - 1)];
		$bd = DateTime::createFromFormat("d M Y", $_POST["birthDate"]);
		$newCitizan = new Citizan(-1, $firstName, $lastName, $email, $gender, $randomString, $cin, $bd, $address, $phone);
		(new CitizanDao())->insert($newCitizan);

		//send email
		$controller->sendEmailToUser($email, $randomString);
	}
}
?>
<!DOCTYPE html>
<html>

<head></head>
<!-- Basic Page Info -->
<meta charset="utf-8" />
<title>Add new citizan</title>

<!-- Google Font -->
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap"
	rel="stylesheet" />
<!-- CSS -->
<link rel="stylesheet" type="text/css" href="../../public/css/core.css" />
<link rel="stylesheet" type="text/css" href="../../public/css/icon-font.min.css" />
<link rel="stylesheet" type="text/css" href="../../public/plugins/datatables/css/dataTables.bootstrap4.min.css" />
<link rel="stylesheet" type="text/css" href="../../public/plugins/datatables/css/responsive.bootstrap4.min.css" />
<link rel="stylesheet" type="text/css" href="../../public/css/style.css" />

</head>

<body>
	<div class="header">
		<div class="header-left">
		</div>
		<div class="header-right">
			<div class="user-info-dropdown" style="padding-right: 10%;">
				<div class="dropdown">
					<a class="dropdown-toggle" href="#" role="button" data-toggle="dropdown">
						<span class="user-icon">
							<img src="../../public/images//photo1.jpg" alt="" />
						</span>
						<span class="user-name"><?= $admin->getFirstName() . " " . $admin->getLastName() ?></span>
					</a>
					<div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
						<a class="dropdown-item" href="../index.php"><i class="dw dw-logout"></i> Log Out</a>
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
					<a href="javascript:void(0);" class="btn btn-outline-primary sidebar-light">White</a>
					<a href="javascript:void(0);" class="btn btn-outline-primary sidebar-dark active">Dark</a>
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
			<a href="#">
				<img src="../../public/images/deskapp-logo.svg" alt="" class="dark-logo" />
				<img src="../../public/images/deskapp-logo-white.svg" alt="" class="light-logo" />
			</a>
		</div>
		<div class="menu-block customscroll" style="background-color: white;">
			<div class="sidebar-menu">
				<ul id="accordion-menu">
					<li>
						<a href="users.php" class="dropdown-toggle no-arrow">
							<span class="micon bi bi-people"></span><span class="mtext">Citizans</span>
						</a>
					</li>
					<li>
						<a href="demands.php" class="dropdown-toggle no-arrow">
							<span class="micon bi bi-list-nested"></span><span class="mtext">Demands</span>
						</a>
					</li>
					<li>
						<a href="addUser.php" class="dropdown-toggle no-arrow">
							<span class="micon bi bi-person-plus"></span><span class="mtext">Add Citizan</span>
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
							<span class="micon bi bi-chat-right-dots"></span><span class="mtext">Support</span>
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
					<h4 class="text-blue h4">Add new citizan</h4>
				</div>
			</div>
			<form method="POST" action="addUser.php">
				<div class="form-group row">
					<label class="col-sm-12 col-md-2 col-form-label">First name</label>
					<div class="col-sm-12 col-md-10">
						<input class="form-control" type="text" maxlength="15" name="firstName" value="<?= $firstName ?>"
							required />
					</div>
				</div>
				<div class="form-group row">
					<label class="col-sm-12 col-md-2 col-form-label">Last name</label>
					<div class="col-sm-12 col-md-10">
						<input class="form-control" type="text" maxlength="15" name="lastName" value="<?= $lastName ?>"
							required />
					</div>
				</div>
				<div class="form-group row">
					<label class="col-sm-12 col-md-2 col-form-label">Email</label>
					<div class="col-sm-12 col-md-10">
						<input class="form-control" type="email" maxlength="25" name="email" value="<?= $email ?>"
							autocomplete="off" required />
						<?php if ($state == "submitted" && !$validEmail)
							echo "<p style=\"color: red;margin-left: 5px;height: 2px;\">Email already taken</p>" ?>
						</div>
					</div>
					<div class="form-group row">
						<label class="col-sm-12 col-md-2 col-form-label">CIN</label>
						<div class="col-sm-12 col-md-10">
							<input class="form-control" type="text" maxlength="7" name="cin" value="<?= $cin ?>" required />
						<?php if ($state == "submitted" && !$validCin)
							echo "<p style=\"color: red;margin-left: 5px;height: 2px;\">CIN already taken</p>" ?>
						</div>
					</div>
					<div class="form-group row">
						<label class="col-sm-12 col-md-2 col-form-label">Select</label>
						<div class="col-sm-12 col-md-10">
							<select class="custom-select col-12" name="gender">
								<option value="Male" selected="">Male</option>
								<option value="Female">Female</option>
							</select>
						</div>
					</div>
					<div class="form-group row">
						<label class="col-sm-12 col-md-2 col-form-label">Birth date</label>
						<div class="col-sm-12 col-md-10">
							<input class="form-control date-picker" placeholder="Select Date" type="text" name="birthDate"
								value="<?= $birthDate ?>" required />
					</div>
				</div>
				<div class="form-group row">
					<label class="col-sm-12 col-md-2 col-form-label">Address</label>
					<div class="col-sm-12 col-md-10">
						<input class="form-control" type="text" maxlength="50" name="address" value="<?= $address ?>"
							required />
					</div>
				</div>
				<div class="form-group row">
					<label class="col-sm-12 col-md-2 col-form-label">Telephone</label>
					<div class="col-sm-12 col-md-10">
						<input class="form-control" maxlength="13" placeholder="Ex: +212612345678" type="tel"
							name="phoneNumber" value="<?= $phone ?>" required />
					</div>
				</div>
				<input type="submit" class="btn btn-primary" value="Save" name="save"
					style="width: 20%; margin-left: 40%;"></input>
			</form>
			<!-- Default Basic Forms End -->
			<a href="#" id="toClick" class="btn-block" data-toggle="modal" data-target="#success-modal" type="button"></a>
			<div class="modal fade" id="success-modal" tabindex="-1" role="dialog"
				aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
				<div class="modal-dialog modal-dialog-centered" role="document">
					<div class="modal-content">
						<div class="modal-body text-center font-18">
							<h3 class="mb-20">Form Submitted!</h3>
							<div class="mb-30 text-center">
								<img src="../../public/images/success.png" />
							</div>
							User successfully created<br>
							An Email is sent to
							<?= $email ?><br>
						</div>
						<div class="modal-footer justify-content-center">
							<button type="button" class="btn btn-primary" data-dismiss="modal"
								onclick="window.location.replace('users.php');">
								Done
							</button>
						</div>
					</div>
				</div>
				<?php
				if ($state == "submitted" && $validCin && $validEmail)
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