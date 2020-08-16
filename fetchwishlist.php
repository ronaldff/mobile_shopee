<?php
  require_once('importantfile.php');
  if(isset($_SESSION['USER_LOGIN']) && !empty($_SESSION['USER_LOGIN'])){
    $uid = $_SESSION['REGISTER_USER_ID'];
    $results = mysqli_query($conn, "SELECT product.id,product.product_name,product.product_sale_price,product.product_image FROM wishlist INNER JOIN product ON wishlist.product_id = product.id WHERE user_id='{$uid}'");
    $output = array();
    while ($row = mysqli_fetch_assoc($results)) {
      $output[] = $row;
    }
    echo json_encode($output);
  }
  


?>