<?php require_once("header.php"); 
  if(isset($_SESSION['USER_LOGIN']) && $_SESSION['USER_LOGIN'] === 'yes'){
    header('location:index.php');
  } 

?>
  <div class="my-4">
      <div id="colorlib-contact">
        <div class="container">
          <div class="row">
          <div class="col-md-4 col-md-offset-1 font-rubik animate-box box_1">
            <h3>Login</h3>
            <hr class="mb-3">
            <div class="alert alert-success text-center" id="lsuccess-message" style="display:none"></div>
            <div class="alert alert-danger text-center" id="lerror-message" style="display:none"></div>
            <form id="login_user_data">
              <div class="row form-group">
                <div class="col-md-12">
                  <label for="email">Email</label>
                  <input type="email" id="lemail_id" name="lemail_id" class="form-control" placeholder="Your Email Address">
                  <span id="lerror_email" class="field_error text-danger"></span>
                </div>

                <div class="col-md-12" style="margin-top: 25px;">
                  <label for="name">Password</label>
                  <input type="password" id="lpassword" class="form-control" placeholder="Your password" name="lpassword">
                  <span id="lerror_password" class="field_error text-danger"></span>
                </div>
              </div>
              <div class="form-group text-center mt-5">
                <input type="submit" value="Login" id="login_user" name="login_user" class="btn color-second-bg text-white">
              </div>
            </form>		
          </div>

          <div class="col-md-8 col-md-offset-1 animate-box font-rubik">
            <h3>Register</h3>
            <hr class="mb-3">
            <div class="alert alert-success text-center" id="rsuccess-message" style="display:none"></div>
            <div class="alert alert-danger text-center" id="rerror-message" style="display:none"></div>
            <form id="register_user_data">
              <div class="row form-group mb-3">
                <div class="col-md-6">
                  <label for="name">Name</label>
                  <input type="text" id="u_name" class="form-control" placeholder="Your Full Name" name="u_name">
                  <span id="error_name" class="field_error text-danger"></span>
                </div>
                
                <div class="col-md-6">
                  <label for="lname">Mobile-No</label>
                  <input type="number" id="u_mobile" name="u_mobile"class="form-control" placeholder="Your Mobile">
                  <span id="error_mobile" class="field_error text-danger"></span>
                </div>
              </div>

              <label for="email">Email</label>
              <div class="row form-group">
                  <input type="email" id="u_email" name="u_email" class="form-control" placeholder="Your Email Address">
                  <button type="button" class="email_sent_otp btn color-second-bg text-white"  onclick="email_sent_otp();">Send OTP</button>
                  <input type="number" id="email_otp" class="form-control email_verify_otp" placeholder="Enter OTP">
                  <button type="button" class="email_verify_otp btn color-second-bg text-white"  onclick="email_verify_otp();">Verify OTP</button>
                  <span id="error_email" class="field_error text-danger"></span>
              </div>

              <div class="form-group">
                <label for="name">Password</label>
                <input type="password" id="u_password" class="form-control" placeholder="Your password" name="u_password">
                <span id="error_password" class="field_error text-danger"></span>
              </div>
              <div class="form-group text-center mt-5">
                <input type="submit" value="Register" id="register_user" name="register_user" class="btn color-second-bg text-white">
              </div>
            </form>		
          </div>
        </div>
      </div>
    </div>
    <input type="text" id="is_email_verified" style="display:none"/>
  </div>
<?php require_once("footer.php"); ?>
