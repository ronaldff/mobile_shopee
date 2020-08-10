<?php  

	require_once("importantfile.php");


	$type = get_safe_value($conn, $_POST['type']);


	if($type === 'email' && !empty($type)){
		$email = get_safe_value($conn, $_POST['u_email']);
		$otp = rand(1111,9999);
        $_SESSION['EMAIL_OTP'] = $otp;
		$html = "$otp is your otp.";
		include('smtp/PHPMailerAutoload.php');
		$mail = new PHPMailer(true);
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com'; 
        $mail->Port = 587;
        $mail->SMTPSecure = 'tls';                                             
        $mail->SMTPAuth   = true;                                   
        $mail->Username   = 'piyush.d.shyam@gmail.com';                     
        $mail->Password   = 'piyush1991';                               
        $mail->setFrom('piyush.d.shyam@gmail.com');
        $mail->addAddress($email);    
        $mail->isHTML(true);                                  
        $mail->Subject = 'Here Is Your OTP';
        $mail->Body    = $html;
        $mail->SMTPOptions=array('ssl'=>array('verify_peer'=>false,'verify_peer_name'=>false,'allow_self_signed'=>false));
        if($mail->send()){
        	echo "done";
        }
	}
?>