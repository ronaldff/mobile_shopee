<?php
  require_once("../connection.inc.php");
  require_once("admin_constant.php");
  require_once("../functions.inc.php");

  if(isset($_POST['category_name']) && isset($_POST['category_id'])){
    $category_name = get_safe_value($conn,$_POST['category_name']);
    $sql = "UPDATE categories SET `categories_name`='{$category_name}' WHERE `id`='{$_POST['category_id']}'";
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