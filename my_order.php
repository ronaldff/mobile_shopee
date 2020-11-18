 <?php
  require_once("importantfile.php");
  require_once("header.php");
	if(!isset($_SESSION['USER_LOGIN'])){
		header('Location:index.php');
	}


 ?>
<!-- start #main-site -->
  <main id="main-site">

    <!-- Shopping cart section  -->
    <section id="cart" class="py-3">
      <div class="container">
        <h5 class="font-baloo font-size-20 mb-5">MY ORDER</h5>
        <!--  shopping cart items   -->
          <div class="row">
            <div class="col-sm-12">
              <table class="table table-bordered table-striped text-center font-baloo">
              	<thead class="text-uppercase">
              		<tr>
						<th>Sr.no</th>
						<th>Action</th>
              			<th>order date</th>
              			<th>address</th>
              			<th>payment type</th>
              			<th>payment status</th>
              			<th>order status</th>
              		</tr>
              	</thead>
              	<tbody>
              		<?php
						$result = mysqli_query($conn,"SELECT * FROM `order` WHERE user_id='{$_SESSION['REGISTER_USER_ID']}' ORDER BY `added_on` desc");
										
              			if(mysqli_num_rows($result) > 0) {
	              			while($row = mysqli_fetch_assoc($result)){ 
								$order_status = mysqli_fetch_assoc(mysqli_query($conn,"SELECT status_name FROM order_status_data WHERE id='{$row['order_status']}'"));
							?>
	              		
		              		<tr>
		              			<td>
									<a href="<?php echo SITE_URL; ?>order_details.php?id=<?php echo $row['id'];  ?>"><button type="button" class="btn btn-warning font-size-12"><?php echo $row['id']; ?></button></a>
								</td>
								<td>
									<a href="<?php echo SITE_URL; ?>order_pdf.php?id=<?php echo $row['id'];  ?>"><button type="button" class="btn btn-primary font-size-12">PDF</button></a>
								</td>
		              			<td><?php echo $row['added_on']; ?></td>
		              			<td><strong>Address:</strong> <?php echo $row['user_address']; ?>&nbsp; <strong>City/Sate:</strong> <?php echo $row['user_city']; ?>&nbsp; <strong>Pincode:</strong> <?php echo $row['user_post_code']; ?></td>
		              			<td><?php echo $row['payment_type']; ?></td>
		              			<td><?php echo $row['payment_status']; ?></td>
		              			<td><?php echo $order_status['status_name']; ?></td>
		              		</tr>
              		<?php }} else { ?>
												<script>
													window.location.href = 'index.php';
												</script>
              		<?php } ?>
              	</tbody>
              </table>
            </div>
          </div>
        <!--  !shopping cart items   -->
      </div>
    </section>
    <!-- !Shopping cart section  -->

              

  </main>
<!-- !start #main-site -->
 <?php require_once('footer.php'); ?>