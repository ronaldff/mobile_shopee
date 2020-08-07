<?php
// print_r($_POST);
require_once("importantfile.php");
echo '<b>Transaction In Process, Please do not reload</b>';
$status=$_POST["status"];
$firstname=$_POST["firstname"];
$amount=$_POST["amount"];
$txnid=$_POST["txnid"];
$posted_hash=$_POST["hash"];
$key="X5XaZRAW";
$productinfo=$_POST["productinfo"];
$email=$_POST["email"];
$salt="YdhoAVSCpO";

// Salt should be same Post Request 

If (isset($_POST["additionalCharges"])) {
       $additionalCharges=$_POST["additionalCharges"];
        $retHashSeq = $additionalCharges.'|'.$salt.'|'.$status.'|||||||||||'.$email.'|'.$firstname.'|'.$productinfo.'|'.$amount.'|'.$txnid.'|'.$key;
  } else {
        $retHashSeq = $salt.'|'.$status.'|||||||||||'.$email.'|'.$firstname.'|'.$productinfo.'|'.$amount.'|'.$txnid.'|'.$key;
         }
		 $hash = hash("sha512", $retHashSeq);
       if ($hash != $posted_hash) {
          mysqli_query($conn, "UPDATE `order` SET `payment_status`='{$status}',`payu_status`='{$status}',`mihpayid`='{$_POST['mihpayid']}' WHERE txnid='{$txnid}'");
          ?>
            <script>
               window.location.href="failure.php";
            </script>
          <?php
	      //  echo "Invalid Transaction. Please try again";
		   } else {
            // echo 'sdvd';
            mysqli_query($conn, "UPDATE `order` SET `payment_status`='{$status}',`payu_status`='{$status}',`mihpayid`='{$_POST['mihpayid']}' WHERE txnid='{$txnid}'");
            ?>
            <script>
               window.location.href="thank_you.php";
            </script>
            
            <?php
         //  echo "<h3>Thank You. Your order status is ". $status .".</h3>";
         //  echo "<h4>Your Transaction ID for this transaction is ".$txnid.".</h4>";
         //  echo "<h4>We have received a payment of Rs. " . $amount . ". Your order will soon be shipped.</h4>";
		   }
?>	