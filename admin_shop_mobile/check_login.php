<?php
  require_once("../connection.inc.php");
  require_once("admin_constant.php");
  require_once("../functions.inc.php");
  if(isset($_POST['status']) && $_POST['status'] === "admin_login"){
      $username = get_safe_value($conn,$_POST['username']);
      // $password = get_safe_value($conn,sha1(md5($_POST['password'])));
      $password = get_safe_value($conn, $_POST['password']);
      
      $sql = "SELECT * FROM admin_user WHERE admin_user='{$username}' AND admin_password='{$password}'";
      $result = mysqli_query($conn,$sql);
      $count  = mysqli_num_rows($result);
      if($count > 0){
        $row = mysqli_fetch_assoc($result);
        $_SESSION['ADMIN_LOGIN'] = 'yes';
        $_SESSION['ADMIN_USERNAME'] = $username;
        $_SESSION['ADMIN_ROLE'] = $row['role'];
        $_SESSION['ADMIN_ID'] = $row['id'];
        echo ROUTE_AJAX_URL.'dashboard.php';
      } else {
        $error_message = trim("wrong credential");
        echo $error_message;
      }
    
  }

?>