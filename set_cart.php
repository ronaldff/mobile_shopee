<?php
  require_once("importantfile.php");
  require_once("Add_to_cart_inc.php");
  
  if(!isset($_POST['qty'])){
    $qty = 1;
  }else {
    $qty = $_POST['qty'];
  }
  
  $productid = get_safe_value($conn, $_POST['pid']);
  $qty = get_safe_value($conn, $qty);
  $type = get_safe_value($conn, $_POST['type']);

  if($type === "add"){
    $obj = new Add_to_cart_inc();
    $obj->add_to_cart($productid,$qty);
  }

  if($type === "update"){
    $obj = new Add_to_cart_inc();
    $obj->updateProduct($productid,$qty);
  }

  if($type === "remove"){
    $obj = new Add_to_cart_inc();
    $obj->removeProduct($productid);
  }

  echo $obj->totalProduct();
  


?>