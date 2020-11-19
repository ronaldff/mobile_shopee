<?php
  require_once("importantfile.php");
  require_once("header.php");
  // require_once("Add_to_cart_inc.php");
  // $obj = new Add_to_cart_inc();
  if(empty($_SESSION['cart']) && count($_SESSION['cart']) === 0){
    header('location:index.php');
  } 
  
?>

  <!-- start #main-site -->
  <main id="main-site">
    <!-- Shopping cart section  -->
    <section id="cart" class="py-3">
      <div class="container-fluid w-75">
        <h5 class="font-baloo font-size-20">Shopping Cart</h5>
        <!--  shopping cart items   -->
        <div class="row">
          <div class="col-sm-9">
            <!-- cart item -->
            <?php  
              if(isset($_SESSION['cart']) && count($_SESSION['cart']) > 0){
              $totalCalculation = 0; 
                foreach ($_SESSION['cart'] as $key => $cartData) { 
                    $productDataByCart = getProductById($conn,$key);
                    $totalCalculation =  $totalCalculation + ($productDataByCart['product_sale_price'] * $cartData['qty'] );
                  ?>

                  <?php 
                    $soldQty = productQTYSoldByProductId($conn, $productDataByCart['id'] );
                    $pendingQty = $productDataByCart['product_qty'] - $soldQty;
                    if($productDataByCart['product_qty'] > $soldQty){
                      $stock =  "IN STOCK";
                    } else {
                      $stock =  "NOT IN STOCK";
                    }
                  ?>
                <div class="row border-top py-3 mt-3">
                  <div class="col-sm-2">
                    <img src="<?php echo PRODUCT_URL; ?><?php echo $productDataByCart['product_image']; ?>" style="height: auto;" alt="cart1" class="img-fluid">
                  </div>
                  <div class="col-sm-8">
                    <h5 class="font-baloo font-size-20">
                    <a class="text-dark" style="text-decoration:none" href="<?php echo SITE_URL; ?>get_single_product_info.php?id=<?php echo $productDataByCart['id']; ?>"><?php echo ucwords($productDataByCart['product_name']); ?> </a>
                      &nbsp; 
                      <strong class="bg-warning px-2 text-white">
                        <?php echo $stock; ?>
                      </strong>
                    </h5>
                    <small>by <?php echo ucfirst($productDataByCart['category_name']); ?></small>
                    <!-- product rating -->
                    <div class="d-flex">
                      MRP: <?php echo $productDataByCart['product_mrp'];?> ||
                      Sale Price: <?php echo $productDataByCart['product_sale_price'];?> ||
                      Cart Quantity : <?php echo $cartData['qty'];?> 
                     
                    </div>
                    <div class="mt-2">
                      Available Qty: <?php echo $pendingQty;?>
                    </div>
                      <!--  !product rating-->

                    <!-- product qty -->
                    <div class="qty d-flex pt-2">
                      <div class="d-flex font-rale w-25">
                        <button class="qty-up border bg-light" data-id="<?php echo $productDataByCart['id'] ?>"><i class="fas fa-angle-up"></i></button>
                        <input type="text" data-id="<?php echo $productDataByCart['id'] ?>" class="qty_input border px-2 w-100 bg-light" disabled value="<?php echo $cartData['qty'];  ?>" placeholder="1">
                        <button data-id="<?php echo $productDataByCart['id'] ?>" class="qty-down border bg-light"><i class="fas fa-angle-down"></i></button>
                      </div>
                      
                    </div>
                    <div id="actions" class="mt-2">
                      <button  onclick="manageCart(<?php echo $key; ?>,'update')" type="button" class="btn font-baloo text-danger px-2 border-right">Update Quantity</button>
                      <button onclick="manageCart(<?php echo $key; ?>,'remove')" type="button" class="btn font-baloo text-danger px-2 border-right">Remove Product</button>
                      <!-- <button type="button" class="btn font-baloo text-danger">Save for Later</button> -->
                    </div>
                  
                    <!-- !product qty -->
                  </div>

                  <div class="col-sm-2 text-right">
                    <div class="font-size-20 text-danger font-baloo">
                      Rs<span class="product_price"><?php print_r($cartData['qty'] * $productDataByCart['product_sale_price']); ?></span>
                    </div>
                  </div>
                </div>
            <?php   }}
            ?>
            
            <!-- !cart item -->

          </div>

          <!-- subtotal section-->
          <div class="col-sm-3">
            <div class="sub-total border text-center mt-2">
              <h6 class="font-size-12 font-rale text-success py-3"><i class="fas fa-check"></i> Your order is eligible for FREE Delivery.</h6>
              <div class="border-top py-4">
                <h5 class="font-baloo font-size-20">Subtotal (<?php
                  if(isset($_SESSION['cart']) && count($_SESSION['cart']) > 0){
                    echo count($_SESSION['cart']);
                  }  else {
                    echo 0;
                  }

                  ?> item):&nbsp; 

                  <span class="text-danger">Rs<span class="text-danger" id="deal-price"><?php 
                if(isset($_SESSION['cart']) && count($_SESSION['cart']) > 0){
                    print_r($totalCalculation);
                  }  else {
                    echo 0;
                  }

                   ?></span> </span> </h5>
                <a href="<?php echo SITE_URL; ?>index.php" class="btn btn-success mt-3">Shopping</a>
                
                <a href="<?php echo SITE_URL; ?>checkout.php" class="btn btn-warning mt-3">Checkout</a>
              </div>
            </div>
          </div>
          <!-- !subtotal section-->
        </div>
        <!--  !shopping cart items   -->
      </div>
    </section>
    <!-- !Shopping cart section  -->
  </main>
  <!-- !start #main-site -->
<?php require_once("footer.php"); ?>
