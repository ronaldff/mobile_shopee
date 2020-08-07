<?php
  session_start();
  require_once("importantfile.php");
  unset($_SESSION['USER_LOGIN']);
  unset($_SESSION['REGISTER_USER_ID']);
  unset($_SESSION['REGISTER_USERNAME']);
  header("Location:".SITE_URL."index.php");

?>