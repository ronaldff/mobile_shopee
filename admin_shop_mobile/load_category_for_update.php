<?php
 require_once("../connection.inc.php");
 require_once("admin_constant.php");
 require_once("../functions.inc.php");

 if(isset($_POST['edit_id'])){
   $sql = "SELECT * FROM categories WHERE id='{$_POST['edit_id']}'";
   $result = mysqli_query($conn,$sql);
   $output = "";
   if(mysqli_num_rows($result) > 0){
     $row = mysqli_fetch_assoc($result);
     $output .= "
                  <tr><td><input type='text' id='category_name' name='categories_name' class='form-control' value='{$row['categories_name']}'>
                  <input type='hidden' id='category_id' name='id' class='form-control' value='{$row['id']}'>
                  </td>
                  </tr>
                  <tr>
                    <td><input type='submit' name='update_category' id='update_category' value='Update' class='btn btn-primary' style='cursor:pointer;'></td>
                  </tr>
                ";
      echo $output;
   }

 }


 

?>