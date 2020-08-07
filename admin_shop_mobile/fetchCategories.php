<?php
 require_once("../connection.inc.php");
 require_once("admin_constant.php");
 require_once("../functions.inc.php");

 $limit_per_page = 5;
 $page = "";
 if(isset($_POST['page_no'])){
  $page = $_POST['page_no'];
 }else {
  $page = 1;
 }

 $offset = ($page - 1) * $limit_per_page;

$sql = "SELECT * FROM categories LIMIT {$offset},{$limit_per_page}";
 $result = mysqli_query($conn,$sql);
 $output = '';
 $i = 0;
 if(mysqli_num_rows($result) > 0){
   $output .= '<table class="table table-bordered text-center">
                    <thead class="thead-dark">
                      <tr>
                        <th>Category Name</th>
                        <th>Status</th>
                        <th>Created At</th>
                        <th>Action</th>
                      </tr>
                  </thead>
                  <tbody>
              ';
   while ($row = mysqli_fetch_assoc($result)) {
     $output .= "<tr>
                  <td>{$row['categories_name']}</td>";
            $output .=  "<td>";
                  if($row['status'] === '0'){
                    $output .= "<button type='button' class='btn btn-danger status_change_category' data-status={$row['status']} data-id={$row['id']}>deactive</button>";
                  } else {
                    $output .= "<button type='button' class='btn btn-success status_change_category' data-status={$row['status']} data-id={$row['id']}>active</button>";
                  }
                  $output .="</td>";
                  $output .="<td>{$row['created']}</td>
                  <td>
                    <button type='button' class='btn btn-secondary' id='category_edit' data-id={$row['id']}>edit</button>
                    <button type='button' class='btn btn-warning' id='category_delete' data-id={$row['id']}>delete</button>
                  </td>
                </tr>";
   }
   $output .= '</tbody>';
   $output .= '</table>';

   $sql_total = "SELECT * FROM categories";
   $records = mysqli_query($conn,$sql_total);
   $total_record = mysqli_num_rows($records);

   $total_pages = ceil($total_record/$limit_per_page);
   $output .= '<div id="pagination_category">';
   for ($i=1; $i <= $total_pages ; $i++) { 
     if($i == $page){
       $class_Name = 'active bg-success border-primary';
     } else {
      $class_Name = '';
      $styledata = '';
     }
    $output .= "<a class='{$class_Name}' style='width:10px;height:10px;border:1px solid black;padding:5px;margin:2px;cursor:pointer' id='{$i}' href='javascript:;'>{$i}</a>";
   }
   $output .= "</div>";
   echo $output;
 } else {
  echo "<script>$('#category_list_title').css('display','none');</script>";
   $output .= "<h4 class='text-warning text-center'>DATA NOT FOUND, PLEASE INSERT ATLEAST ONE DATA, USE FORM</h4>";
   echo $output;
 }

?>