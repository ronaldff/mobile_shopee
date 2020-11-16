<?php 
require_once("../connection.inc.php");
require_once("../functions.inc.php");
 isAdmin() 
?>
<?php include_once("admin_constant.php"); ?>
<?php include_once("header_admin.php"); ?>
<?php include_once("menu_admin.php"); ?>
<?php 
  if(isset($_GET['id']) && !empty($_GET['id'])){
    $order_id = get_safe_value($conn,$_GET['id']);
 }

  if(isset($_POST['update_order_status'])){
    $update_order_status = get_safe_value($conn,$_POST['update_order_status']);
    mysqli_query($conn, "UPDATE `order` SET `order_status`='{$update_order_status}' WHERE id='{$order_id}'");

  }
?>
<!-- start page content -->

<div class="page-content-wrapper">
  <div class="page-content">
    <div class="page-bar">
      <div class="page-title-breadcrumb">
        <div class=" pull-left">
          <div class="page-title">Orders Details</div>
        </div>
        <ol class="breadcrumb page-breadcrumb pull-right">
          <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item" href="<?php echo ROUTE_AJAX_URL;?>dashboard.php">Home</a>&nbsp;<i class="fa fa-angle-right"></i>
          </li>
          <li>&nbsp;<a class="parent-item" href="<?php echo ROUTE_AJAX_URL;?>manage_order_details.php?id=<?php echo $order_id; ?>">Order Details</a>&nbsp;<i class="fa fa-angle-right"></i>
          </li>
          <li class="active">List Orders Details</li>
        </ol>
      </div>
    </div>
    <!-- Add Product Form -->
    <div class="row">
      <div class="col-md-12 col-sm-12">
        <div class="card  card-box">
          <div class="card-head">
            <header>Order Details</header>
          </div>
          <div class="card-body ">
            <div>
              <div class=" pull-left">
                <div class="page-title" id="product_list_title">Orders Detail List</div>
              </div>
            </div>
            <div>
              <table class="table table-bordered table-striped text-center font-baloo">
                <thead class="text-uppercase">
                  <tr>
                    <th>product name</th>
                    <th>product image</th>
                    <th>quantity</th>
                    <!-- <th>order status</th> -->
                    <th>price</th>
                    <th>total price</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                    
                  $sql = "SELECT registered_users.u_name,registered_users.u_email,registered_users.u_mobile, `order`.total_price,`order`.user_address,`order`.user_city,`order`.user_post_code,`order`.order_status,`order`.payment_type,`order`.payment_status,order_details.qty,product.product_name,product.product_image,product.product_sale_price FROM order_details INNER JOIN `order` ON order_details.order_id = `order`.id INNER JOIN product ON order_details.product_id = product.id INNER JOIN registered_users ON registered_users.id= `order`.user_id WHERE order_details.order_id='{$order_id}'";
                  
                    $result = mysqli_query($conn,$sql);
                    
                    if(mysqli_num_rows($result) > 0) {
                      $totalPrice = 0;            
                      while($row = mysqli_fetch_assoc($result)){
                          $totalPrice = $totalPrice + ($row['product_sale_price'] * $row['qty']);
                          $order_status = mysqli_fetch_assoc(mysqli_query($conn,"SELECT status_name FROM order_status_data WHERE id='{$row['order_status']}'"));
                          $username = $row['u_name'];
                          $email_address = $row['u_email'];
                          $mobile = $row['u_mobile'];
                          $address = $row['user_address'];
                          $city = $row['user_city'];
                          $pincode = $row['user_post_code'];
                          $payment_type = $row['payment_type'];
                          $payment_status = $row['payment_status'];

                        ?>
                      <tr>
                        <td><?php echo $row['product_name']; ?></td>
                        <td><a href="<?php echo PRODUCT_IMAGE_URL ?><?php echo $row['product_image']; ?>"><img src="<?php echo PRODUCT_IMAGE_URL ?><?php echo $row['product_image']; ?>" alt="" style='width:30px;' /></a></td>
                        <td><?php echo $row['qty']; ?></td>
                        <!-- <td><?php echo $order_status['status_name']; ?></td>   -->
                        <td><?php echo $row['product_sale_price']; ?></td>
                        <td><?php echo $row['product_sale_price'] * $row['qty']; ?></td>
                      </tr>

                  <?php } ?>
                        <tr>
                          <td colspan="3"></td>
                          <td>TOTAL PRICE</td>
                          <td><?php   echo $totalPrice; ?></td>
                        </tr>
                <?php } ?>
                
                        
                </tbody>
              </table>
              <div class=" pull-left">
                <div class="page-title" id="product_list_title text-underline"><u>User Address Information With Order:</u></div>
                <div>
                  <div class="row">
                    <div col-md-2>
                      <strong style="padding-left: 15px;">Order Status:</strong> &nbsp;<?php echo $order_status['status_name']; ?> &nbsp; &nbsp; &nbsp;
                    </div>
                    <div col-md-9>
                      <div class="row">
                        <div col-md-6>
                          <form method="POST">
                          <select name="update_order_status" class="form-control">
                            <option value="">Change Order Status</option>
                            <?php 
                              $res = mysqli_query($conn,"SELECT * From order_status_data");
                              while($rowData = mysqli_fetch_assoc($res)){ ?>
                                  <option value="<?php echo $rowData['id'];?>"><?php echo $rowData['status_name'];?></option>    
                            <?php  }
                            ?>
                          </select>
                          
                        </div>
                        <div col-md-6>
                          <input type="submit" class="form-control btn ml-2" value="change status" name="change_status">
                        </form>
                        </div>
                      </div>
                    </div>
                  </div>
                  <strong>Payment Type:</strong> &nbsp;<?php echo $payment_type; ?><br>
                  <strong>Payment Status:</strong> &nbsp;<?php echo $payment_status; ?><br>
                  <strong>User Name:</strong> &nbsp;<?php echo $username; ?><br>
                  <strong>Email Address:</strong> &nbsp;<?php echo $email_address; ?><br>
                  <strong>Mobile Number:</strong> &nbsp;<?php echo $mobile; ?><br>
                  <strong>Address:</strong> &nbsp;<?php echo $address; ?><br>
                  <strong>City/State:</strong> &nbsp;<?php echo $city; ?><br>
                  <strong>Pincode:</strong> &nbsp;<?php echo $pincode; ?>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
 
  
<!-- end page container -->
<?php include_once("footer_admin.php"); ?>
