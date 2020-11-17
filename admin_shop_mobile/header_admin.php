<?php 
  require_once("../connection.inc.php"); 

  if(!isset($_SESSION['ADMIN_LOGIN']) && empty($_SESSION['ADMIN_LOGIN'])){
    header("Location:".ROUTE_AJAX_URL."index.php");
  }
?>

<!DOCTYPE html>
<html lang="en">
<!-- BEGIN HEAD -->
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1" name="viewport" />
    <meta name="description" content="Responsive Admin Template" />
    <meta name="author" content="SmartUniversity" />
    <title><?php defined("SITE_TITLE") ?  print_r(SITE_TITLE) : ""; ?></title>
    <!-- google font -->
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" rel="stylesheet" type="text/css" />
	<!-- icons -->
    <link href="<?php defined("ADMIN_LOGIN_LINK_URL") ?  print_r(ADMIN_LOGIN_LINK_URL) : ""; ?>plugins/simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css" />
    <link href="<?php defined("ADMIN_LOGIN_LINK_URL") ?  print_r(ADMIN_LOGIN_LINK_URL) : ""; ?>plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
	<!--bootstrap -->
	<link href="<?php defined("ADMIN_LOGIN_LINK_URL") ?  print_r(ADMIN_LOGIN_LINK_URL) : ""; ?>plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
	<link href="<?php defined("ADMIN_LOGIN_LINK_URL") ?  print_r(ADMIN_LOGIN_LINK_URL) : ""; ?>plugins/summernote/summernote.css" rel="stylesheet">
	<!-- morris chart -->
    <link href="<?php defined("ADMIN_LOGIN_LINK_URL") ?  print_r(ADMIN_LOGIN_LINK_URL) : ""; ?>plugins/morris/morris.css" rel="stylesheet" type="text/css" />
    <!-- Material Design Lite CSS -->
	<link rel="stylesheet" href="<?php defined("ADMIN_LOGIN_LINK_URL") ?  print_r(ADMIN_LOGIN_LINK_URL) : ""; ?>plugins/material/material.min.css">
	<link rel="stylesheet" href="<?php defined("ADMIN_LOGIN_LINK_URL") ?  print_r(ADMIN_LOGIN_LINK_URL) : ""; ?>css/material_style.css">
	<!-- animation -->
	<link href="<?php defined("ADMIN_LOGIN_LINK_URL") ?  print_r(ADMIN_LOGIN_LINK_URL) : ""; ?>css/pages/animate_page.css" rel="stylesheet">
	<!-- Template Styles -->
    <link href="<?php defined("ADMIN_LOGIN_LINK_URL") ?  print_r(ADMIN_LOGIN_LINK_URL) : ""; ?>css/plugins.min.css" rel="stylesheet" type="text/css" />
    <link href="<?php defined("ADMIN_LOGIN_LINK_URL") ?  print_r(ADMIN_LOGIN_LINK_URL) : ""; ?>css/style.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="<?php defined("ADMIN_LOGIN_LINK_URL") ?  print_r(ADMIN_LOGIN_LINK_URL) : ""; ?>css/custom_style.css">
    <link href="<?php defined("ADMIN_LOGIN_LINK_URL") ?  print_r(ADMIN_LOGIN_LINK_URL) : ""; ?>css/responsive.css" rel="stylesheet" type="text/css" />
    <link href="<?php defined("ADMIN_LOGIN_LINK_URL") ?  print_r(ADMIN_LOGIN_LINK_URL) : ""; ?>css/theme-color.css" rel="stylesheet" type="text/css" />
	<!-- favicon -->
    <link rel="shortcut icon" href="<?php defined("ADMIN_LOGIN_LINK_URL") ?  print_r(ADMIN_LOGIN_LINK_URL) : ""; ?>img/favicon.png" /> 
 </head>
 
 <!-- END HEAD -->
  <body class="page-header-fixed sidemenu-closed-hidelogo page-content-white page-md header-white dark-sidebar-color logo-dark" style="min-height: 0 !important;">
    <div class="page-wrapper">
      <!-- start header -->
      <div class="page-header navbar navbar-fixed-top">
        <div class="page-header-inner ">
          <!-- logo start -->
          <div class="page-logo">
            <a href="<?php  defined("ROUTE_AJAX_URL") ?  print_r(ROUTE_AJAX_URL) : ""; ?>dashboard.php">
              <img alt="" src="<?php defined("ADMIN_LOGIN_LINK_URL") ?  print_r(ADMIN_LOGIN_LINK_URL) : "";?>logo/13.png" style="width:50px;" class="img-fluid">
              <span class="logo-default" >
                <?php 
                  $_SESSION['ADMIN_ROLE'] === '1' ? print_r($_SESSION['ADMIN_USERNAME']) : print_r(DEFAULT_NAME);
                    
                ?>
              </span> 
            </a>
          </div>
          <!-- logo end -->
          <ul class="nav navbar-nav navbar-left in">
            <li><a href="#" class="menu-toggler sidebar-toggler"><i class="icon-menu"></i></a></li>
          </ul>
          <form class="search-form-opened" action="#" method="GET">
            <div class="input-group">
                <input type="text" class="form-control" placeholder="Search..." name="query">
                <span class="input-group-btn search-btn">
                  <a href="javascript:;" class="btn submit">
                      <i class="icon-magnifier"></i>
                    </a>
                </span>
            </div>
          </form>
          <!-- start mobile menu -->
          <a href="javascript:;" class="menu-toggler responsive-toggler" data-toggle="collapse" data-target=".navbar-collapse">
              <span></span>
          </a>
          <!-- end mobile menu -->
          <!-- start header menu -->
          <div class="top-menu">
            <ul class="nav navbar-nav pull-right">
              <!-- start manage user dropdown -->
              <li class="dropdown dropdown-user">
                <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                  <?php if($_SESSION['ADMIN_ROLE'] === '1') { ?>
                    <img src="<?php echo ADMIN_LOGIN_LINK_URL; ?>img/dp.jpg" class="img-responsive" alt="vendor">
                  <?php  } else { ?>
                    <img alt="admin"  src="<?php  
                      defined("ADMIN_LOGIN_LINK_URL") ?  print_r(ADMIN_LOGIN_LINK_URL) : "";
                    ?>img/piyush.jpg" />
                  <?php   }  ?>
                    <span class="username username-hide-on-mobile text-capitalize"><?php 
                      isset($_SESSION['ADMIN_USERNAME']) ? print_r($_SESSION['ADMIN_USERNAME']) :  print_r("Piyush");
                    ?> </span>
                    <i class="fa fa-angle-down"></i>
                </a>
                <ul class="dropdown-menu dropdown-menu-default animated jello">
                    <!-- <li>
                        <a href="javascript:void(0)">
                            <i class="icon-user"></i> Profile </a>
                    </li> -->
                    <li class="divider"> </li>
                    <li>
                        <a href="<?php defined("ROUTE_AJAX_URL") ?  print_r(ROUTE_AJAX_URL) : ""; ?>logout.php">
                        <i class="icon-logout"></i> Log Out </a>
                    </li>
                </ul>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </div>
    <!-- end header -->
        