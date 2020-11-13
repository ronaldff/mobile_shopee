  <?php
  require_once("importantfile.php");
	require_once("header.php");
  if(empty($_SESSION['cart']) && count($_SESSION['cart']) === 0){
    header('location:index.php');
  }

  if(isset($_POST['register_user_address']) && $_POST['register_user_address'] === 'Register Address'){
  	$user_address = get_safe_value($conn,$_POST['user_address']);
  	$user_city = get_safe_value($conn,$_POST['user_city']);
  	$user_post_code = get_safe_value($conn,$_POST['user_post_code']);
		$payment_type = get_safe_value($conn,$_POST['payment_type']);
		$payment_status = 'pending';
  	if($payment_type === 'chash_on_delivery'){
  		$payment_status = 'pending';
  	}
  	$totalCalculation = 0; 
		foreach ($_SESSION['cart'] as $key => $cartData) { 
			$productDataByCart = getProductById($conn,$key);
			$totalCalculation =  $totalCalculation + ($productDataByCart['product_sale_price'] * $cartData['qty'] );
		}
  	$user_id = $_SESSION['REGISTER_USER_ID'];
  	$order_status = 1;
  	$total_price = $totalCalculation;
		$added_on = date('y-m-d h:i:s');
		if($payment_type === 'online_payment'){
			$txnid = substr(hash('sha256', mt_rand() . microtime()), 0, 20);

		} else {
			$txnid = 0;
		}
		

  	// order table
  	mysqli_query($conn,"INSERT INTO `order` (user_id,user_address,user_city,user_post_code,payment_type,payment_status,order_status,txnid,total_price,added_on) VALUES ('{$user_id}','{$user_address}','{$user_city}','{$user_post_code}','{$payment_type}','{$payment_status}','$order_status','{$txnid}','{$total_price}','{$added_on}')");

  	$order_id = mysqli_insert_id($conn);
  	foreach ($_SESSION['cart'] as $key => $cartData) { 
			$productDataByCart = getProductById($conn,$key);
			$totalCalculation =  $totalCalculation + ($productDataByCart['product_sale_price'] * $cartData['qty'] );
	  	$order_product_id = $key;
	  	$order_quantity = $cartData['qty'];
	  	$order_price = $productDataByCart['product_sale_price'];
  		mysqli_query($conn,"INSERT INTO `order_details` (order_id,product_id,qty,price) VALUES('{$order_id}','{$order_product_id}','{$order_quantity}','{$order_price}')");

		}	
		unset($_SESSION['cart']);
		// payu code
		if($payment_type === 'online_payment'){
			$MERCHANT_KEY = "X5XaZRAW";
			$SALT = "YdhoAVSCpO";
			// Merchant Key and Salt as provided by Payu.
			
			$PAYU_BASE_URL = "https://sandboxsecure.payu.in";		// For Sandbox Mode
			//$PAYU_BASE_URL = "https://secure.payu.in";			// For Production Mode
			
			$action = '';
			
			if(!empty($_POST)) {
					//print_r($_POST);
				foreach($_POST as $key => $value) {    
					$posted[$key] = $value; 
				
				}
			}

			// user details
		$rowDataUser = mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM registered_users WHERE id = {$_SESSION['REGISTER_USER_ID']}"));
			
			$formError = 0;
			// Generate random transaction id
			
			$posted['txnid'] = $txnid;
			$posted['surl'] = SITE_URL.'success.php';
			$posted['furl'] = SITE_URL.'failure.php';
			$posted['amount'] = $total_price;
			$posted['firstname'] = $rowDataUser['u_name'];
			$posted['email'] = $rowDataUser['u_email'];
			$posted['phone'] = $rowDataUser['u_mobile'];
			$posted['productinfo'] = "productinfo";
			$posted['key'] = $MERCHANT_KEY;
			$posted['service_provider'] = "payu_paisa";
			
			
			$hash = '';
			// Hash Sequence
			$hashSequence = "key|txnid|amount|productinfo|firstname|email|udf1|udf2|udf3|udf4|udf5|udf6|udf7|udf8|udf9|udf10";
			if(empty($posted['hash']) && sizeof($posted) > 0) {
				
				if(
						empty($posted['key'])
						|| empty($posted['txnid'])
						|| empty($posted['amount'])
						|| empty($posted['firstname'])
						|| empty($posted['email'])
						|| empty($posted['phone'])
						|| empty($posted['productinfo'])
						|| empty($posted['surl'])
						|| empty($posted['furl'])
						|| empty($posted['service_provider'])
				) {
					$formError = 1;
				} else {
					$hashVarsSeq = explode('|', $hashSequence);
					$hash_string = '';	
					foreach($hashVarsSeq as $hash_var) {
							$hash_string .= isset($posted[$hash_var]) ? $posted[$hash_var] : '';
							$hash_string .= '|';
						}
			
					$hash_string .= $SALT;
					$hash = strtolower(hash('sha512', $hash_string));
					$action = $PAYU_BASE_URL . '/_payment';
				}
			} elseif(!empty($posted['hash'])) {
				$hash = $posted['hash'];
				$action = $PAYU_BASE_URL . '/_payment';
			}
			
			$formHtml = '<form action="'.$action.'?>" method="post" name="payuForm" id="payuForm">
						<input type="hidden" name="key" value="'.$MERCHANT_KEY.'" size="64"/><br>
						<input type="hidden" name="hash" value="'.$hash.'" size="150"/><br>
						<input type="hidden" name="txnid" value="'.$txnid.'" size="64"/><br>
						<input type="hidden" name="amount" value="'.$posted['amount'].'" size="64"/><br>
						<input type="hidden" name="firstname" id="firstname" value="'.$posted['firstname'].'" size="64"/><br>
						<input type="hidden" name="email" id="email" value="'.$posted['email'].'" size="64"/><br>
						<input type="hidden" name="phone" id="phone" value="'.$posted['phone'].'" size="64"/><br>
						<input type="hidden" name="productinfo" id="productinfo" value="'.$posted['productinfo'].'" size="64"/><br>
						<input type="hidden" name="surl" id="surl" value="'.$posted['surl'].'" size="64"/><br>
						<input type="hidden" name="furl" id="furl" value="'.$posted['furl'].'" size="64"/><br>
						<input type="hidden" name="service_provider" id="service_provider" value="'.$posted['service_provider'].'" size="64"/><br>
						<input type="hidden" type="submit" value="Submit" />
			</form>';
			echo $formHtml;
			echo '<script>
				 
						document.getElementById("payuForm").submit();
				</script>';
		} else {
			header('Location:thank_you.php');
		}
  }
  
?>
<!-- cart-main-area start -->
<div class="checkout-wrap pt-5">
	<div class="container">
		<div class="row">
			<div class="col-md-8">
				<div class="checkout__inner">
					<div class="accordion-list">
						<div class="accordion">
							<?php
								$accodian_class = 'accordion__title';
								if(!isset($_SESSION['USER_LOGIN'])) { $accodian_class = 'accordion__hide'; ?>
									<div class="<?php echo $accodian_class; ?>">
										Checkout Method
									</div>
									<div class="accordion__body">
										<div class="accordion__body__form">
											<div class="row">
												<div class="col-md-12">
													<div class="checkout-method__login">
													<form id="login_user_data">
														<h5 class="checkout-method__title">login</h5>
														<div class="row form-group">
															<div class="col-md-12 mb-3">
																<input type="email" id="lemail_id" name="lemail_id" class="form-control" placeholder="Your Email Address">
																<span id="lerror_email" class="field_error text-danger"></span>
															</div>
															<div class="col-md-12">
																<input type="password" id="lpassword" class="form-control" placeholder="Your password" name="lpassword">
																<span id="lerror_password" class="field_error text-danger"></span>
															</div>
														</div>
														<div class="form-group text-center mt-5">
															<input type="submit" value="Login" id="login_user" name="login_user" class="btn color-second-bg text-white">
														</div>
													</form>
													<div class="text-center">
														<a href="create_account.php">Create Account From This Link</a>
													</div>
													
													</div>
												</div>
												<hr>
												<div class="col-md-12">
													<div class="checkout-method__login">
														<div class="alert alert-success text-center" id="rsuccess-message" style="display:none"></div>
														<div class="alert alert-danger text-center" id="rerror-message" style="display:none"></div>
													</div>
												</div>
											</div>
										</div>
									</div>
							<?php	} ?>
							<div class="<?php echo $accodian_class; ?>">
									Address Information
							</div>
							<div class="accordion__body">
								<div class="bilinfo">
									<form id="address_user_information_form" method="post">
										<div class="row">
											<div class="col-md-12">
												<div class="form-group">
													<textarea name="user_address" id="user_address" class="form-control" cols="20" rows="5" placeholder="Enter Postal Address" required></textarea>
												</div>
											</div>
											<div class="col-md-6">
												<div class="form-group">
													<input type="text" name="user_city" placeholder="City/State" class="form-control" id="user_city" required>
												</div>
											
											</div>
											<div class="col-md-6">
												<div class="form-group">
													<input type="number" name="user_post_code" placeholder="Post code/ zip" class="form-control" id="user_post_code" required>
												</div>
											</div>
										</div>
								</div>
								
							
								<div class="text-uppercase font-rale font-size-24 m-3"><strong>payment information</strong></div>
								<div class="paymentinfo">
								
									<div class="form-check-inline">
										<strong class="text-uppercase font-rale font-size-12 color-second">chash:</strong>  &nbsp;<input type="radio" class="form-check-input" name="payment_type" value="chash_on_delivery" required>
									</div>
									&nbsp;&nbsp;&nbsp;&nbsp;
									<div class="form-check-inline">
									<strong class="text-uppercase font-rale font-size-12 color-primary">Online Payment:</strong> &nbsp;<input type="radio" class="form-check-input" name="payment_type" value="online_payment" required>
									</div>
									<div class="col-md-12 mt-5">
										<div class="form-group text-center ">
											<input type="submit" value="Register Address" id="register_user_address" name="register_user_address" class="btn color-second-bg text-white form-control">
										</div>
									</div>
								</div>
							</div>
						</form>

						</div>
					</div>
				</div>
			</div>
			<div class="col-md-4">
				<div class="order-details">
					<h5 class="order-details__title">Your Order</h5>
					<div class="order-details__item">
						<?php 
							if(isset($_SESSION['cart']) && count($_SESSION['cart']) > 0){
								$totalCalculation = 0; 
								foreach ($_SESSION['cart'] as $key => $cartData) { 
									$productDataByCart = getProductById($conn,$key);
									$totalCalculation =  $totalCalculation + ($productDataByCart['product_sale_price'] * $cartData['qty'] );
								?>
						<div class="single-item">
							<div class="single-item__thumb">
								<img src="<?php echo PRODUCT_URL; ?><?php echo $productDataByCart['product_image']; ?>" style="height: auto;" alt="cart1" class="img-fluid">
							</div>
							<div class="single-item__content">
								<h6 class="font-baloo"><?php echo ucwords($productDataByCart['product_name']); ?></h6>
								<span class="price">Rs<?php echo $productDataByCart['product_sale_price'];?></span>
								<span>Qty: <?php echo $cartData['qty']; ?></span>
							</div>
							<div class="single-item__remove">
								<button onclick="manageCart(<?php echo $key; ?>,'remove')" type="button" class="btn font-baloo text-danger px-2 border-right" title="Remove Product">x</button>
							</div>
						</div>
						<?php }}?>
					</div>
					<div class="ordre-details__total">
						<h5>Order total</h5>
						<span class="price">
							<?php 
							if(isset($_SESSION['cart']) && count($_SESSION['cart']) > 0){
									print_r($totalCalculation);
								}  else {
									echo 0;
								} ?>
						</span>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- cart-main-area end -->
        <?php require_once("footer.php"); ?>