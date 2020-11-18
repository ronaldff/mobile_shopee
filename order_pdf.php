<?php
    require_once("importantfile.php");
    require_once('vendor\autoload.php');
    
    if(!$_SESSION['ADMIN_LOGIN']){
        if(!isset($_SESSION['REGISTER_USER_ID'])){
            echo 'Not Authorised';
            die();
        }
    }

    

    if(isset($_GET['id']) && !empty($_GET['id'])){
        $order_id = get_safe_value($conn,$_GET['id']);
    }else {
        echo 'Not Authorised';
        die();
    }

    if($_SESSION['ADMIN_LOGIN']){
        $sql = "SELECT `order`.total_price,`order`.order_status,order_details.qty,product.product_name,product.product_image,product.product_sale_price FROM order_details INNER JOIN `order` ON order_details.order_id = `order`.id INNER JOIN product ON order_details.product_id = product.id WHERE order_details.order_id='{$order_id}'";
    } else {
        $user_id = $_SESSION['REGISTER_USER_ID'];
        $sql = "SELECT `order`.total_price,`order`.order_status,order_details.qty,product.product_name,product.product_image,product.product_sale_price FROM order_details INNER JOIN `order` ON order_details.order_id = `order`.id INNER JOIN product ON order_details.product_id = product.id WHERE order_details.order_id='{$order_id}' AND `order`.`user_id` = '{$user_id}'";
    }
    
  
    $result = mysqli_query($conn,$sql);

    $html = '<table class="table table-bordered table-striped text-center font-baloo">
    <thead class="text-uppercase">
       <tr>
          <th>PRODUCT NAME</th>
          <th>PRODUCT IMAGE</th>
          <th>QUANTITY</th>
          <th>ORDER STATUS</th>
          <th>PRICE</th>
          <th>TOTAL PRICE</th>
       </tr>
    </thead>
    <tbody>';
    
    if(mysqli_num_rows($result) > 0) {
        $totalPrice = 0;            

    while($row = mysqli_fetch_assoc($result)){ 
        $totalPrice = $totalPrice + ($row['product_sale_price'] * $row['qty']);

        $PRODUCT_URL = PRODUCT_URL;
        $img = $PRODUCT_URL.$row['product_image'];
        $rowprice = $row['product_sale_price'] * $row['qty'];
        
    $html .="<tr>
        <td>{$row["product_name"]}</td>
        <td><img src='$img' class='pdf_img'/></td>
        <td>{$row["qty"]}</td>
        <td>{$row["order_status"]}</td>
        <td>{$row["product_sale_price"]}</td>
        <td>{$rowprice}</td>
      </tr>";
    

    } 
    $html.= "<tr>
          <td colspan='4'></td>
          <td>TOTAL PRICE</td>
          <td>{$totalPrice}</td>
        </tr>";
    } else {
        echo 'Not Authorised';
        die();
    }
    $html .='</tbody></table>';

 $stylesheet = file_get_contents('pdf.css');
 $mpdf = new \Mpdf\Mpdf();

 $mpdf->WriteHTML($stylesheet,1);
 $mpdf->WriteHTML($html,2);
 $filename = time().$user_id.'.pdf';
 $mpdf->Output($filename,'I');
    
    

?>




