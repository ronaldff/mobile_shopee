<?php require_once("header.php"); ?>
<div class="container">
  <div class="row">
    <div class="col-md-4"></div>
    <div class="col-md-4">
      <h2 class="mt-3 text-center">Forgot Password</h2>
      <div class="alert alert-success text-center" id="fsuccess-message" style="display:none"></div>
      <div class="alert alert-danger text-center" id="ferror-message" style="display:none"></div>
      <form id="forget_password_data" class="my-4">
        <div class="row form-group">
          <div class="col-md-12">
            <label for="email">Email:</label>
            <input type="email" id="femail_id" name="femail_id" class="form-control" placeholder="Your Email Address">
          </div>
        </div>
        <div class="form-group text-center mt-5">
          <button type="button" class="btn color-second-bg text-white forgot_password_text" onclick="forgot_password();">Send Link For Reset Password</button>
        </div>
      </form>
    </div>
    <div class="col-md-4"></div>
  </div>
</div>
<?php require_once("footer.php"); ?>