<?php
 require_once("../connection.inc.php");
 require_once("admin_constant.php");
 require_once("../functions.inc.php");


  if(isset($_FILES['product_image']['name']) && !empty($_FILES['product_image']['name'])){
    $product_name = get_safe_value($conn,strtolower($_POST['product_name']));
    $best_seller = get_safe_value($conn,$_POST['best_seller']);
    $sql = "SELECT product_name FROM product WHERE product_name='{$product_name}'";
    $db_product_data = mysqli_query($conn, $sql);
    if(mysqli_num_rows($db_product_data) >= 0){
      $row = mysqli_fetch_assoc($db_product_data);
      if($row['product_name'] === $product_name){
        echo "1";
        return false;
      } else {
        $product_image = rand(111111111,999999999).'_'.$_FILES['product_image']['name'];
        $product_image_type = strtolower(pathinfo($product_image,PATHINFO_EXTENSION));
        if($product_image_type === 'jpg' || $product_image_type === 'jpeg' || $product_image_type === 'png'){
          move_uploaded_file($_FILES['product_image']['tmp_name'],PRODUCT_IMAGE_URL.$product_image);
          $product_mrp = get_safe_value($conn,strtolower($_POST['product_mrp']));
          $product_sale_price = get_safe_value($conn,strtolower($_POST['product_sale_price']));
          $product_qty = get_safe_value($conn,strtolower($_POST['product_qty']));
          $meta_title = get_safe_value($conn,strtolower($_POST['meta_title']));
          $categories_id = get_safe_value($conn,$_POST['categories_id']);
          $sqlData = "SELECT categories_name FROM categories WHERE id={$categories_id}";
          $resultData = mysqli_query($conn, $sqlData);
          $category_Data = mysqli_fetch_assoc($resultData);
          $category_name = $category_Data['categories_name'];
          $meta_desc = get_safe_value($conn,strtolower($_POST['meta_desc']));
          $meta_keyword = get_safe_value($conn,strtolower($_POST['meta_keyword']));
          $short_desc = get_safe_value($conn,strtolower($_POST['short_desc']));
          $long_desc = get_safe_value($conn,strtolower($_POST['long_desc']));
          $sql = "INSERT INTO product (categories_id,category_name,product_name,best_seller,product_mrp,product_sale_price,product_qty,product_image,short_desc,long_desc,meta_title,meta_desc,meta_keyword) VALUES ('{$categories_id}','{$category_name}','{$product_name}','{$best_seller}','{$product_mrp}','{$product_sale_price}','{$product_qty}','{$product_image}','{$short_desc}','{$long_desc}','{$meta_title}','{$meta_desc}','{$meta_keyword}')";
          $result = mysqli_query($conn, $sql);
          if($result === true){
            echo "2";
          }
        } else {
          echo '3';
          return false;
        }
        
      }
    }
  }
  
?>