<?php
    require_once("../connection.inc.php");
    require_once("admin_constant.php");
    require_once("../functions.inc.php");

    $vendor_name = get_safe_value($conn,strtolower($_POST['vendor_name']));
    $vendor_password = get_safe_value($conn,sha1(md5($_POST['vendor_password'])));
    $vendor_email = get_safe_value($conn,$_POST['vendor_email']);
    $vendor_mobile = get_safe_value($conn,$_POST['vendor_mobile']);
    $vendor_show_password = get_safe_value($conn,$_POST['vendor_password']);

    $sql = "SELECT admin_user FROM admin_user WHERE admin_user='{$vendor_name}'";
    $db_vendor_data = mysqli_query($conn, $sql);
    if(mysqli_num_rows($db_vendor_data) >= 0){
        $row = mysqli_fetch_assoc($db_vendor_data);
        if(empty($row)){
            $sql = "INSERT INTO admin_user (admin_user, admin_password,vendor_show_password, admin_role, email, mobile, admin_status) VALUES ('{$vendor_name}','{$vendor_password}','{$vendor_show_password}','1','{$vendor_email}','{$vendor_mobile}','1')";
            $result = mysqli_query($conn, $sql);
            if($result === true){
                echo "2";
            } else {
                echo "3";
            }
        }else {
            if(trim($row['admin_user']) === $vendor_name){
                echo "1";
            } 
        }

    }



?>