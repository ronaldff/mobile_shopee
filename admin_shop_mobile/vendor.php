<?php include_once("admin_constant.php"); ?>
<?php include_once("header_admin.php"); ?>
<?php include_once("menu_admin.php"); ?>
<?php require_once("../functions.inc.php"); ?>
<?php isAdmin() ?>
<!-- start page content -->

<div class="page-content-wrapper">
  <div class="page-content">
    <div class="page-bar">
      <div class="page-title-breadcrumb">
        <div class=" pull-left">
          <div class="page-title">Vendor</div>
        </div>
        <ol class="breadcrumb page-breadcrumb pull-right">
          <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item" href="<?php echo ROUTE_AJAX_URL;?>dashboard.php">Home</a>&nbsp;<i class="fa fa-angle-right"></i>
          </li>
          <li>&nbsp;<a class="parent-item" href="<?php echo ROUTE_AJAX_URL;?>vendor.php">Vendor</a>&nbsp;<i class="fa fa-angle-right"></i>
          </li>
          <li class="active">Vendor List</li>
        </ol>
      </div>
    </div>
    <!-- Add Product Form -->
    <div class="row">
      <div class="col-md-12 col-sm-12">
        <div class="card  card-box">
          <div class="card-head">
            <header>Vendors</header>
            <div class="tools">
              <button type="button" class="btn btn-primary text-uppercase p-2" data-toggle="modal" data-target="#exampleModalLong" id="add_product_btn">add vendor</button>
            </div>
          </div>
          <div class="card-body ">
            <div class="table-wrap">
              <div class="alert alert-danger text-center text-capitalize error" style="display:none;"></div>
              <div class="alert alert-success text-center text-capitalize success" style="display:none;"></div>

            </div>
            <hr>
            <div>
              <div class=" pull-left">
                <div class="page-title" id="product_list_title">Vendors List</div>
              </div>
              <div>
                <div class="error-message alert alert-danger text-center text-capitalize"></div>
                <div class="success-message alert alert-success text-center text-capitalize"></div>
              </div>
             
              <div id="vendor_list"></div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- model -->
  <!-- Button trigger modal -->

<!-- model edit product code -->
<div id="model_edit">
  <div id="model-edit-form">
    <h4 class="text-center text-primary">Edit Vendor</h4>
    <div id="vendor_edit_form"></div>
    <div id="close-btn">x</div>
  </div>
</div>
<!-- Modal -->
<div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content" style="width: 770px;">
      <div class="modal-header text-center">
        <h4 class="modal-title " id="exampleModalLongTitle">ADD Vendor</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="close_model">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="vendor_form">
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label for="name">Vendor Name:</label>
                <input type="text" class="form-control" id="vendor_name" name="vendor_name" required>
              </div>
              <div class="form-group">
                <label for="mrp">Vendor Password:</label>
                <input type="password" class="form-control" id="vendor_password" name="vendor_password" required>
              </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    <label for="email">Vendor Email:</label>
                    <input type="email" class="form-control" id="vendor_email" name="vendor_email" required>
                </div>
                <div class="form-group">
                    <label for="mobile">Vendor Mobile Number:</label>
                    <input type="number"  class="form-control" name="vendor_mobile" id="vendor_mobile" required>
                </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-5"></div>
            <div class="col-md-4">
              <input type="submit" value="Add Vendor" name="add_vendor_form" class="btn btn-primary">
            </div>
            <div class="col-md-3"></div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
  
<!-- end page container -->
<?php include_once("footer_admin.php"); ?>
<script>
  $(document).ready(()=>{
    // fetching vendors
    function loadVendors(){
      $("#vendor_list").html('');
      $.ajax({
        url : '<?php echo ROUTE_AJAX_URL; ?>fetchVendor.php',
        type : 'POST',
        async:true,
        success : function(data){
            $("#vendor_list").html(data);
        }
      })
    }
    loadVendors();

    // vendor status code
    $(document).on('click',".status_change_vendor",function(e){
      e.preventDefault();
      let status_code = $(this).data('status');
      let status_id = $(this).data('id');

      if(status_code != "" || status_id != ""){
        $.ajax({
          url : '<?php echo ROUTE_AJAX_URL; ?>changeStatusVendor.php',
          type : 'POST',
          async:true,
          data : {status_code : status_code,status_id:status_id},
          success : function(data){
              if(data === '1'){
                displayMessageAction("vendor status changed successfully",true);
                loadVendors();
              } else {
                displayMessageAction("vendor status not changed successfully",false);
                loadVendors();
              }
          }
        });
      }

    })

    // Show Model Box and load category for edit
    $(document).on('click', '#vendor_edit', function(e){
      e.preventDefault();
      $("#model_edit").show();
      let edit_id = $(this).data("id");
      if(edit_id != ""){
        $.ajax({
          url : '<?php echo ROUTE_AJAX_URL; ?>load_vendor_for_update.php',
          type : 'POST',
          async:true,
          data : {edit_id : edit_id},
          success : function(data){
            $("#model-edit-form #vendor_edit_form").html(data);
             
          }
        });
      }
    })


    // hide model box
    $("#close-btn").on("click",function(){
      $("#model_edit").hide();
      
    })

    // delete vendor code
    $(document).on('click', '#vendor_delete', function(e){
      e.preventDefault();
      let delete_id = $(this).data("id");
      if(delete_id != ""){
        if(confirm("Are You Want To Delete This Vendor?")){
          $.ajax({
            url : '<?php echo ROUTE_AJAX_URL; ?>deletevendor.php',
            type : 'POST',
            async:true,
            data : {delete_id : delete_id},
            success : function(data){
             
                if(data === '1'){
                  displayMessageAction("vendor data deleted successfully",true);
                  loadVendors();
                } else {
                  displayMessageAction("vendor not deleted successfully",false);
                  loadVendors();
                }
            }
          });
        }
      }
    })

    // add vendor
    $(document).on('submit','#vendor_form',function(e){
      e.preventDefault();
      let data = $(this).serialize();
      $.ajax({
        url : "<?php echo ROUTE_AJAX_URL; ?>addVendor.php",
        type:"POST",
        async:true,
        data : data,
        success: data => {
          if(data === "1"){
            displayMessageAction("vendor name already exist in the database",false);
            $("#vendor_form")[0].reset();
            $('#close_model').trigger('click');
          } else if(data === "2"){
            alert("new vendor added successfully");
            $("#vendor_form")[0].reset();
            $('#close_model').trigger('click');
            location.reload(true);
          } else if(data === "3"){
            alert("vendor not created");
            $("#vendor_form")[0].reset();
            $('#close_model').trigger('click');
            location.reload(true);
          }
        }
      })
    })

    // update vendor
    $(document).on('submit','#update_vendor_form',function(e){
      e.preventDefault();
      let data = $(this).serialize();
      $.ajax({
        url : "<?php echo ROUTE_AJAX_URL; ?>updateVendor.php",
        type:"POST",
        async:true,
        data : data,
        success: data => {
          if(data === "0"){
            displayMessageAction("vendor name already exist in the database",false);
            $('#close-btn').trigger('click');
          } else if(data === '1'){
            displayMessageAction("vendor updated successfully",true);
            $('#close-btn').trigger('click');
            loadVendors();
          }
        }
      })
    })

    // error and success message Action
    function displayMessageAction(msg,status){
      if(status === false){
        $(".error-message").show();
        $(".error-message").text(msg);
        timeoutMessageAction(); 
      }

      if(status === true){
        $(".success-message").show();
        $(".success-message").text(msg);
        timeoutMessageAction();
      }
    }

    // hide error after some time action
    function timeoutMessageAction(){
      setTimeout(() => {
        $(".error-message").hide();
        $(".success-message").hide();

      }, 3000);
    }
    
  })
</script>