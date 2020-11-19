<?php 
  function get_safe_value($conn,$str){
    if($str != ''){
      $str = strip_tags(trim($str));
      return mysqli_real_escape_string($conn,$str);

    }
  }

  function getProductById($conn,$id){
  	$sql = "SELECT * FROM product WHERE id='{$id}'";
  	$result = mysqli_query($conn,$sql);
  	if(mysqli_num_rows($result) > 0){
  		$data = mysqli_fetch_assoc($result);
  		return $data;
  	}
  	
  }

  // vendor checked
  function isAdmin(){
    if($_SESSION['ADMIN_ROLE'] === '1'){ ?>
      <script>
        window.location.href ="manage_product.php";
      </script>
   <?php }
  } 

  // admin checked for vendor order
  function isAdminRole(){
    if($_SESSION['ADMIN_ROLE'] === '0'){ ?>
      <script>
        window.location.href ="manage_product.php";
      </script>
   <?php }
  } 

  function productQTYSoldByProductId($conn, $pid){
    $sql = "SELECT sum(order_details.qty) AS qty FROM order_details INNER JOIN `order` ON order_details.order_id = `order`.id WHERE order_details.product_id='{$pid}' AND `order`.order_status != '4' AND ((`order`.payment_type='online_payment' AND `order`.payment_status='success') OR (`order`.payment_type='chash_on_delivery' AND `order`.payment_status!=''))";
    $result = mysqli_query($conn,$sql);
    $data = mysqli_fetch_assoc($result);
    return $data['qty'];
  }

  function productQtyInsertedInDatabase($conn, $pid){
    $sql = "SELECT product_qty FROM product WHERE product.id='{$pid}'";
    $result = mysqli_query($conn,$sql);
    $data = mysqli_fetch_assoc($result);
    return $data['product_qty'];
  }
?>