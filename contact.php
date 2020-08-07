<?php require_once("header.php"); ?>

	<div class="my-4">
		<div id="colorlib-contact">
			<div class="container">
				<div class="row">
					<div class="col-md-12 col-md-offset-1 animate-box">
            <h3>Get In Touch</h3>
						<hr class="mb-3">
						<div class="alert alert-success text-center" id="success-message" style="display:none"></div>
						<div class="alert alert-danger text-center" id="error-message" style="display:none"></div>
						<form id="contact_us_data">
							<div class="row form-group">
								<div class="col-md-6">
									<label for="name">Name</label>
									<input type="text" id="name" class="form-control" placeholder="Your Full Name" name="name">
								</div>
								<div class="col-md-6">
									<label for="lname">Mobile-No</label>
									<input type="number" id="mobile" name="mobile"class="form-control" placeholder="Your Mobile">
								</div>
							</div>

							<div class="row form-group">
								<div class="col-md-12">
									<label for="email">Email</label>
									<input type="email" id="email_id" name="email_id" class="form-control" placeholder="Your Email Address">
								</div>
							</div>

							<div class="row form-group">
								<div class="col-md-12">
									<label for="Comment">Comment</label>
									<textarea name="comment" id="comment" cols="20" rows="6" class="form-control" placeholder="Say something about our product"></textarea>
								</div>
							</div>
							<div class="form-group text-center">
								<input type="submit" value="Send Message" class="btn color-second-bg text-white">
							</div>

						</form>		
					</div>
				</div>
			</div>
		</div>
		<div id="map" class="colorlib-map"></div>
	</div>
<?php require_once("footer.php"); ?>
<script>

  $(document).ready(function(){
    $("#contact_us_data").submit(e => {
      e.preventDefault();
      let name = $("#name").val();
      let mobile = $("#mobile").val();
      let email_id = $("#email_id").val();
      let comment = $("#comment").val();

      if(name === ''){
        alert("please insert name");
      }else if(mobile === ''){
        alert("please insert mobile");
      }else if(email_id === ''){
        alert("please insert email_id");
      }else if(comment === ''){
        alert("please insert comment");
      }else {
        $.ajax({
          url : "<?php echo SITE_URL; ?>insert_user_contact_data.php",
          type : "POST",
          data : {name:name,mobile:mobile,email_id:email_id,comment:comment},
          success : data => {
            if(data === "1"){
							$("#success-message").show();
							$("#success-message").text("Thanks for the comment, We will get back to you soon!");
							$("#contact_us_data")[0].reset();
							setTimeout(() => {
								$("#error-message").hide();
								$("#success-message").hide();

							}, 4000);
						} else if(data === "2"){
							$("#error-message").show();
							$("#error-message").text("Somethong went wrong");
							$("#contact_us_data")[0].reset();
							setTimeout(() => {
								$("#error-message").hide();
								$("#success-message").hide();

							}, 4000);
						}
          }
        })
      }

    })
  })
</script>