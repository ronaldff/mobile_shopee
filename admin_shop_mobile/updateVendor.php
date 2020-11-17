<?php
  require_once("../connection.inc.php");
  require_once("admin_constant.php");
  require_once("../functions.inc.php");

  if(isset($_POST['vendor_name']) && isset($_POST['vendor_id'])){
    $vendor_id = get_safe_value($conn, $_POST['vendor_id']);
    $vendor_name = get_safe_value($conn,strtolower($_POST['vendor_name']));
    $admin_password = get_safe_value($conn,sha1(md5($_POST['admin_password'])));  
    $vendor_show_password = get_safe_value($conn,strtolower($_POST['admin_password']));
    $email = get_safe_value($conn,strtolower($_POST['email']));
    $mobile = get_safe_value($conn,$_POST['mobile']);
    $sql = "UPDATE admin_user SET `admin_user`='{$vendor_name}',`admin_password`='{$admin_password}',`vendor_show_password`='{$vendor_show_password}',`email`='{$email}',`mobile`='{$mobile}' WHERE `id`='{$vendor_id}' AND admin_role='1'";
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