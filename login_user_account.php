<?php
  require_once("importantfile.php");
  if(isset($_POST['sub_name_btn']) && $_POST['sub_name_btn'] === "SignIn"){
      $email_id = get_safe_value($conn,$_POST['lemail_id']);
      $password = get_safe_value($conn,$_POST['lpassword']);
      $sql = "SELECT * FROM registered_users WHERE u_email='{$email_id}'";
      $result = mysqli_query($conn,$sql);
      $row = mysqli_fetch_assoc($result);
      // print_r($row);
      if($email_id !== $row['u_email']){
        echo "email_wrong";
      } else {
        if(password_verify($password,$row['u_password'])){
          $_SESSION['USER_LOGIN'] = 'yes';
          $_SESSION['REGISTER_USER_ID'] = $row['id'];
          $_SESSION['REGISTER_USERNAME'] = $row['u_name'];
          echo 'correct';
        } else {
          echo "incorrect";
        }
      }
  }





?>