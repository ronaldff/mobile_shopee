<?php
 require_once("../connection.inc.php");
 require_once("admin_constant.php");
 require_once("../functions.inc.php");


 $limit_per_page = 5;
 $page = "";
 if(isset($_POST['page_no'])){
  $page = $_POST['page_no'];
 }else {
  $page = 1;
 }

 $offset = ($page - 1) * $limit_per_page;

 $condition = '';
 if($_SESSION['ADMIN_ROLE'] === '1'){
   $condition = " AND product.added_by='".$_SESSION['ADMIN_ID']."'";
 }

 $sql = "SELECT product.*,categories.categories_name FROM product INNER JOIN categories ON product.categories_id = categories.id $condition ORDER BY product.id desc LIMIT {$offset},{$limit_per_page}";
 $result = mysqli_query($conn,$sql);
 $output = '';
 $i = 0;
 if(mysqli_num_rows($result) > 0){
   $output .= '<table class="table table-bordered text-center">
                    <thead class="thead-dark">
                      <tr>
                        <th>Sr.No</th>
                        <th>ID</th>
                        <th>Category Name</th>
                        <th>Product Name</th>
                        <th>Product Image</th>
                        <th>MRP</th>
                        <th>Sale Price</th>
                        <th>QTY</th>
                        <th>Available QTY</th>
                        <th>Sold QTY</th>
                        <th>Added By</th>
                        <th>Status</th>
                        <th>Created At</th>
                        <th>Action</th>
                      </tr>
                  </thead>
                  <tbody>
              ';
   while ($row = mysqli_fetch_assoc($result)) {
        $soldQty = productQTYSoldByProductId($conn, $row['id']);
        $pendingQty = $row['product_qty'] - $soldQty;
     $output .= "<tr>
                  <td>".++$i."</td>
                  <td>{$row['id']}</td>
                  <td>{$row['categories_name']}</td>
                  <td>{$row['product_name']}</td>
                  <td><a href='".PRODUCT_IMAGE_URL."{$row['product_image']}' target='_blank'><img target='_blank' src='".PRODUCT_IMAGE_URL."{$row['product_image']}' alt='productImg' style='width:30px;' /></a></td>
                  <td>{$row['product_mrp']}</td>
                  <td>{$row['product_sale_price']}</td>
                  <td>{$row['product_qty']}</td>
                  <td>{$pendingQty }</td>";
                  if($soldQty == ''){
                    $output .= "<td>not sold</td>";
                  }else {
                    $output .= "<td>{$soldQty}</td>";
                  }
                 
                  if($row['added_by'] === '1'){
                    $output .= "<td>Admin</td>";
                  } else {
                    $output .= "<td>Vendor</td>";
                  }
                  $output .=  "<td>";
                  if($row['status'] === '0'){
                    $output .= "<button type='button' class='btn btn-danger status_change_product' data-status={$row['status']} data-id={$row['id']}>deactive</button>";
                  } else {
                    $output .= "<button type='button' class='btn btn-success status_change_product' data-status={$row['status']} data-id={$row['id']}>active</button>";
                  }
                  $output .="</td>";
                  $output .="<td>{$row['created_at']}</td>
                  <td>
                    <button type='button' class='btn btn-secondary' id='product_edit' data-id={$row['id']}>edit</button>
                    <button type='button' class='btn btn-warning' id='product_delete' data-id={$row['id']}>delete</button>
                  </td>
                </tr>";
   }
   $output .= '</tbody>';
   $output .= '</table>';

   $sql_total = "SELECT * FROM product WHERE added_by = '{$_SESSION['ADMIN_ID']}'";
   $records = mysqli_query($conn,$sql_total);
   $total_record = mysqli_num_rows($records);

   $total_pages = ceil($total_record/$limit_per_page);
   $output .= '<div id="pagination_product">';
   for ($i=1; $i <= $total_pages ; $i++) { 
     if($i == $page){
       $class_Name = 'active bg-success border-primary';
     } else {
      $class_Name = '';
      $styledata = '';
     }
    $output .= "<a class='{$class_Name}' style='width:10px;height:10px;border:1px solid black;padding:5px;margin:2px;cursor:pointer' id='{$i}' href='javascript:;'>{$i}</a>";
   }
   $output .= "</div>";
   echo $output;
 } else {
   echo "<script>$('#product_list_title').css('display','none');</script>";
   $output .= "<h4 class='text-warning text-center'>DATA NOT FOUND, PLEASE INSERT ATLEAST ONE DATA, USE FORM</h4>";
   echo $output;
 }

?>