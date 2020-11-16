<?php 
require_once("../connection.inc.php");
?>
<?php include_once("admin_constant.php"); ?>
<?php include_once("header_admin.php"); ?>
<?php include_once("menu_admin.php"); ?>
<?php require_once("../functions.inc.php"); ?>
<?php isAdminRole() ?>
<!-- start page content -->

<div class="page-content-wrapper">
  <div class="page-content">
    <div class="page-bar">
      <div class="page-title-breadcrumb">
        <div class=" pull-left">
          <div class="page-title">Vendor Manage Orders</div>
        </div>
        <ol class="breadcrumb page-breadcrumb pull-right">
          <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item" href="<?php echo ROUTE_AJAX_URL;?>dashboard.php">Home</a>&nbsp;<i class="fa fa-angle-right"></i>
          </li>
          <li>&nbsp;<a class="parent-item" href="<?php echo ROUTE_AJAX_URL;?>manage_order_vendor.php">Vendor Orders</a>&nbsp;<i class="fa fa-angle-right"></i>
          </li>
          <li class="active">Vendor List Orders</li>
        </ol>
      </div>
    </div>
    <!-- Add Product Form -->
    <div class="row">
      <div class="col-md-12 col-sm-12">
        <div class="card  card-box">
          <div class="card-head">
            <header>Vendor Orders</header>
          </div>
          <div class="card-body ">
            <div>
              <div class=" pull-left">
                <div class="page-title" id="product_list_title">Vendor Orders List</div>
              </div>
            </div>
            <div>
              <table class="table table-bordered table-striped text-center font-baloo">
                <thead class="text-uppercase">
                  <tr>
                    <th>order id</th>
                    <th>product name</th>
                    <th>product qty</th>
                    <th>order date</th>
                    <th>address</th>
                    <th>payment type</th>
                    <th>payment status</th>
                    <th>order status</th>
                    <th>Role</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                    $result = mysqli_query($conn,"SELECT `order`.user_address,`order`.added_on,`order`.user_city,`order`.user_post_code,`order`.order_status,`order`.payment_type,`order`.payment_status,`order_details`.id,`order_details`.qty,`product`.added_by,`product`.product_name FROM order_details INNER JOIN `order` ON order_details.order_id = `order`.id INNER JOIN product ON order_details.product_id = product.id WHERE product.added_by = '{$_SESSION['ADMIN_ID']}' ORDER BY `order`.id DESC");
                    if(mysqli_num_rows($result) > 0) {
                      while($row = mysqli_fetch_assoc($result)){
                          $order_status = mysqli_fetch_assoc(mysqli_query($conn,"SELECT status_name FROM order_status_data WHERE id='{$row['order_status']}'"));
                        ?>
                    
                      <tr>
                        <td>
                          <a href="javascript:void(0);"><button type="button" class="btn btn-warning font-size-12"><?php echo $row['id']; ?></button></a>
                        </td>
                        <td><?php echo $row['product_name']; ?></td>
                        <td><?php echo $row['qty']; ?></td>
                        <td><?php echo $row['added_on']; ?></td>
                        <td><strong>Address:</strong> <?php echo $row['user_address']; ?>&nbsp; <strong>City/Sate:</strong> <?php echo $row['user_city']; ?>&nbsp; <strong>Pincode:</strong> <?php echo $row['user_post_code']; ?></td>
                        <td><?php echo $row['payment_type']; ?></td>
                        <td><?php echo $row['payment_status']; ?></td>
                        <td><?php echo $order_status['status_name']; ?></td>
                        <?php
                            if($row['added_by'] == 1){ ?>
                                <td>Admin</td>
                         <?php   } else { ?>
                            <td>vendor</td>
                        <?php    }
                        ?>
                      </tr>
                  <?php }}  ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
 
  
<!-- end page container -->
<?php include_once("footer_admin.php"); ?>
