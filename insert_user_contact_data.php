<?php
  require_once("importantfile.php");
  if(isset($_POST) && !empty($_POST)){
    $user_name = get_safe_value($conn,$_POST['name']);
    $mobile = get_safe_value($conn,$_POST['mobile']);
    $email_id = get_safe_value($conn,$_POST['email_id']);
    $comment = get_safe_value($conn,$_POST['comment']);
    $contact_at = date("y-m-d h:i:s");

    $sql = "INSERT INTO contact_us (fname,email_id,mobile,comment,contact_at) VALUES ('{$user_name}','{$email_id}','{$mobile}','{$comment}','{$contact_at}')";
    $result = mysqli_query($conn, $sql);
    if($result === true){
      echo "1";
    } else {
      echo "2";
    }

  }
?>