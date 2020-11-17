<?php
 require_once("../connection.inc.php");
 require_once("admin_constant.php");
 require_once("../functions.inc.php");

 if(isset($_POST['edit_id'])){
   $sql = "SELECT * FROM admin_user WHERE id='{$_POST['edit_id']}' AND admin_role='1'";
   $result = mysqli_query($conn,$sql);
   $output = "";
   if(mysqli_num_rows($result) > 0){
     $row = mysqli_fetch_assoc($result);
     $output .= "
                  <form id='update_vendor_form'>
                  <div class='row'>
                    <div class='col-md-6'>
                      <div class='form-group'>
                        <label for='name'>Vendor Name:</label>
                        <input type='hidden' value='{$_POST['edit_id']}' name='vendor_id'>
                        <input type='text' class='form-control' id='vendor_name' name='vendor_name' value='{$row['admin_user']}' required>
                      </div>
                      <div class='form-group'>
                        <label for='password'>Vendor Password:</label>
                        <input type='text' class='form-control' id='admin_password' name='admin_password' value='{$row['vendor_show_password']}' required>
                      </div>
                    </div>
                    
                    <div class='col-md-6'>
                        <div class='form-group'>
                            <label for='email'>Vendor Email:</label>
                            <input type='email' class='form-control' id='email' name='email' value='{$row['email']}' required>
                        </div>
                        <div class='form-group'>
                            <label for='mobile'>Vendor Mobile:</label>
                            <input type='number' class='form-control' id='mobile' name='mobile' value='{$row['mobile']}' required>
                        </div>
                    </div>
                  </div>
                  ";
                $output .=  "
                  <div class='row'>
                    <div class='col-md-5'></div>
                    <div class='col-md-4'>
                      <input type='submit' value='Update Vendor' name='update_vendor_btn' class='btn btn-primary'>
                    </div>
                    <div class='col-md-3'></div>
                  </div>
                </form>
                ";
      echo $output;
   }

 }

?>