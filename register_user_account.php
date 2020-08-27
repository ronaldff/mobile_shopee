<?php
  require_once("importantfile.php");
  if(isset($_POST['sub_name_btn']) && !empty($_POST)){
    $user_name = get_safe_value($conn,$_POST['u_name']);
    $mobile = get_safe_value($conn,$_POST['u_mobile']);
    $email_id = get_safe_value($conn,$_POST['u_email']);
    $encrypt_email = get_safe_value($conn,md5($_POST['u_email']));
    $password = get_safe_value($conn,$_POST['u_password']);
    $password_encrypted = password_hash($password,PASSWORD_BCRYPT);
    $added_on = date("y-m-d h:i:s");

    $check_email_exist = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM registered_users WHERE u_email='{$email_id}'"));
    if($check_email_exist > 0){
      echo "email_exist";
    } else {
      $sql = "INSERT INTO registered_users (u_name,u_email,u_password,u_mobile,encrypt_email,added_on) VALUES ('{$user_name}','{$email_id}','{$password_encrypted}','{$mobile}','{$encrypt_email}','{$added_on}')";
      $result = mysqli_query($conn, $sql);
      if($result === true){
        echo "correct";
      } else {
        echo "incorrect";
      } 
    }
  }
?>