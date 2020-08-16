<?php
  require_once("importantfile.php");
  if(isset($_POST)){
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
          if(isset($_SESSION['product_id']) && !empty($_SESSION['product_id'])){
            if(mysqli_num_rows(mysqli_query($conn, "SELECT * FROM wishlist WHERE user_id='{$_SESSION['REGISTER_USER_ID']}' AND product_id='{$_SESSION['product_id']}'")) > 0){
            } else {
              $added_on = date("y-m-d h:i:s");
              $result = mysqli_query($conn,"INSERT INTO wishlist(user_id, product_id,added_on) VALUES ('{$_SESSION['REGISTER_USER_ID']}','{$_SESSION['product_id']}','{$added_on}')");
              unset($_SESSION['product_id']);
            }
          }
          echo 'correct';
        } else {
          echo "incorrect";
        }
      }
  }





?>