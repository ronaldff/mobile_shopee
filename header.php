<?php
 
	require_once("importantfile.php");
  require_once("Add_to_cart_inc.php");
  $obj = new Add_to_cart_inc();
	$totalProductCart =  $obj->totalProduct();
	// categories fetch
	$sql = "SELECT id,categories_name FROM categories WHERE status='1'";
	$result = mysqli_query($conn, $sql);
	$resultarray = array();
	if(mysqli_num_rows($result) > 0){
		while($row = mysqli_fetch_assoc($result)){
			$resultarray[] = $row;
		}
	}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Online Mobile <?php echo $title; ?></title>

    <!-- Bootstrap cdn -->
    <link rel="stylesheet" href="<?php  echo SITE_URL; ?>assets/bootstrap/css/bootstrap.min.css" />

    <!-- Owl Carousel cdn -->
    <link rel="stylesheet" href="<?php  echo SITE_URL; ?>assets/OwlCarousel2/owl.carousel.min.css" />
    <link rel="stylesheet" href="<?php  echo SITE_URL; ?>assets/OwlCarousel2/owl.theme.default.min.css"  />

    <!-- Font awesome cdn -->
	<link rel="stylesheet" href="<?php  echo SITE_URL; ?>assets/font-awesome/all.min.css"  />
	

    <!-- custom css -->
    <link rel="stylesheet" href="<?php  echo SITE_URL; ?>style.css">
</head>
<body>
	<!-- start #header -->
	<header id="header">
		<div class="strip d-flex justify-content-between px-4 py-1 bg-light">
				<p class="font-rale font-size-24 text-black-50 m-0">
					<?php 
						if(isset($_SESSION['USER_LOGIN'])){
							echo $_SESSION['REGISTER_USERNAME'];
						}
					?>
				</p>
				<div class="font-rale font-size-14">
					<?php 
						if(isset($_SESSION['USER_LOGIN'])){
							echo '<a href="'.SITE_URL.'user_logout.php" class="px-3 border-right border-left text-dark">Logout</a>
								<a href="'.SITE_URL.'my_order.php" class="px-3 border-right border-left text-dark">My Order</a>
							';
						} else {
							echo '<a href=" '.SITE_URL.'create_account.php" class="px-3 border-right border-left text-dark">Create Account</a>';
						}
					
					?>
					<?php 
						if(isset($_SESSION['USER_LOGIN']) && !empty($_SESSION['USER_LOGIN'])){ ?>
							<a href="wishlist_page.php" class="px-3 border-right text-dark">Whishlist (<span id="wishlistCount">0</span>)</a>
					<?php	}
					?>
						
				</div>
		</div>

		<!-- Primary Navigation -->
		<nav class="navbar navbar-expand-lg navbar-dark color-second-bg">
			<a class="navbar-brand" href="<?php  echo SITE_URL; ?>">Online Mobile </a>
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>
			<div class="collapse navbar-collapse" id="navbarNav">
				<ul class="navbar-nav m-auto font-rubik">
					<li class="nav-item active">
						<a class="nav-link" href="<?php  echo SITE_URL; ?>">Home</a>
					</li>
					<?php 
						if(isset($resultarray) && !empty($resultarray) && count($resultarray) > 0){
							foreach ($resultarray as $key => $category) { 
								?>
								<li class="nav-item">
									<a class="nav-link" href="<?php echo SITE_URL; ?>category_wise_product.php?id=<?php echo $category['id'];  ?>"><?php echo ucfirst($category['categories_name']); ?></a>
								</li>
					<?php		}
						}
						
					?>
						<li class="nav-item">
							<a class="nav-link" href="<?php  echo SITE_URL; ?>contact.php">Contact</a>
						</li>
				</ul>
				<form class="form-inline my-2 my-lg-0" method="post" action="search_product.php">
					<input class="form-control mr-sm-2" type="text" name="search_product" placeholder="Search Products" aria-label="Search">
				</form>
				
				<div class="font-size-14 font-rale">
					<a href="<?php echo SITE_URL; ?>cart.php" class="py-2 rounded-pill color-primary-bg">
						<span class="font-size-16 px-2 text-white"><i class="fas fa-shopping-cart"></i></span>
						<span class="px-3 py-2 rounded-pill text-dark bg-light" id="shopping_data"><?php echo $totalProductCart; ?></span>
					</a>
				</div>
			</div>
		</nav>
		<!-- !Primary Navigation -->
	</header>
	<!-- !start #header -->