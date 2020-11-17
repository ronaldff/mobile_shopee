<?php 
   session_start();
   include_once("admin_constant.php");
   if(isset($_SESSION['ADMIN_LOGIN']) && !empty($_SESSION['ADMIN_LOGIN'])){
      header("Location:".ROUTE_AJAX_URL."dashboard.php");
   }

?>
   
<!doctype html>
<html class="no-js" lang="">
   <meta http-equiv="content-type" content="text/html;charset=UTF-8" />
   <head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <title>Login Page</title>
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <link rel="stylesheet" href="<?php echo ADMIN_LOGIN_LINK_URL; ?>css/normalize.css">
      <link rel="stylesheet" href="<?php echo ADMIN_LOGIN_LINK_URL; ?>css/bootstrap.min.css">
      <link rel="stylesheet" href="<?php echo ADMIN_LOGIN_LINK_URL; ?>css/font-awesome.min.css">
      <link rel="stylesheet" href="<?php echo ADMIN_LOGIN_LINK_URL; ?>css/themify-icons.css">
      <link rel="stylesheet" href="<?php echo ADMIN_LOGIN_LINK_URL; ?>css/pe-icon-7-filled.css">
      <link rel="stylesheet" href="<?php echo ADMIN_LOGIN_LINK_URL; ?>css/flag-icon.min.css">
      <link rel="stylesheet" href="<?php echo ADMIN_LOGIN_LINK_URL; ?>css/cs-skin-elastic.css">
      <link rel="stylesheet" href="<?php echo ADMIN_LOGIN_LINK_URL; ?>css/login_style.css">
      <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800' rel='stylesheet' type='text/css'>
   </head>
   <body class="bg-dark">
      <div class="sufee-login d-flex align-content-center flex-wrap">
         <div class="container">
            <div class="login-content">
               <div class="login-form mt-150">
                  <div class="alert alert-danger text-center text-uppercase message" style="display:none;"></div>
                  <form id="login_form">
                     <div class="form-group">
                        <label>USER NAME</label>
                        <input type="text" name="admin_user" class="form-control" placeholder="User Name" id="username">
                     </div>
                     <div class="form-group">
                        <label>PASSWORD</label>
                        <input type="password" name="admin_password" class="form-control" placeholder="Password" id="password">
                     </div>
                     <button type="submit" name="admin_login" class="btn btn-success btn-flat m-b-30 m-t-30" id="submit_admin">Sign in</button>
					</form>
               </div>
            </div>
         </div>
      </div>
      <script src="<?php echo ADMIN_LOGIN_LINK_URL; ?>js/vendor/jquery-2.1.4.min.js" type="text/javascript"></script>
      <script src="<?php echo ADMIN_LOGIN_LINK_URL; ?>js/jquery.slim.min.js"></script>
      <script src="<?php echo ADMIN_LOGIN_LINK_URL; ?>js/jquery.popper.min.js" type="text/javascript"></script>
      <script src="<?php echo ADMIN_LOGIN_LINK_URL; ?>js/plugins.js" type="text/javascript"></script>
      <script src="<?php echo ADMIN_LOGIN_LINK_URL; ?>js/main.js" type="text/javascript"></script>
      <script src="<?php echo ADMIN_LOGIN_LINK_URL; ?>js/custom.js"></script>
   </body>
</html>
<script>
$(document).ready(function(){
  // admin login script
  $("#login_form").submit(function(e){
    e.preventDefault();
    let username = $("#username").val();
    let password = $("#password").val();
    let status = $("#submit_admin").attr("name");

    if(username === '' || password === ""){
      displayMessage('please fill all fields',false);
    } else {
      $.ajax({
         url : '<?php echo ROUTE_AJAX_URL; ?>check_login.php',
         type : 'POST',
         data : {username : username,password:password,status:status},
         success : function(data){
            if(data == "wrong credential"){
               displayMessage("please insert correct credential", false);
               $("#login_form")[0].reset();
            }else if(data == "deactivate"){
               displayMessage("Account Deactivated. Please contact to admin for activate the account", false);
               $("#login_form")[0].reset();
            } else {
               location.href = data;
            }
         }
      })	
    }

  })

  // error and success message
  function displayMessage(msg,status){
    if(status === false){
      $(".message").show();
      $(".message").text(msg);
      timeoutMessage(); 
    }
  }

  // hide error after some time
  function timeoutMessage(){
    setTimeout(() => {
      $(".message").hide();
    }, 3000);
  }
})
</script>