<?php
use site\src\controllers\CitizanController;
use site\src\dao\DemandDao;
use site\src\dao\DiscussionDao;
use site\src\dao\UserDao;

require_once("../../vendor/autoload.php");

$controller = new CitizanController();

session_start();
$citizan = unserialize($_SESSION["user"]);

$selectedDemand = -1; 
$admin = null; 
$discussion = null; 

$controller = new CitizanController(); 
$demands = array_filter($controller->fetchDemands(), function($value){return $value->getState() === 'Rejected';}); 

if(isset($_GET["id"])) //show support for a given demand
{
    $selectedDemand = $_GET["id"]; 
    $admin = (new UserDao())->select(['id' => (new DemandDao())->select(["id" => $selectedDemand])[0]->getIdAdmin()])[0];
    $discussion = (new DiscussionDao())->select(["idDemand" => $selectedDemand]); 
}

?>

<!DOCTYPE html>
<html>

<head></head>
<!-- Basic Page Info -->
<meta charset="utf-8" />
<title>Support</title>

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
                        <span class="user-name">
                            <?= $citizan->getFirstName() . " " . $citizan->getLastName() ?>
                        </span>
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
    <div class="main-container" style="padding-top: 80px;">
        <div class="xs-pd-20-10">
            <div class="">
                <div class="bg-white border-radius-4 box-shadow mb-30">
                    <div class="row no-gutters" >
                        <div class="col-lg-3 col-md-4 col-sm-12">
                            <div class="chat-list bg-light-gray" style="height: 100%;">
                                <div class="notification-list chat-notification-list customscroll" style="height: 105%;">
                                    <ul>
                                        <!-- demands menue -->
                                        <?php foreach($demands as $demand): ?>
                                            <!-- add active to a demand to make it selected -->
                                            <li <?php if($demand->getId() == $selectedDemand){echo "class=\"active\"";}?>> 
                                                <a href="<?php echo "support.php?id={$demand->getId()}" ?>">
                                                    <img src="../../public/images/photo1.jpg" alt="" />
                                                    <h3 class="clearfix"><?="Demand ".$demand->getId()?></h3>
                                                </a>
                                            </li>
                                        <?php endforeach; ?>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-9 col-md-8 col-sm-12">
                            <div class="chat-detail">
                                <div class="chat-profile-header clearfix">
                                    <div class="left">
                                        <?php if($selectedDemand != -1 ) :?> 
                                            <div class="clearfix">
                                                <div class="chat-profile-photo">
                                                    <img src="../../public/images/photo1.jpg" alt="" />
                                                </div>
                                                <div class="chat-profile-name">
                                                    <h3><?= $admin->getFirstName()." ".$admin->getLastName()?></h3>
                                                </div>
                                            </div>
                                        <?php else: ?>
                                            <div class="clearfix" style="height: 50px;"></div>
                                        <?php endif ?>
                                    </div>
                                </div>
                                <div class="chat-box" style="height: 105%;">
                                    <div class="chat-desc customscroll">
                                        <ul>
                                            <?php if($selectedDemand != -1): ?>
                                            <?php foreach($discussion as $msg): ?>
                                                <li class="clearfix <?= ($msg->getSens() === 'AC') ? "admin_chat" : ""?>" style="height: 30px;">
                                                    <span class="chat-img">
                                                        <img src="../../public/images/photo1.jpg" alt="" />
                                                    </span>
                                                    <div class="chat-body clearfix">
                                                        <p style="width: fit-content;"><?= $msg->getMessage()?></p>
                                                    </div>
                                                </li>
                                            <?php endforeach; ?>
                                            <?php endif; ?>
                                        </ul>
                                    </div>
                                    <div class="chat-footer">
                                        <div class="file-upload">
                                            <a href="#"><i class="fa fa-paperclip"></i></a>
                                        </div>
                                        <form <?php if($selectedDemand != -1){echo "method=\"POST\" action=\"sendMessage.php?id={$_GET["id"]}\"";} ?>>
                                            <div class="chat_text_area">
                                                <textarea placeholder="Type your message…" name="msgText" maxlength="100"></textarea>
                                            </div>
                                            <div class="chat_send">
                                                <button class="btn btn-link" type="submit" name="msgSent">
                                                    <i class="icon-copy ion-paper-airplane"></i>
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
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