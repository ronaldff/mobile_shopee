<?php
  require_once('importantfile.php');
  if(isset($_SESSION['USER_LOGIN']) && !empty($_SESSION['USER_LOGIN'])){
    $uid = $_SESSION['REGISTER_USER_ID'];
    if(isset($_POST['product_id'])){
      $product_id = $_POST['product_id'];
      mysqli_query($conn, "DELETE FROM wishlist WHERE user_id='{$uid}' AND product_id='{$product_id}'");
    }
		$row_count = mysqli_query($conn, "SELECT * FROM wishlist WHERE user_id='{$uid}'");
    $wishlist_count = mysqli_num_rows($row_count);
    echo $wishlist_count;
	} else {
		$wishlist_count = 0;
	}
?>