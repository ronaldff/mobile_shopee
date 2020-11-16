<?php include_once("admin_constant.php"); ?>
<?php include_once("header_admin.php"); ?>
<?php include_once("menu_admin.php"); ?>
<!-- start page content -->

<div class="page-content-wrapper">
  <div class="page-content">
    <div class="page-bar">
      <div class="page-title-breadcrumb">
        <div class=" pull-left">
          <div class="page-title">Products</div>
        </div>
        <ol class="breadcrumb page-breadcrumb pull-right">
          <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item" href="<?php echo ROUTE_AJAX_URL;?>dashboard.php">Home</a>&nbsp;<i class="fa fa-angle-right"></i>
          </li>
          <li>&nbsp;<a class="parent-item" href="<?php echo ROUTE_AJAX_URL;?>products.php">Products</a>&nbsp;<i class="fa fa-angle-right"></i>
          </li>
          <li class="active">List Products</li>
        </ol>
      </div>
    </div>
    <!-- Add Product Form -->
    <div class="row">
      <div class="col-md-12 col-sm-12">
        <div class="card  card-box">
          <div class="card-head">
            <header>Products</header>
            <div class="tools">
              <button type="button" class="btn btn-primary text-uppercase p-2" data-toggle="modal" data-target="#exampleModalLong" id="add_product_btn">add product</button>
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
                <div class="page-title" id="product_list_title">Products List</div>
              </div>
              <div>
                <div class="error-message alert alert-danger text-center text-capitalize"></div>
                <div class="success-message alert alert-success text-center text-capitalize"></div>
              </div>
             
              <div id="product_list"></div>
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
    <h4 class="text-center text-primary">Edit Product</h4>
    <div id="product_edit_form"></div>
    <div id="close-btn">x</div>
  </div>
</div>
<!-- Modal -->
<div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content" style="width: 770px;">
      <div class="modal-header text-center">
        <h4 class="modal-title " id="exampleModalLongTitle">ADD PRODUCT</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="close_model">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="product_form">
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label for="name">Product Name:</label>
                <input type="text" class="form-control" id="product_name" name="product_name" required>
              </div>
              <div class="form-group">
                <label for="mrp">Product MRP:</label>
                <input type="number" class="form-control" id="product_mrp" name="product_mrp" required>
              </div>
              <div class="form-group">
                <label for="price">Sale Price:</label>
                <input type="number" class="form-control" id="product_sale_price" name="product_sale_price" required>
              </div>
              <div class="form-group">
                <label for="">Quantity:</label>
                <input type="number"  class="form-control" name="product_qty" id="product_qty" required>
              </div>
              <div class="form-group">
                <label for="productImg">Upload Photo:</label>
                <div>
                  <input type="file" id="product_image" name="product_image" >
                </div>
              </div>
            </div>

            <div class="col-md-6">
              <div class="form-group">
                <label>Meta Title:</label>
                <textarea class="form-control" rows="2" id="meta_title" name="meta_title"></textarea>
              </div>
              <div class="form-group">
                <label for="categories">Categories:</label>
                <select class="form-control" id="categories_id" name="categories_id" required></select>
              </div>
              <div class="form-group">
                <label>Meta Description:</label>
                <textarea class="form-control" rows="2" id="meta_desc" name="meta_desc"></textarea>
              </div>
              <div class="form-group">
                <label>Meta Keyword:</label>
                <textarea class="form-control" rows="2" id="meta_keyword" name="meta_keyword"></textarea>
              </div>
            </div>
          </div>
          <div class="form-group">
            <label for="best_seller">Best Seller:</label>
            <select class="form-control" id="best_seller" name="best_seller" required>
              <option value="">Select Best Seller</option>
              <option value="1">Yes</option>
              <option value="0">No</option>
            </select>
          </div>
          <div class="form-group">
            <label>Short Description:</label>
            <textarea class="form-control" rows="2" id="short_desc" name="short_desc" required></textarea>
          </div>
          <div class="form-group">
            <label>Long Description:</label>
            <textarea class="form-control" rows="3" id="long_desc" name="long_desc" required></textarea>
          </div>
          <div class="row">
            <div class="col-md-5"></div>
            <div class="col-md-4">
              <input type="submit" value="Add Product" name="add_product_form" class="btn btn-primary">
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
    // fetching products
    function loadProducts(page){
      $("#product_list").html('');

      $.ajax({
        url : '<?php echo ROUTE_AJAX_URL; ?>fetchProducts.php',
        type : 'POST',
        async:true,
        data : {page_no : page},
        success : function(data){
            $("#product_list").html(data);
        }
      })
    }
    loadProducts();

    // pagination code
    $(document).on('click',"#pagination_product a",function(e){
      e.preventDefault();
      let page_id = $(this).attr("id");
      loadProducts(page_id);
    })

    // product status code
    $(document).on('click',".status_change_product",function(e){
      e.preventDefault();
      let status_code = $(this).data('status');
      let status_id = $(this).data('id');

      if(status_code != "" || status_id != ""){
        $.ajax({
          url : '<?php echo ROUTE_AJAX_URL; ?>changeStatusProduct.php',
          type : 'POST',
          async:true,
          data : {status_code : status_code,status_id:status_id},
          success : function(data){
              if(data === '1'){
                displayMessageAction("product status changed successfully",true);
                loadProducts();
              } else {
                displayMessageAction("product status not changed successfully",false);
                loadProducts();
              }
          }
        });
      }

    })

    // Show Model Box and load category for edit
    $(document).on('click', '#product_edit', function(e){
      e.preventDefault();
      $("#model_edit").show();
      let edit_id = $(this).data("id");
      if(edit_id != ""){
        $.ajax({
          url : '<?php echo ROUTE_AJAX_URL; ?>load_product_for_update.php',
          type : 'POST',
          async:true,
          data : {edit_id : edit_id},
          success : function(data){
            $("#model-edit-form #product_edit_form").html(data);
             
          }
        });
      }
    })

    // get categories
    $(document).on("click","#product_edit",e => {
      $.ajax({
        url : "<?php echo ROUTE_AJAX_URL; ?>getAllCategories.php",
        type:"POST",
        success: data => {
          let cat_id = parseInt($("#cat_id").val());
          let categories = JSON.parse(data);
          if(categories.length > 0){
            let attr_selected_data = '';
            let output = '<option>-----Select Category--------</option>';
            categories.forEach(category => {
              if(cat_id === parseInt(category.id)){
                attr_selected_data = 'selected';
              } else {
                attr_selected_data = '';
              }
              output += `<option value="${category.id}" ${attr_selected_data}>${category.categories_name}</option>`;
            });
            $("#categories_id").append(output);

          } else {
            alert("please insert atleast one category");
          }
        }
      })
    })

    // hide model box
    $("#close-btn").on("click",function(){
      $("#model_edit").hide();
      
    })

    // delete product code
    $(document).on('click', '#product_delete', function(e){
      e.preventDefault();
      let delete_id = $(this).data("id");
      if(delete_id != ""){
        if(confirm("Are You Want To Delete This Product?")){
          $.ajax({
            url : '<?php echo ROUTE_AJAX_URL; ?>deleteProduct.php',
            type : 'POST',
            async:true,
            data : {delete_id : delete_id},
            success : function(data){
              // console.log(data);
                if(data === '1'){
                  displayMessageAction("product-image and product data deleted successfully",true);
                  loadProducts();
                } else {
                  displayMessageAction("product not deleted successfully",false);
                  loadProducts();
                }
            }
          });
        }
      }
    })

    // get categories
    $(document).on("click","#add_product_btn",e => {
      $.ajax({
        url : "<?php echo ROUTE_AJAX_URL; ?>getAllCategories.php",
        type:"POST",
        async:true,
        success: data => {
          let categories = JSON.parse(data);
          if(categories.length > 0){
          let output = '<option>-----Select Category--------</option>';
            categories.forEach(category => {
              output += `<option value="${category.id}">${category.categories_name}</option>`;
            });
            $("#categories_id").append(output);

          } else {
            alert("please insert atleast one category");
          }
        }
      })
    })

    // add products
    $(document).on('submit','#product_form',function(e){
      e.preventDefault();
      $.ajax({
        url : "<?php echo ROUTE_AJAX_URL; ?>addProducts.php",
        type:"POST",
        async:true,
        data : new FormData(this),
        contentType : false,
        cache:false,
        processData : false,
        success: data => {
          
          if(data === "1"){
            displayMessageAction("product name already exist in the database",false);
            $("#product_form")[0].reset();
            $('#close_model').trigger('click');
          } else if(data === "2"){
            alert("new product added successfully");
            $("#product_form")[0].reset();
            $('#close_model').trigger('click');
            location.reload(true);
          } else if(data === "3"){
            console.log('3');

            alert("Sorry, only jpg, jpeg, png files are allowed");
            $("#product_form")[0].reset();
            $('#close_model').trigger('click');
            location.reload(true);
            
          }
        }
      })
    })

    // update products
    $(document).on('submit','#update_product_form',function(e){
      e.preventDefault();
      $.ajax({
        url : "<?php echo ROUTE_AJAX_URL; ?>updateProduct.php",
        type:"POST",
        async:true,
        data : new FormData(this),
        contentType : false,
        cache:false,
        processData : false,
        success: data => {
          if(data === "0"){
            displayMessageAction("product name already exist in the database",false);
            $('#close-btn').trigger('click');
          } else if(data === "1"){
            displayMessageAction("product updated successfully",true);
            $('#close-btn').trigger('click');
            loadProducts();
          } else if(data === "2"){
            alert("Sorry, only jpg, jpeg, png files are allowed");
            $("#product_form")[0].reset();
            $('#close-btn').trigger('click');
            location.reload(true);
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