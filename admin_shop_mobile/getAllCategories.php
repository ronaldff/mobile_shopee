<?php
 require_once("../connection.inc.php");
 require_once("admin_constant.php");
 require_once("../functions.inc.php");

 $sql = "SELECT id,categories_name FROM categories";
 $result = mysqli_query($conn,$sql);
 $cat_data = [];
 if(mysqli_num_rows($result) > 0){
  while ($row = mysqli_fetch_assoc($result)) {
    $cat_data[] = $row;
  }
  echo json_encode($cat_data);
 }
?>