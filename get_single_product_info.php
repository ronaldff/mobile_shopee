<?php require_once("header.php"); ?>
<?php
  if(isset($_GET['id']) && !empty($_GET['id'])){
    $product_id = trim($_GET['id']);
    $sql = "SELECT * FROM product WHERE id = '{$product_id}'";
    $result = mysqli_query($conn,$sql);
    if(mysqli_num_rows($result) === 0){
        header("Location:index.php");
      }else if(mysqli_num_rows($result) === 1){
      $single_product_data = mysqli_fetch_assoc($result);
    }

  }

  // getproducts
	$get_products = "SELECT * FROM product WHERE status='1'";
	$product_result = mysqli_query($conn, $get_products);
	
	$product_empty_array = array();
	if(mysqli_num_rows($product_result) > 0){
		while($product_data = mysqli_fetch_assoc($product_result)){
			$product_empty_array[] = $product_data;
		}
    shuffle($product_empty_array);
  }
  
?>

 <!-- start #main-site -->
 <main id="main-site">

<!--   product  -->
    <section id="product" class="py-3">
        <div class="container">
            <div class="row">
                <div class="col-sm-6">
                    <img src="<?php echo PRODUCT_URL; ?><?php 
                          if(isset($single_product_data) && !empty($single_product_data)){
                            echo $single_product_data['product_image'];
                          }
                         ?>" alt="product" class="img-fluid">
                    <?php 
                          $soldQty = productQTYSoldByProductId($conn, $single_product_data['id']);
                          $cart_show = 'yes';
                          if($single_product_data['product_qty'] > $soldQty){
                            $stock =  "IN STOCK";
                            
                          } else {
                            $stock =  "NOT IN STOCK";
                            $cart_show = '';
                          }
                      
                    ?>
                    <?php if($cart_show !=""){ ?>
                      <div class="form-row pt-4 font-size-16 font-baloo">
                        <div class="col">
                            <a href="<?php echo SITE_URL; ?>checkout.php"><button type="submit" class="btn btn-danger form-control">Proceed to Buy</button></a>
                        </div>
                        <div class="col">
                            <button type="button" class="btn btn-warning form-control" onclick = "manageCart(<?php echo $single_product_data['id']  ?>,'add')">Add to Cart</button>
                        </div>
                      </div>
                    <?php  } ?>
                    
                </div>
                <div class="col-sm-6 py-5">
                    <h5 class="font-baloo font-size-20">
                      <?php (isset($single_product_data) && !empty($single_product_data)) ? print_r( ucwords($single_product_data['product_name'])) : " " ?>
                      <strong class="bg-warning px-2 text-white">
                        <?php echo $stock; ?>
                      </strong>
                    </h5>
                    <small>by Samsung</small>
                    <div class="d-flex">
                        <div class="rating text-warning font-size-12">
                            <span><i class="fas fa-star"></i></span>
                            <span><i class="fas fa-star"></i></span>
                            <span><i class="fas fa-star"></i></span>
                            <span><i class="fas fa-star"></i></span>
                            <span><i class="far fa-star"></i></span>
                          </div>
                          <a href="#" class="px-2 font-rale font-size-14">20,534 ratings | 1000+ answered questions</a>
                    </div>
                    <hr class="m-0">

                    <!---    product price       -->
                        <table class="my-3">
                            <tr class="font-rale font-size-14">
                                <td>M.R.P:</td>
                                <td><strike><?php (isset($single_product_data) && !empty($single_product_data)) ? print_r($single_product_data['product_mrp'] . "Rs") : " " ?></strike></td>
                            </tr>
                            <tr class="font-rale font-size-14">
                                <td>Deal Price:</td>
                                <td class="font-size-20 text-danger"><span><?php (isset($single_product_data) && !empty($single_product_data)) ? print_r($single_product_data['product_sale_price'] . "Rs") : " " ?></span><small class="text-dark font-size-12">&nbsp;&nbsp;Inclusive of all taxes</small></td>
                            </tr>
                            <tr class="font-rale font-size-14">
                                <td>You Save:</td>
                                <td><span class="font-size-16 text-danger"><?php (isset($single_product_data) && !empty($single_product_data)) ? print_r($single_product_data['product_sale_price'] . "Rs") : " " ?></span></td>
                            </tr>
                        </table>
                    <!---    !product price       -->

                     <!--    #policy -->
                        <div id="policy">
                            <div class="d-flex">
                                <div class="return text-center mr-5">
                                    <div class="font-size-20 my-2 color-second">
                                        <span class="border p-3 rounded-circle"><i class="fa fa-retweet" aria-hidden="true"></i>
                                        </span>
                                    </div>
                                    <a href="#" class="font-rale font-size-12">10 Days <br> Replacement</a>
                                </div>
                                <div class="return text-center mr-5">
                                    <div class="font-size-20 my-2 color-second">
                                        <span class="border p-3 rounded-circle"><i class="fa fa-truck" aria-hidden="true"></i>
                                        </span>
                                    </div>
                                    <a href="#" class="font-rale font-size-12">Daily Tuition <br>Deliverd</a>
                                </div>
                                <div class="return text-center mr-5">
                                    <div class="font-size-20 my-2 color-second">
                                        <span class="border p-3 rounded-circle"><i class="fas fa-check-double" aria-hidden="true"></i></span>
                                    </div>
                                    <a href="#" class="font-rale font-size-12">1 Year <br>Warranty</a>
                                </div>
                            </div>
                        </div>
                      <!--    !policy -->
                        <hr>

                    <!-- order-details -->
                        <div id="order-details" class="font-rale d-flex flex-column text-dark">
                            <small>Delivery by : Mar 29  - Apr 1</small>
                            <small>Sold by <a href="#">Daily Electronics </a>(4.5 out of 5 | 18,198 ratings)</small>
                            <small><i class="fas fa-map-marker-alt color-primary"></i>&nbsp;&nbsp;Deliver to Customer - 424201</small>
                        </div>
                     <!-- !order-details -->

                     <div class="row">
                         <div class="col-6">
                                <!-- color -->
                                    <div class="color my-3" id="btnColorBg">
                                      <div class="d-flex justify-content-between">
                                        <h6 class="font-baloo">Color:</h6>
                                        <div class="p-2 color-yellow-bg rounded-circle"><button class="btn font-size-14"></button></div>
                                        <div class="p-2 color-primary-bg rounded-circle"><button class="btn font-size-14"></button></div>
                                        <div class="p-2 color-second-bg rounded-circle"><button class="btn font-size-14"></button></div>
                                      </div>
                                    </div>
                                <!-- !color -->
                         </div>
                         <div class="col-6"></div>
                     </div>
                </div>

                <div class="col-md-12">
                    <h6 class="font-rubik mt-5 text-uppercase"><strong><u>Product Description</u></strong></h6>
                    <hr>
                    <p class="font-rale font-size-14"><?php (isset($single_product_data) && !empty($single_product_data)) ? print_r(ucwords($single_product_data['long_desc'])) : " " ?></p>
                </div>
            </div>
        </div>
    </section>
<!--   !product  -->


<!-- Top Sale -->
  <section id="top-sale">
    <div class="container py-5">
      <h4 class="font-rubik font-size-20">Top Sale</h4>
      <hr>
      <!-- owl carousel -->
      <div class="owl-carousel owl-theme">
          <?php 
            if(isset($product_empty_array) && !empty($product_empty_array) && count($product_empty_array) > 0){
              foreach($product_empty_array as $key => $product ){ 
                ?>
                <div class="item py-2">
                  <div class="product font-rale">
                  <a href="<?php echo SITE_URL; ?>get_single_product_info.php?id=<?php echo $product['id']; ?>"><img src="<?php echo PRODUCT_URL; ?><?php echo $product['product_image']; ?>" alt="product1" class="img-fluid"></a>
                  <div class="text-center">
                    <h6><?php echo ucfirst($product['product_name']); ?></h6>
                    <div class="rating text-warning font-size-12">
                    <span><i class="fas fa-star"></i></span>
                    <span><i class="fas fa-star"></i></span>
                    <span><i class="fas fa-star"></i></span>
                    <span><i class="fas fa-star"></i></span>
                    <span><i class="far fa-star"></i></span>
                    </div>
                    <div class="price py-2">
                    <span class="line-through" style="text-decoration:line-through;"><?php echo $product['product_mrp'] . 'Rs'; ?></span>
                    <span><?php echo $product['product_sale_price'] . 'Rs'; ?></span>

                    </div>
                    <button type="submit" class="btn btn-warning font-size-12">Add to Cart</button>
                  </div>
                  </div>
                </div>
          <?php }}?>
          

			  </div>
      <!-- !owl carousel -->
    </div>
  </section>
<!-- !Top Sale -->

</main>
<!-- !start #main-site -->

<?php require_once("footer.php"); ?>