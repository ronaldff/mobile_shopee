 <?php
  require_once("importantfile.php");
  require_once("header.php");
  if(!isset($_SESSION['USER_LOGIN'])){
    header('Location:index.php');
  }

  if(isset($_GET['id']) && !empty($_GET['id'])){
     $order_id = get_safe_value($conn,$_GET['id']);
  }

 ?>
<!-- start #main-site -->
  <main id="main-site">

    <!-- Shopping cart section  -->
    <section id="cart" class="py-3">
      <div class="container">
        <h5 class="font-baloo font-size-20 mb-5">MY ORDER DETAILS</h5>
        <!--  shopping cart items   -->
          <div class="row">
            <div class="col-sm-12">
              <table class="table table-bordered table-striped text-center font-baloo">
                <thead class="text-uppercase">
                  <tr>
                    <th>product name</th>
                    <th>product image</th>
                    <th>quantity</th>
                    <th>order status</th>
                    <th>price</th>
                    <th>total price</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                    $user_id = $_SESSION['REGISTER_USER_ID'];
                  $sql = "SELECT `order`.total_price,`order`.order_status,order_details.qty,product.product_name,product.product_image,product.product_sale_price FROM order_details INNER JOIN `order` ON order_details.order_id = `order`.id INNER JOIN product ON order_details.product_id = product.id WHERE order_details.order_id='{$order_id}' AND `order`.`user_id` = '{$user_id}'";
                  
                    $result = mysqli_query($conn,$sql);
                    
                    if(mysqli_num_rows($result) > 0) {
                      $totalPrice = 0;            

                      while($row = mysqli_fetch_assoc($result)){ 
                          $totalPrice = $totalPrice + ($row['product_sale_price'] * $row['qty']);
                        ?>
                    
                      <tr>
                        <td><?php echo $row['product_name']; ?></td>
                        <td><img src="<?php echo PRODUCT_URL; ?><?php echo $row['product_image']; ?>" alt="" style="width:30px"> </td>
                        <td><?php echo $row['qty']; ?></td>
                        <td><?php echo $row['order_status']; ?></td>
                        <td><?php echo $row['product_sale_price']; ?></td>
                        <td><?php echo $row['product_sale_price'] * $row['qty']; ?></td>
                      </tr>

                  <?php } ?>
                        <tr>
                          <td colspan="4"></td>
                          <td>TOTAL PRICE</td>
                          <td><?php   echo $totalPrice; ?></td>
                        </tr>
               <?php } else { ?>
                        <script>
                          window.location.href = 'index.php';
                        </script>
                  <?php } ?>
                </tbody>
              </table>
            </div>
          </div>
        <!--  !shopping cart items   -->
      </div>
    </section>
    <!-- !Shopping cart section  -->

              

  </main>
<!-- !start #main-site -->
 <?php require_once('footer.php'); ?>