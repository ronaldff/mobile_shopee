<?php
 require_once("../connection.inc.php");
 require_once("admin_constant.php");
 require_once("../functions.inc.php");

 if(isset($_POST['edit_id'])){
   $sql = "SELECT * FROM product WHERE id='{$_POST['edit_id']}'";
   $result = mysqli_query($conn,$sql);
   $output = "";
   if(mysqli_num_rows($result) > 0){
     $row = mysqli_fetch_assoc($result);
     $output .= "
                  <input type='hidden' id='cat_id' value='{$row['categories_id']}'>
                  <form id='update_product_form'>
                  <div class='row'>
                    <div class='col-md-6'>
                      <div class='form-group'>
                        <label for='name'>Product Name:</label>
                        <input type='hidden' value='{$_POST['edit_id']}' name='pro_id'>
                        <input type='text' class='form-control' id='product_name' name='product_name' value='{$row['product_name']}' required>
                      </div>
                      <div class='form-group'>
                        <label for='mrp'>Product MRP:</label>
                        <input type='number' class='form-control' id='product_mrp' name='product_mrp' value='{$row['product_mrp']}' required>
                      </div>
                      <div class='form-group'>
                        <label for='price'>Sale Price:</label>
                        <input type='number' class='form-control' id='product_sale_price' name='product_sale_price' value='{$row['product_sale_price']}' required>
                      </div>
                      <div class='form-group'>
                        <label for='qty'>Quantity:</label>
                        <input type='number'  class='form-control' name='product_qty' id='product_qty' value='{$row['product_qty']}' required>
                      </div>
                      <div class='form-group'>
                        <label for='productImg'>Upload Photo:</label>
                        <div>
                          <input type='file' id='product_image' name='product_image' >
                          <input type='hidden' id='old_product_image' name='old_product_image' value='{$row['product_image']}'>

                        </div>
                      </div>
                    </div>

                    <div class='col-md-6'>
                      <div class='form-group'>
                        <label>Meta Title:</label>
                        <textarea class='form-control' rows='2' id='meta_title' name='meta_title'>{$row['meta_title']}</textarea>
                      </div>
                      <div class='form-group'>
                        <label for='categories'>Categories:</label>
                        <select class='form-control' id='categories_id' name='categories_id' required></select>
                      </div>
                      <div class='form-group'>
                        <label>Meta Description:</label>
                        <textarea class='form-control' rows='2' id='meta_desc' name='meta_desc'>{$row['meta_desc']}</textarea>
                      </div>
                      <div class='form-group'>
                        <label>Meta Keyword:</label>
                        <textarea class='form-control' rows='2' id='meta_keyword' name='meta_keyword'>{$row['meta_keyword']}</textarea>
                      </div>
                    </div>
                  </div>
                  ";
                  if($row['best_seller'] === '1'){
                    $output .= "<div class='form-group'>
                    <label for='best_seller'>Best Seller:</label>
                    <select class='form-control' id='best_seller' name='best_seller' required>
                      <option value=''>Select Best Seller</option>
                      <option value='1' selected=''>Yes</option>
                      <option value='0'>No</option>
                    </select>
                  </div>";
                  } else if($row['best_seller'] === '0') {
                    $output .= "<div class='form-group'>
                    <label for='best_seller'>Best Seller:</label>
                    <select class='form-control' id='best_seller' name='best_seller' required>
                      <option value=''>Select Best Seller</option>
                      <option value='1' >Yes</option>
                      <option value='0' selected=''>No</option>
                    </select>
                  </div>";
                  } else {
                    $output .= "<div class='form-group'>
                    <label for='best_seller'>Best Seller:</label>
                    <select class='form-control' id='best_seller' name='best_seller' required>
                      <option value=''>Select Best Seller</option>
                      <option value='1' >Yes</option>
                      <option value='0'>No</option>
                    </select>
                  </div>";
                  }
                  
                $output .=  "
                  <div class='form-group'>
                    <label>Short Description:</label>
                    <textarea class='form-control' rows='2' id='short_desc' name='short_desc' required>{$row['short_desc']}</textarea>
                  </div>
                  <div class='form-group'>
                    <label>Long Description:</label>
                    <textarea class='form-control' rows='3' id='long_desc' name='long_desc' required>{$row['long_desc']}</textarea>
                  </div>
                  <div class='row'>
                    <div class='col-md-5'></div>
                    <div class='col-md-4'>
                      <input type='submit' value='Update Product' name='update_product_btn' class='btn btn-primary'>
                    </div>
                    <div class='col-md-3'></div>
                  </div>
                </form>
                ";
      echo $output;
   }

 }


 

?>