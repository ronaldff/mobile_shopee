<?php
 require_once("../connection.inc.php");
 require_once("admin_constant.php");
 require_once("../functions.inc.php");

  if(isset($_POST['submit_name'])){
    $categories_name = get_safe_value($conn,strtolower($_POST['categories_name']));
    $sql = "SELECT categories_name FROM categories WHERE categories_name='{$categories_name}'";
    $db_category_data = mysqli_query($conn, $sql);
    if(mysqli_num_rows($db_category_data) >= 0){
      $row = mysqli_fetch_assoc($db_category_data);
      if($row['categories_name'] === $categories_name){
        echo "category_exist";
        return false;
      } else {
        $sql = "INSERT INTO categories (categories_name) VALUES ('{$categories_name}')";
        $result = mysqli_query($conn, $sql);
        if($result === true){
          echo "category_insert";
        }
      }
    }
  }
  
?>