<?php
  require_once("../connection.inc.php");
  require_once("admin_constant.php");
  require_once("../functions.inc.php");

  if(isset($_POST['status_code']) && isset($_POST['status_id']) && (!empty($_POST['status_code']) || !empty($_POST['status_id']))){
    $id = $_POST['status_id'];
    if($_POST['status_code'] === '0'){
      $status = 1;
    } else {
      $status = 0;
    }

    $sql = "UPDATE admin_user SET `admin_status`='{$status}' WHERE `id`='{$id}' AND `admin_role`='1'";
    $result = mysqli_query($conn,$sql);
    if($result === true){
      echo '1';
    } else{
      echo '0';
    }
  } else {
    return false;
  }
?>