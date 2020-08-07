
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
				  <button type="submit" class="btn color-second-bg text-white mb-2">Subscribe</button>
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

			}
		});

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
								$("#register_user_data")[0].reset();
								setTimeout(() => {
									$("#rerror-message").hide();
									$("#rsuccess-message").hide();
								}, 3000);
							}
							if(data === "incorrect"){
								$("#rerror-message").show();
								$("#rerror-message").text("Registered Successfully");
								$("#register_user_data")[0].reset();
								setTimeout(() => {
									$("#rerror-message").hide();
									$("#rsuccess-message").hide();
								}, 3000);
							}
						}
					})
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
			let sub_name_btn = $("#login_user").val();
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
				if(sub_name_btn === 'SignIn'){
					$.ajax({
						url : "<?php echo SITE_URL; ?>login_user_account.php",
						type : "POST",
						data : {lemail_id:lemail_id,lpassword:lpassword,sub_name_btn:sub_name_btn},
						success : data => {
							if(data == "incorrect"){
								$("#lerror_password").html("Password is incorrect");
							}
							if(data === "email_wrong"){
								$("#lerror_email").html("Email is incorrect");
							}
							if(data === "correct"){
								window.location.href = window.location.href;
							}
						}
					})
				}
			}
    })
  })
</script>