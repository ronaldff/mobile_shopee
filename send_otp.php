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
    
    if($type === 'forget_password' && !empty($type)){
        $email = get_safe_value($conn, $_POST['femail_id']);
        $check_email_exist = mysqli_query($conn, "SELECT * FROM registered_users WHERE u_email='{$email}'");
        if(mysqli_num_rows($check_email_exist) > 0){
            $result = mysqli_fetch_assoc($check_email_exist);
            $emailencrype = md5($result['u_email']);
            $reset_text = md5('reset_text');
            $link="<a href='".SITE_URL."reset_password.php?key=".$emailencrype."&reset=".$reset_text."'><button type='button' class='btn btn-success'>Click To Reset password</button></a>";
            $html = "$link is your reset button please click the button for resetting the password.";
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
            $mail->Subject = 'Reset link';
            $mail->Body    = $html; // body of the email
            $mail->SMTPOptions=array('ssl'=>array('verify_peer'=>false,'verify_peer_name'=>false,'allow_self_signed'=>false));
            if($mail->send()){
                echo "done";
            }
            
        } else {
            echo "error";
        }
    }

    if($type === 'reset_password' && !empty($type)){
        if(isset($_SESSION['ENCRYPT_EMAIID'])){
            $encryptemail = get_safe_value($conn, $_SESSION['ENCRYPT_EMAIID']);
            $check_email_exist = mysqli_query($conn, "SELECT * FROM registered_users WHERE encrypt_email='{$encryptemail}'");
            if(mysqli_num_rows($check_email_exist) > 0){
                $result = mysqli_fetch_assoc($check_email_exist);
                $password = get_safe_value($conn,$_POST['rpassword']);
                $password_encrypted = password_hash($password,PASSWORD_BCRYPT);

                $data = mysqli_query($conn, "UPDATE  registered_users SET `u_password`='{$password_encrypted}' WHERE encrypt_email='{$encryptemail}'");
                if($data === true){
                    echo "done";
                    unset($_SESSION['ENCRYPT_EMAIID']);
                }
            }
            
        } else {
            echo "error";
        }
    }
?>