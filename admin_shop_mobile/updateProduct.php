<?php
  require_once("../connection.inc.php");
  require_once("admin_constant.php");
  require_once("../functions.inc.php");
 
  if(isset($_POST['product_name']) && isset($_POST['pro_id'])){
    if($_FILES['product_image']['name'] === ''){
      $product_image = $_POST['old_product_image'];
    } else {
      $product_image = rand(111111111,999999999).'_'.$_FILES['product_image']['name'];
      $product_image_type = strtolower(pathinfo($product_image,PATHINFO_EXTENSION));
      if($product_image_type === 'jpg' || $product_image_type === 'jpeg' || $product_image_type === 'png'){
      
        move_uploaded_file($_FILES['product_image']['tmp_name'],".././admin_shop_mobile/media/product/{$product_image}");
      } else {
        echo '2';
      }
    }
    $product_name = get_safe_value($conn,strtolower($_POST['product_name']));
    $best_seller = get_safe_value($conn,strtolower($_POST['best_seller']));
    $product_mrp = get_safe_value($conn,strtolower($_POST['product_mrp']));
    $product_sale_price = get_safe_value($conn,strtolower($_POST['product_sale_price']));
    $product_qty = get_safe_value($conn,strtolower($_POST['product_qty']));
    $meta_title = get_safe_value($conn,strtolower($_POST['meta_title']));
    $categories_id = get_safe_value($conn,strtolower($_POST['categories_id']));
    $meta_desc = get_safe_value($conn,strtolower($_POST['meta_desc']));
    $meta_keyword = get_safe_value($conn,strtolower($_POST['meta_keyword']));
    $short_desc = get_safe_value($conn,strtolower($_POST['short_desc']));
    $long_desc = get_safe_value($conn,strtolower($_POST['long_desc']));
    $sql = "UPDATE product SET `categories_id`='{$categories_id}',`product_name`='{$product_name}',`best_seller`='{$best_seller}',`product_mrp`='{$product_mrp}',`product_sale_price`='{$product_sale_price}',`product_qty`='{$product_qty}',`product_image`='{$product_image}',`short_desc`='{$short_desc}',`long_desc`='{$long_desc}',`meta_title`='{$meta_title}',`meta_desc`='{$meta_desc}',`meta_keyword`='{$meta_keyword}' WHERE `id`='{$_POST['pro_id']}'";
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