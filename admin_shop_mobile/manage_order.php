<?php 
require_once("../connection.inc.php");
?>
<?php include_once("admin_constant.php"); ?>
<?php include_once("header_admin.php"); ?>
<?php include_once("menu_admin.php"); ?>
<!-- start page content -->

<div class="page-content-wrapper">
  <div class="page-content">
    <div class="page-bar">
      <div class="page-title-breadcrumb">
        <div class=" pull-left">
          <div class="page-title">Manage Orders</div>
        </div>
        <ol class="breadcrumb page-breadcrumb pull-right">
          <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item" href="<?php echo ROUTE_AJAX_URL;?>dashboard.php">Home</a>&nbsp;<i class="fa fa-angle-right"></i>
          </li>
          <li>&nbsp;<a class="parent-item" href="<?php echo ROUTE_AJAX_URL;?>manage_order.php">Orders</a>&nbsp;<i class="fa fa-angle-right"></i>
          </li>
          <li class="active">List Orders</li>
        </ol>
      </div>
    </div>
    <!-- Add Product Form -->
    <div class="row">
      <div class="col-md-12 col-sm-12">
        <div class="card  card-box">
          <div class="card-head">
            <header>Orders</header>
          </div>
          <div class="card-body ">
            <div>
              <div class=" pull-left">
                <div class="page-title" id="product_list_title">Orders List</div>
              </div>
            </div>
            <div>
              <table class="table table-bordered table-striped text-center font-baloo">
                <thead class="text-uppercase">
                  <tr>
                    <th>Sr.no</th>
                    <th>order date</th>
                    <th>address</th>
                    <th>payment type</th>
                    <th>payment status</th>
                    <th>order status</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                    $result = mysqli_query($conn,"SELECT * FROM `order` ORDER BY `added_on` desc");
                    if(mysqli_num_rows($result) > 0) {
                      while($row = mysqli_fetch_assoc($result)){
                          $order_status = mysqli_fetch_assoc(mysqli_query($conn,"SELECT status_name FROM order_status_data WHERE id='{$row['order_status']}'"));
                        ?>
                    
                      <tr>
                        <td>
                          <a href="<?php echo ROUTE_AJAX_URL; ?>manage_order_details.php?id=<?php echo $row['id'];  ?>"><button type="button" class="btn btn-warning font-size-12"><?php echo $row['id']; ?></button></a>
                        </td>
                        <td><?php echo $row['added_on']; ?></td>
                        <td><strong>Address:</strong> <?php echo $row['user_address']; ?>&nbsp; <strong>City/Sate:</strong> <?php echo $row['user_city']; ?>&nbsp; <strong>Pincode:</strong> <?php echo $row['user_post_code']; ?></td>
                        <td><?php echo $row['payment_type']; ?></td>
                        <td><?php echo $row['payment_status']; ?></td>
                        <td><?php echo $order_status['status_name']; ?></td>
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
