<?php

  $path = $_SERVER['PHP_SELF'];
  $page = basename($path);

  if(isset($_GET['id']) && !empty($_GET['id'])){
    $cat_id = get_safe_value($conn,$_GET['id']);
    $get_products = "SELECT * FROM product WHERE categories_id='{$cat_id}' AND status='1'";
    $product_result = mysqli_query($conn, $get_products);
    if(mysqli_num_rows($product_result) > 0){
      $product_data = mysqli_fetch_assoc($product_result);      
    }
  }

  if(isset($product_data )){
    $category_name = ucfirst($product_data['category_name']);
  } else {
    $category_name = '';
  }

  switch ($page) {
    case "index.php":
      $title = 'Home';
      break;
    case "contact.php":
      $title = 'Contact';
      break;
    case "category_wise_product.php":
      $title = $category_name;
      break;
    default:
      $title = "";
  }

?>