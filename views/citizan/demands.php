<?php
use site\src\controllers\CitizanController;

require_once("../../vendor/autoload.php");

$controller = new CitizanController();

session_start();
$citizan = unserialize($_SESSION["user"]);
$demands = $controller->fetchDemands();
?>
<!DOCTYPE html>
<html>

<head></head>
<!-- Basic Page Info -->
<meta charset="utf-8" />
<title>Demands</title>

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
                        <span class="user-name"><?= $citizan->getFirstName() . " " . $citizan->getLastName() ?></span>
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
            <h3 class="weight-600 font-16 text-blue">
                Layout Settings
                <span class="btn-block font-weight-400 font-12">User Interface Settings</span>
            </h3>
            <div class="close-sidebar" data-toggle="right-sidebar-close">
                <i class="icon-copy ion-close-round"></i>
            </div>
        </div>
        <div class="right-sidebar-body customscroll">
            <div class="right-sidebar-body-content">
                <h4 class="weight-600 font-18 pb-10">Sidebar Background</h4>
                <div class="sidebar-btn-group pb-30 mb-10">
                    <a href="javascript:void(0);" class="btn btn-outline-primary sidebar-light">White</a>
                    <a href="javascript:void(0);" class="btn btn-outline-primary sidebar-dark active">Dark</a>
                </div>

                <h4 class="weight-600 font-18 pb-10">Menu Dropdown Icon</h4>
                <div class="sidebar-radio-group pb-10 mb-10">
                    <div class="custom-control custom-radio custom-control-inline">
                        <input type="radio" id="sidebaricon-1" name="menu-dropdown-icon" class="custom-control-input"
                            value="icon-style-1" checked="" />
                        <label class="custom-control-label" for="sidebaricon-1"><i class="fa fa-angle-down"></i></label>
                    </div>
                    <div class="custom-control custom-radio custom-control-inline">
                        <input type="radio" id="sidebaricon-2" name="menu-dropdown-icon" class="custom-control-input"
                            value="icon-style-2" />
                        <label class="custom-control-label" for="sidebaricon-2"><i class="ion-plus-round"></i></label>
                    </div>
                    <div class="custom-control custom-radio custom-control-inline">
                        <input type="radio" id="sidebaricon-3" name="menu-dropdown-icon" class="custom-control-input"
                            value="icon-style-3" />
                        <label class="custom-control-label" for="sidebaricon-3"><i
                                class="fa fa-angle-double-right"></i></label>
                    </div>
                </div>

                <h4 class="weight-600 font-18 pb-10">Menu List Icon</h4>
                <div class="sidebar-radio-group pb-30 mb-10">
                    <div class="custom-control custom-radio custom-control-inline">
                        <input type="radio" id="sidebariconlist-1" name="menu-list-icon" class="custom-control-input"
                            value="icon-list-style-1" checked="" />
                        <label class="custom-control-label" for="sidebariconlist-1"><i
                                class="ion-minus-round"></i></label>
                    </div>
                    <div class="custom-control custom-radio custom-control-inline">
                        <input type="radio" id="sidebariconlist-2" name="menu-list-icon" class="custom-control-input"
                            value="icon-list-style-2" />
                        <label class="custom-control-label" for="sidebariconlist-2"><i class="fa fa-circle-o"
                                aria-hidden="true"></i></label>
                    </div>
                    <div class="custom-control custom-radio custom-control-inline">
                        <input type="radio" id="sidebariconlist-3" name="menu-list-icon" class="custom-control-input"
                            value="icon-list-style-3" />
                        <label class="custom-control-label" for="sidebariconlist-3"><i class="dw dw-check"></i></label>
                    </div>
                    <div class="custom-control custom-radio custom-control-inline">
                        <input type="radio" id="sidebariconlist-4" name="menu-list-icon" class="custom-control-input"
                            value="icon-list-style-4" checked="" />
                        <label class="custom-control-label" for="sidebariconlist-4"><i
                                class="icon-copy dw dw-next-2"></i></label>
                    </div>
                    <div class="custom-control custom-radio custom-control-inline">
                        <input type="radio" id="sidebariconlist-5" name="menu-list-icon" class="custom-control-input"
                            value="icon-list-style-5" />
                        <label class="custom-control-label" for="sidebariconlist-5"><i
                                class="dw dw-fast-forward-1"></i></label>
                    </div>
                    <div class="custom-control custom-radio custom-control-inline">
                        <input type="radio" id="sidebariconlist-6" name="menu-list-icon" class="custom-control-input"
                            value="icon-list-style-6" />
                        <label class="custom-control-label" for="sidebariconlist-6"><i class="dw dw-next"></i></label>
                    </div>
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
                        <a href="demands.php" class="dropdown-toggle no-arrow">
                            <span class="micon bi bi-list-nested"></span><span class="mtext">Demands</span>
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
        <div class="xs-pd-20-10 pd-ltr-10">
            <div class="card-box pb-10">
                <div class="h5 pd-20 mb-0">Demands:</div>
                <table class="data-table table nowrap">
                    <thead>
                        <tr>
                            <th>Type</th>
                            <th>Space (m²)</th>
                            <th>State</th>
                            <th>Address</th>
                            <th>Date declared</th>
                            <th class="datatable-nosort">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($demands as $demand): ?>
                            <tr>
                                <td><?= $demand->getTypeConstruction() ?></td>
                                <td><?= $demand->getSpace() ?></td>
                                <td>
                                    <span class="badge badge-pill" data-bgcolor=<?php if ($demand->getState() == 'Processing')
                                        echo "#e7ebf5";
                                    else if ($demand->getState() == 'Accepted')
                                        echo "#90EE90"; 
                                    else
                                        echo "#F75D59" ?> data-color="#000000"
                                                style="font-size: small;"><?= $demand->getState() ?></span>
                                </td>
                                <td><?= $demand->getAddress() ?></td>
                                <td><?= $demand->getDateDeclared()->format('Y-m-d') ?></td>
                                <td>
                                    <div class="table-actions">
                                        <?php if($demand->getState() == 'Rejected'){echo "<a href=\"support.php?id={$demand->getId()}\" data-color=\"#e95959\"><i class=\"dw dw-support\" style=\"color: blue;\"></i></a";}else{echo "<a data-color=\"#e95959\"><i class=\"dw dw-support\" style=\"color: grey;pointer-events: none;\"></i></a";}?>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
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
    <script src="../../public/js/datatable-setting.js"></script>
</body>

</html>