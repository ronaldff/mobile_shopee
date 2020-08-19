<?php require_once("header.php"); ?>
<?php
	// getproducts
	$get_products = "SELECT * FROM product WHERE status='1'";
	$product_result = mysqli_query($conn, $get_products);
	
	$product_empty_array = array();
	if(mysqli_num_rows($product_result) > 0){
		while($product_data = mysqli_fetch_assoc($product_result)){
			$product_empty_array[] = $product_data;
		}
		shuffle($product_empty_array);
		$brand = array_map(function($pro){
			return $pro['category_name'];
		},$product_empty_array);
		$unique_brand = array_unique($brand);
		sort($unique_brand);
	}

	$sql = "SELECT * FROM product WHERE best_seller='1' AND status='1' LIMIT 10";
	$best_product_results = mysqli_query($conn, $sql);
	$best_data = array();
	if(mysqli_num_rows($best_product_results) > 0){
		while($bestSeller = mysqli_fetch_assoc($best_product_results)){
			$best_data[] = $bestSeller;
		}
	}

	
?>
<style>
	
</style>
	  <!-- start #main-site -->
	  <main id="main-site">

		<!-- Owl-carousel -->
		  <section id="banner-area">
			<div class="owl-carousel owl-theme">
				<div class="item">
				  <img src="assets/Banner1.png" alt="Banner1">
				</div>
				<div class="item">
				  <img src="assets/Banner2.png" alt="Banner2">
				</div>
				<div class="item">
				  <img src="assets/Banner1.png" alt="Banner3">
				</div>
			</div>
		  </section>
		<!-- !Owl-carousel -->

		<!-- Top Sale -->
		<section id="top-sale">
		  <div class="container py-5">
			<h4 class="font-rubik font-size-20">Top Sale</h4>
			<!-- owl carousel -->
			  <div class="owl-carousel owl-theme">
          <?php 
            if(isset($product_empty_array) && !empty($product_empty_array) && count($product_empty_array) > 0){
              foreach($product_empty_array as $key => $product ){ 
                ?>
                <div class="item py-2">
                  <div class="product font-rale wishlist_icon_show border py-3" style="margin:0px 5px">
                  <a href="<?php echo SITE_URL; ?>get_single_product_info.php?id=<?php echo $product['id']; ?>"><img src="<?php echo PRODUCT_URL; ?><?php echo $product['product_image']; ?>" alt="product1" class="img-fluid"></a>
                  <div class="text-center">
                    <h6><?php echo ucfirst($product['product_name']); ?></h6>
                    <div class="rating text-warning font-size-12">
											<!-- <span><i class="fas fa-star"></i></span>
											<span><i class="fas fa-star"></i></span>
											<span><i class="fas fa-star"></i></span>
											<span><i class="fas fa-star"></i></span>
											<span><i class="far fa-star"></i></span> -->
											<div class="fas fa-heart wishlist_icon" onclick="add_whislist(<?php echo $product['id'] ?>)"></div>
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

	  <!-- Special Price -->
		<section id="special-price">
		  <div class="container">
				<h4 class="font-rubik font-size-20">Special Price</h4>
				<div id="filters" class="button-group text-right font-baloo font-size-16">
					<button class="btn is-checked" data-filter="*">All Brand</button>
					<?php 
						if(isset($unique_brand) && !empty($unique_brand) && count($unique_brand) > 0){
							foreach($unique_brand as $key=>$category){
								$uppercase_cat_name = ucfirst($category);
							?>
							<button class="btn" data-filter='.<?php echo $uppercase_cat_name; ?>'><?php echo $uppercase_cat_name; ?></button>	
						<?php	}
						}
					?>
				</div>

				<div class="grid">
					<?php 
						if(isset($product_empty_array) && !empty($product_empty_array) && count($product_empty_array) > 0){
								foreach($product_empty_array as $key => $product ){ ?>
								<div class="grid-item border <?php echo ucfirst($product['category_name']); ?>">
									<div class="item py-2 wishlist_icon_show" style="width: 200px;">
										<div class="product font-rale">
											<a href="<?php echo SITE_URL; ?>get_single_product_info.php?id=<?php echo $product['id']; ?>"><img src="<?php echo PRODUCT_URL; ?><?php echo $product['product_image']; ?>" alt="product1" class="img-fluid"></a>
											<div class="text-center">
											<h6><?php echo ucfirst($product['product_name']); ?></h6>
											<div class="rating text-warning font-size-12">
												<div class="fas fa-heart wishlist_icon" onclick="add_whislist(<?php echo $product['id'] ?>)"></div>
											</div>
											<div class="price py-2 dx">
												<span class="line-through" style="text-decoration:line-through;"><?php echo $product['product_mrp'] . 'Rs'; ?></span>
                    		<span><?php echo $product['product_sale_price'] . 'Rs'; ?></span>
											</div>
											<button type="submit" class="btn btn-warning font-size-12 mb-3" onclick="manageCart(<?php echo $product['id'] ?>,'add')">Add to Cart</button>
											</div>
										</div>
									</div>
								</div>
						<?php	}
						}
					?>
				</div>
			</div>
		</section>
	  <!-- !Special Price -->

	  <!-- Best  Seller Area -->
		<section class="ptb--100">
			<div class="container">
				<div class="row">
					<div class="col-md-12">
						<div class="section__title--2 text-center">
							<h2 class="title__line text-center font-rubik">Best Seller</h2>
						</div>
					</div>
				</div>
				<div class="row">
					<!-- Start Single Category -->
					<?php array_map(function($best_seller){ ?>
					<div class="col-md-4 col-lg-3 col-sm-4 col-xs-12">
						<div class="category wishlist_icon_show border">
							<div class="ht__cat__thumb">
								<a href="<?php echo SITE_URL; ?>get_single_product_info.php?id=<?php echo $best_seller['id']; ?>"><img src="<?php echo PRODUCT_URL; ?><?php echo $best_seller['product_image']; ?>" alt="product1" class="img-fluid"></a>
							</div>
							<div class="fr__hover__info">
							<div class="fas fa-heart wishlist_icon" onclick="add_whislist(<?php echo $best_seller['id'] ?>)"></div>
							</div>
							<div class="fr__product__inner">
								<h4 class="text-center font-rubik"><?php echo ucfirst($best_seller['product_name']); ?></h4>
								<div class="price py-2 dx text-center font-rubik">
									<span class="line-through" style="text-decoration:line-through;"><?php echo 'Rs'.$best_seller['product_mrp']; ?></span>
									<span><?php echo 'Rs'.$best_seller['product_sale_price']; ?></span>
									<div class="my-3">
										<button type="submit" class="btn btn-warning font-size-12" onclick="manageCart(<?php echo  $best_seller['id']; ?>,'add')">Add to Cart</button>
									</div>
								</div>
								
							</div>
						</div>
					</div>
					<?php	}, $best_data); ?>
				</div>
			</div>
		</section>
		<!-- End Product Area -->

		<!-- New Phones -->
		<section id="new-phones">
		  <div class="container">
			<h4 class="font-rubik font-size-20">New Phones</h4>

				<!-- owl carousel -->
				<div class="owl-carousel owl-theme">
					<?php
						if(isset($product_empty_array) && !empty($product_empty_array) && count($product_empty_array) > 0){
							foreach($product_empty_array as $key => $product ){ ?>
							<div class="item py-2 bg-light">
								<div class="product font-rale wishlist_icon_show border py-3" style="margin:0px 5px">
								<a href="<?php echo SITE_URL; ?>get_single_product_info.php?id=<?php echo $product['id']; ?>"><img src="<?php echo PRODUCT_URL; ?><?php echo $product['product_image']; ?>" alt="product1" class="img-fluid"></a>
								<div class="text-center">
									<h6><?php echo ucfirst($product['product_name']); ?></h6>
									<div class="rating text-warning font-size-12">
										<!-- <span><i class="fas fa-star"></i></span>
										<span><i class="fas fa-star"></i></span>
										<span><i class="fas fa-star"></i></span>
										<span><i class="fas fa-star"></i></span>
										<span><i class="far fa-star"></i></span> -->
										<div class="fas fa-heart wishlist_icon" onclick="add_whislist(<?php echo $product['id'] ?>)"></div>
									</div>
									<div class="price py-2">
										<span class="line-through" style="text-decoration:line-through;"><?php echo $product['product_mrp'] . 'Rs'; ?></span>
										<span><?php echo $product['product_sale_price'] . 'Rs'; ?></span>
									</div>
									<button type="submit" class="btn btn-warning font-size-12" onclick="manageCart(<?php echo $product['id'] ?>,'add')">Add to Cart</button>
								</div>
							</div>
						</div>

					<?php	}}?>
						
				</div>
				<!-- !owl carousel -->
		  </div>
		</section>
		<!-- !New Phones -->

		<!-- Blogs -->
		  <section id="blogs">
			<div class="container py-4">
			  <h4 class="font-rubik font-size-20">Latest Blogs</h4>
			  <hr>

			  <div class="owl-carousel owl-theme">
				<div class="item">
				  <div class="card border-0 font-rale mr-5" style="width: 18rem;">
					<h5 class="card-title font-size-16">Upcoming Mobiles</h5>
					<img src="assets/blog/blog1.jpg" alt="cart image" class="card-img-top">
					<p class="card-text font-size-14 text-black-50 py-1">Lorem ipsum dolor sit amet consectetur adipisicing elit. Veritatis non iste sequi cupiditate tempora iure. Velit accusamus saepe harum sed.</p>
					<a href="#" class="color-second text-left">Go somewhere</a>
				  </div>
				</div>
				<div class="item">
				  <div class="card border-0 font-rale mr-5" style="width: 18rem;">
					<h5 class="card-title font-size-16">Upcoming Mobiles</h5>
					<img src="assets/blog/blog2.jpg" alt="cart image" class="card-img-top">
					<p class="card-text font-size-14 text-black-50 py-1">Lorem ipsum dolor sit amet consectetur adipisicing elit. Veritatis non iste sequi cupiditate tempora iure. Velit accusamus saepe harum sed.</p>
					<a href="#" class="color-second text-left">Go somewhere</a>
				  </div>
				</div>
				<div class="item">
				  <div class="card border-0 font-rale mr-5" style="width: 18rem;">
					<h5 class="card-title font-size-16">Upcoming Mobiles</h5>
					<img src="assets/blog/blog3.jpg" alt="cart image" class="card-img-top">
					<p class="card-text font-size-14 text-black-50 py-1">Lorem ipsum dolor sit amet consectetur adipisicing elit. Veritatis non iste sequi cupiditate tempora iure. Velit accusamus saepe harum sed.</p>
					<a href="#" class="color-second text-left">Go somewhere</a>
				  </div>
				</div>
			  </div>
			</div>
		  </section>
		<!-- !Blogs -->

		</main>
	
  <!-- !start #main-site -->
<?php require_once("footer.php"); ?>


