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


?>