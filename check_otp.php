<?php  

	require_once("importantfile.php");
	$type = get_safe_value($conn, $_POST['type']);

	if($type === 'email' && !empty($type)){
		$email_otp = get_safe_value($conn, $_POST['email_otp']);
                if($_SESSION['EMAIL_OTP'] == $email_otp){
                        echo "done";
                }
		
        }
?>