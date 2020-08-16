<?php
  require_once("importantfile.php");
  if(isset($_SESSION['USER_LOGIN']) && !empty($_SESSION['USER_LOGIN']) && $_SESSION['USER_LOGIN'] === 'yes'){
    $uid = $_SESSION['REGISTER_USER_ID'];
    $product_id = get_safe_value($conn,$_POST['proId']);
    $added_on = date("y-m-d h:i:s");
    if(mysqli_num_rows(mysqli_query($conn, "SELECT * FROM wishlist WHERE user_id='{$uid}' AND product_id='{$product_id}'")) > 0){
      echo 'already_added';
    } else {
      $result = mysqli_query($conn,"INSERT INTO wishlist(user_id, product_id,added_on) VALUES ('{$uid}','{$product_id}','{$added_on}')");
      echo 'wishlist_added';
    }
  } else {
    $product_id = get_safe_value($conn,$_POST['proId']);
    $_SESSION['product_id'] = $product_id;
    echo 'not_loggedin';
  }

?>