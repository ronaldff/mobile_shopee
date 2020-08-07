<?php

  session_start();
  require_once("admin_constant.php");
  unset($_SESSION['ADMIN_LOGIN']);
  unset($_SESSION['ADMIN_USERNAME']);
  header("Location:".ROUTE_AJAX_URL."index.php");
?>