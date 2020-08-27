<?php require_once("header.php"); ?>
<?php
  $reset_text = get_safe_value($conn, $_GET['reset']);

  if($reset_text === md5('reset_text') && !empty($reset_text)){
    $email_id = get_safe_value($conn, $_GET['key']);
    $_SESSION['ENCRYPT_EMAIID'] = $email_id;
    ?>
    <div class="container">
      <div class="row">
        <div class="col-md-4"></div>
        <div class="col-md-4">
          <h2 class="mt-3 text-center">Reset Password</h2>
          <div class="alert alert-danger text-center" id="reset_error-message" style="display:none"></div>
          <form id="reset_password_data" class="my-4">
            <div class="row form-group">
              <div class="col-md-12">
                <label for="name">New Password</label>
                <input type="password" id="rpassword" class="form-control" placeholder="Your password" name="rpassword">
              </div>
            </div>
            <div class="form-group text-center mt-5">
              <button type="button" class="btn color-second-bg text-white reset_password_text" onclick="reset_password();">Reset Password</button>
            </div>
          </form>
        </div>
        <div class="col-md-4"></div>
      </div>
    </div>
  <?php } else { 
    header("location:index.php");

  }




?>

<?php require_once("footer.php"); ?>