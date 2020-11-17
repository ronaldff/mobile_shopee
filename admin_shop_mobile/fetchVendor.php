<?php
 require_once("../connection.inc.php");
 require_once("admin_constant.php");
 require_once("../functions.inc.php");


 $sql = "SELECT * FROM admin_user WHERE admin_role='1' ORDER BY id DESC";
 $result = mysqli_query($conn,$sql);
 $output = '';
 $i = 0;
 if(mysqli_num_rows($result) > 0){
   $output .= '<table class="table table-bordered text-center">
                    <thead class="thead-dark">
                      <tr>
                        <th>Sr.No</th>
                        <th>ID</th>
                        <th>vendor Name</th>
                        <th>vendor Password</th>
                        <th>vendor Email</th>
                        <th>vendor Mobile</th>
                        <th>Status</th>
                        <th>Action</th>
                      </tr>
                  </thead>
                  <tbody>
              ';
   while ($row = mysqli_fetch_assoc($result)) {
     $output .= "<tr>
                  <td>".++$i."</td>
                  <td>{$row['id']}</td>
                  <td>{$row['admin_user']}</td>
                  <td>{$row['vendor_show_password']}</td>
                  <td>{$row['email']}</td>
                  <td>{$row['mobile']}</td>";
                  $output .="<td>";
                  if($row['admin_status'] === '0'){
                    $output .= "<button type='button' class='btn btn-danger status_change_vendor' data-status={$row['admin_status']} data-id={$row['id']}>deactive</button>";
                  } else {
                    $output .= "<button type='button' class='btn btn-success status_change_vendor' data-status={$row['admin_status']} data-id={$row['id']}>active</button>";
                  }
                  $output .="</td>";
                  $output .="
                  <td>
                    <button type='button' class='btn btn-secondary' id='vendor_edit' data-id={$row['id']}>edit</button>
                    <button type='button' class='btn btn-warning' id='vendor_delete' data-id={$row['id']}>delete</button>
                  </td>
                </tr>";
   }
   $output .= '</tbody>';
   $output .= '</table>';
   echo $output;
 } else {
   echo "<script>$('#product_list_title').css('display','none');</script>";
   $output .= "<h4 class='text-warning text-center'>VENDOR NOT FOUND, PLEASE INSERT ATLEAST ONE DATA, USE FORM</h4>";
   echo $output;
 }

?>