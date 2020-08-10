<?php  

	require_once("importantfile.php");
	$type = get_safe_value($conn, $_POST['type']);

	if($type === 'email' && !empty($type)){
        $email = get_safe_value($conn, $_POST['u_email']);
        $check_email_exist = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM registered_users WHERE u_email='{$email}'"));
        if($check_email_exist > 0){
            echo "email_exist";
            die();
        }
		$otp = rand(1111,9999);
        $_SESSION['EMAIL_OTP'] = $otp;
		$html = "$otp is your otp.";
		include('smtp/PHPMailerAutoload.php');
		$mail = new PHPMailer(true);
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com'; // smtp email address
        $mail->Port = 587;
        $mail->SMTPSecure = 'tls';                                             
        $mail->SMTPAuth   = true;                                   
        $mail->Username   = '';  // sender email address                   
        $mail->Password   = '';                               
        $mail->setFrom(''); // sender email address 
        $mail->addAddress($email);  // receiver email address 
        $mail->isHTML(true);                                  
        $mail->Subject = 'Here Is Your OTP';
        $mail->Body    = $html; // body of the email
        $mail->SMTPOptions=array('ssl'=>array('verify_peer'=>false,'verify_peer_name'=>false,'allow_self_signed'=>false));
        if($mail->send()){
        	echo "done";
        }
	}
?>