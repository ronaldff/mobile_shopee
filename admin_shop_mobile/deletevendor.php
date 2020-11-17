<?php
  require_once("../connection.inc.php");
  require_once("admin_constant.php");
  require_once("../functions.inc.php");

  if(isset($_POST['delete_id']) || (!empty($_POST['delete_id']))){
    $sql = "DELETE FROM admin_user WHERE `id`='{$_POST['delete_id']}' AND `admin_role`='1'";
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