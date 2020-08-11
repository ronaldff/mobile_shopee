
<?php require_once("header.php"); ?>
<?php 
  if(isset($_POST['search_product']) && !empty($_POST['search_product'])){
   
    $product_search = get_safe_value($conn,$_POST['search_product']);
  

    // get search products
    $get_products = "SELECT * FROM product WHERE (product_name LIKE '%{$product_search}%' AND status='1') OR short_desc LIKE '%{$product_search}%' ";
    $product_result = mysqli_query($conn, $get_products);
    $product_empty_array = array();
    if(mysqli_num_rows($product_result) === 0){ ?>
      <script>alert("Data Not Found"); window.location.href="index.php"</script>
    <?php }else if(mysqli_num_rows($product_result) > 0){
      while($product_data = mysqli_fetch_assoc($product_result)){
        $product_empty_array[] = $product_data;
      }
    } else {
      echo "Data Not Found";
    }
  
    
    
    

  }
?>
<!-- Top Sale -->
<section id="top-sale">
    <div class="container py-5">
      <h4 class="font-rubik font-size-20">SEARCH | <?php print_r(strtoupper($product_empty_array[0]['category_name'])); ?></h4>
      <hr>
      <!-- owl carousel -->
      <div class="row">
          <?php 
            if(isset($product_empty_array) && !empty($product_empty_array) && count($product_empty_array) > 0){
              foreach($product_empty_array as $key => $product ){ 
                ?>
                <div class="col-md-4 col-xs-12 mb-5">
                  <div class="product font-rale product_box">
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
                      <button type="submit" class="btn btn-warning font-size-12" onclick="manageCart(<?php echo $product['id'] ?>,'add')">Add to Cart</button>
                    </div>
                  </div>
                </div>
          <?php }}?>
          

			  </div>
      <!-- !owl carousel -->
    </div>
  </section>
<!-- !Top Sale -->
<?php require_once("footer.php"); ?>