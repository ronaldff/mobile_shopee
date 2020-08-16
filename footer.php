
     <!-- start #footer -->
     <footer id="footer" class="bg-dark text-white py-5">
		<div class="container">
		  <div class="row">
			<div class="col-lg-3 col-12">
			  <h4 class="font-rubik font-size-20">Online Mobile</h4>
			  <p class="font-size-14 font-rale text-white-50">Lorem ipsum dolor sit amet consectetur, adipisicing elit. Repellendus, deserunt.</p>
			</div>
			<div class="col-lg-4 col-12">
			  <h4 class="font-rubik font-size-20">Newslatter</h4>
			  <form class="form-row">
				<div class="col">
				  <input type="text" class="form-control" placeholder="Email *">
				</div>
				<div class="col">
				  <button type="submit" class="btn color-second-bg text-white mb-2 ddc">Subscribe</button>
				</div>
			  </form>
			</div>
			<div class="col-lg-2 col-12">
			  <h4 class="font-rubik font-size-20">Information</h4>
			  <div class="d-flex flex-column flex-wrap">
				<a href="<?php  echo SITE_URL; ?>" class="font-rale font-size-14 text-white-50 pb-1">Home	</a>
				<a href="#" class="font-rale font-size-14 text-white-50 pb-1">Delivery Information</a>
				<a href="#" class="font-rale font-size-14 text-white-50 pb-1">Privacy Policy</a>
				<a href="#" class="font-rale font-size-14 text-white-50 pb-1">Terms & Conditions</a>
			  </div>
			</div>
			<div class="col-lg-2 col-12">
			  <h4 class="font-rubik font-size-20">Account</h4>
			  <div class="d-flex flex-column flex-wrap">
				<a href="#" class="font-rale font-size-14 text-white-50 pb-1">My Account</a>
				<a href="#" class="font-rale font-size-14 text-white-50 pb-1">Order History</a>
				<a href="#" class="font-rale font-size-14 text-white-50 pb-1">Wish List</a>
				<a href="#" class="font-rale font-size-14 text-white-50 pb-1">Newslatters</a>
			  </div>
			</div>
		  </div>
		</div>
	  </footer>
	  <div class="copyright text-center bg-dark text-white py-2">
		<p class="font-rale font-size-14">&copy; Copyrights <?php echo date("Y") . ' ' . date("M"); ?>. Designed By <a href="<?php  echo SITE_URL; ?>" class="color-second">Piyush Shyam</a></p>
	  </div>
  <!-- !start #footer -->
      
	<script src="<?php  echo SITE_URL; ?>assets/js/jquery-3.4.1.min.js"></script>
	<!-- <script src="<?php  echo SITE_URL; ?>assets/js/jquery.slim.min.js"></script> -->
	<script src="<?php  echo SITE_URL; ?>assets/js/jquery.popper.min.js"></script>
	<script src="<?php  echo SITE_URL; ?>assets/bootstrap/js/bootstrap.min.js"></script>
	<script src="<?php  echo SITE_URL; ?>assets/font-awesome/js/all.min.js"></script>
	
	<!-- owl carousel script tags -->
	<script src="<?php  echo SITE_URL; ?>assets/OwlCarousel2/js/owl.carousel.min.js"></script>

	<!-- isotope plugin js -->
	<script src="<?php  echo SITE_URL; ?>assets/js/isotope.pkgd.min.js" ></script>
	<!-- custom js -->
	<script src="<?php  echo SITE_URL; ?>custom.js"></script>
</body>
</html>
<script>

	/*functions---------------------------------------------------
    1.manageCart
	---------------------------------------------------*/
	function manageCart(pid,type){
		if(type === 'update'){
			var qty = Number($(`.qty_input[data-id='${pid}']`).val());
		} else {
			var qty = $(".qty_input").val();
		}
		$.ajax({
			url : "<?php  echo SITE_URL; ?>set_cart.php",
			type : "POST",
			data : {pid : pid,qty : qty,type : type},
			success : data => {
				if(type === 'update' || type === 'remove'){
					window.location.href = window.location.href;
				}
				$("#shopping_data").html(data);
				getWishlistData(pid);
				fetchWishlistData();
			}
		});

	} 

	/*functions---------------------------------------------------
    2.email_sent_otp
	---------------------------------------------------*/
	function email_sent_otp(){
		$("#error_email").html('');
		var u_email = $("#u_email").val();
		if(u_email === ''){
			$("#error_email").html('Please Insert Email For verification');
		} else {
			$(".email_sent_otp ").html("Please Wait...");
			$(".email_sent_otp ").attr("disabled", true);
			$("#u_email").attr("disabled", true);
			$.ajax({
				url : "send_otp.php",
				type : "post",
				data : {u_email : u_email, type : 'email'},
				success : data => {
					if(data === "done"){
						$("#error_email").html('Please Check The Mail');
						$("#u_email").attr("disabled", true);
						$(".email_sent_otp ").hide();
						$(".email_verify_otp").show();
					} else if(data == 'email_exist'){
						$("#error_email").html('Email ID already exist.');
						$(".email_sent_otp ").html("Send OTP");
						$(".email_sent_otp ").attr("disabled", false);
						$("#u_email").attr("disabled", false);
					}else {
						$(".email_sent_otp ").html("Resend OTP");
						$(".email_sent_otp ").attr("disabled", false);
						$("#error_email").html('Please try again.');
					}
					
				}
			})
		}
	}

	/*functions---------------------------------------------------
    3.email_verify_otp
	---------------------------------------------------*/
	function email_verify_otp(){
		$("#error_email").html('');
		var email_otp = $("#email_otp").val();
		if(email_otp === ''){
			$("#error_email").html('Enter OTP');
		} else {
			$.ajax({
				url : "check_otp.php",
				type : "post",
				data : {email_otp : email_otp, type : 'email'},
				success : data => {
					if(data === "done"){
						$(".email_verify_otp ").hide();
						$("#error_email").html('Email verified.');
						$("#is_email_verified").val('1');
					} else {
						$("#error_email").html('Please enter valid otp.');
					}
					
				}
			})
			
		}

	}

	/*functions---------------------------------------------------
    4.wishlist count function
	---------------------------------------------------*/
	function getWishlistData(product_id){
		$.ajax({
			url : 'getWishlistData.php',
			type : 'post',
			data : {product_id : product_id},
			success : data => {
				$("#wishlistCount").html(data);
			}
		})
	}

	getWishlistData();

	/*functions---------------------------------------------------
    5.ADD WISHLIST
	---------------------------------------------------*/
	function add_whislist(pro_id){
		let proId = pro_id;
		$.ajax({
			url : 'whislist.php',
			type : 'post',
			data : {proId : proId},
			success : result => {
				if(result === 'not_loggedin'){
					alert("Please login for adding the wishlist")
					window.location.href='create_account.php';
				}

				if(result === 'already_added'){
					alert("Already added");
				}

				if(result === 'wishlist_added'){
					alert("wishlist added");
					getWishlistData();
					
				}
			}		
		})
	}

	/*functions---------------------------------------------------
    6.FETCH WISHLIST DATA
	---------------------------------------------------*/
	function fetchWishlistData(){
		$.ajax({
			url : 'fetchwishlist.php',
			type : 'get',
			success : data => {
				if(data === ''){
					
				} else {
					let wishlists = JSON.parse(data);
					let output = '';
					wishlists.forEach(wishlist => {
						output += `<tr>
								<td class='product-remove'><i class='fa fa-trash' onclick='removeWishlistProduct(${wishlist.id})'></i></td>

								<td class='product-thumbnail'><a href='<?php echo SITE_URL; ?>get_single_product_info.php?id=${wishlist.id}' class='font-rale'><img src='<?php echo PRODUCT_URL ?>${wishlist.product_image}' alt='product' class='img-fluid'></a></td>

								<td class='product-name'><a href='<?php echo SITE_URL; ?>get_single_product_info.php?id=${wishlist.id}' class='font-rale'>${wishlist.product_name}</a></td>
						
								<td class='product-price'><span class='amount'>Rs${wishlist.product_sale_price}</span></td>

								<td class='product-add-to-cart'>
									<button type='submit' class='btn btn-warning font-size-12' onclick='manageCart(${wishlist.id},"add")'>Add to Cart</button>
								</td>
						
							</tr>
						`
					});
					$("#wishlistData").html(output);
				}
				
			}
		})
	}
	
	fetchWishlistData();

	/*functions---------------------------------------------------
    7.REMOVE WISHLIST DATA
	---------------------------------------------------*/
	function removeWishlistProduct(product_id){
		if(confirm("Are You Want To Delete This Product?")){
			getWishlistData(product_id);
			fetchWishlistData();
		}
		
	}

	$(document).ready(function(){
    /*---------------------------------------------------
    1. Register user
    ---------------------------------------------------*/
    $("#register_user_data").submit(e => {
			e.preventDefault();
			$(".field_error").html('');
			let u_name = $("#u_name").val();
			let u_mobile = $("#u_mobile").val();
			let u_email = $("#u_email").val();
			let u_password = $("#u_password").val();
			let sub_name_btn = $("#register_user").val();
			let is_error = '';
			if(u_name === ''){
				$("#error_name").html("Name is required");
				is_error = "yes";
			}
			if(u_mobile == ''){
				$("#error_mobile").html("Mobile is required");
				is_error = "yes";
			}else{
					if($("#u_mobile").val().length != 10){
					$("#error_mobile").html("Please insert atleast 10 numbers in mobile");
					is_error = "yes";
				}
			}
			if(u_email === ''){
				$("#error_email").html("Email is required");
				is_error = "yes";
			}
			if(u_password === ''){
				$("#error_password").html("Password is required");
				is_error = "yes";
			}
			if(is_error === '')
			{
				var is_email_verified = $("#is_email_verified").val();
				if(is_email_verified == '1'){
					if(sub_name_btn === 'Register'){
						$.ajax({
							url : "<?php echo SITE_URL; ?>register_user_account.php",
							type : "POST",
							data : {u_name:u_name,u_mobile:u_mobile,u_email:u_email,u_password:u_password,sub_name_btn:sub_name_btn},
							success : data => {
								if(data === "email_exist"){
									$("#error_email").html("Email is exist");
								}
								if(data === "correct"){
									$("#rsuccess-message").show();
									$("#rsuccess-message").text("Registered Successfully");
									$("#u_email").attr("disabled", false);
									$("#is_email_verified").val('');
									$("#register_user_data")[0].reset();
									setTimeout(() => {
										$("#rerror-message").hide();
										$("#rsuccess-message").hide();
									}, 3000);
								}
								if(data === "incorrect"){
									$("#rerror-message").show();
									$("#rerror-message").text("Registration Unsuccessfully");
									$("#register_user_data")[0].reset();
									setTimeout(() => {
										$("#rerror-message").hide();
										$("#rsuccess-message").hide();
									}, 3000);
								}
							}
						})
					}
				} else {
					$("#error_email").html('Please verify Your email-ID');
				}
				
			}
    });
  
    /*---------------------------------------------------
    2. Login user
    ---------------------------------------------------*/
    $("#login_user_data").submit(e => {
			e.preventDefault();
			
			$(".field_error").html('');
			let lemail_id = $("#lemail_id").val();
			let lpassword = $("#lpassword").val();
			let is_error = '';
			
			if(lemail_id === ''){
				$("#lerror_email").html("Email is required");
				is_error = "yes";
			}
			if(lpassword === ''){
				$("#lerror_password").html("Password is required");
				is_error = "yes";
			}
			if(is_error === '')
			{
					$.ajax({
						url : "<?php echo SITE_URL; ?>login_user_account.php",
						type : "POST",
						data : {lemail_id:lemail_id,lpassword:lpassword},
						success : data => {
							
							if(data === "correct"){
								window.location.href = window.location.href;
							}

							if(data == "incorrect"){
								$("#lerror_password").html("Password is incorrect");
							}
							if(data === "email_wrong"){
								$("#lerror_email").html("Email is incorrect");
							}
							
						}
					})
			}
		})
		
		// WISHLIST ICON ANIMATION
		$(".wishlist_icon_show").mouseenter(function(){
			$(".wishlist_icon", this).css('display', 'block');
			$(".wishlist_icon", this).animate({right:'10px'},"slow");
		})

		$(".wishlist_icon_show").mouseleave(function(){
			$(".wishlist_icon", this).css('display', 'none');
			$(".wishlist_icon", this).animate({right:'0'});
		})
		
	})
	
	
</script>
