<?php
  require_once("../connection.inc.php");
  require_once("admin_constant.php");
  require_once("../functions.inc.php");

  if(isset($_POST['delete_id']) || (!empty($_POST['delete_id']))){
    $img_sql = "SELECT product_image FROM product WHERE `id`='{$_POST['delete_id']}'";
    $result_data = mysqli_query($conn,$img_sql);
    $data = mysqli_fetch_assoc($result_data);
    $filename = PRODUCT_IMAGE_URL.$data['product_image'];
    if(file_exists($filename)){
      unlink($filename);
    }
    $sql = "DELETE FROM product WHERE `id`='{$_POST['delete_id']}'";
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