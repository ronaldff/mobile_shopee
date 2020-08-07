<?php include_once("admin_constant.php"); ?>
<?php include_once("header_admin.php"); ?>
<?php include_once("menu_admin.php"); ?>
<!-- start page content -->

<div class="page-content-wrapper">
  <div class="page-content">
    <div class="page-bar">
      <div class="page-title-breadcrumb">
        <div class=" pull-left">
          <div class="page-title">Categories</div>
        </div>
        <ol class="breadcrumb page-breadcrumb pull-right">
          <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item" href="<?php echo ROUTE_AJAX_URL;?>dashboard.php">Home</a>&nbsp;<i class="fa fa-angle-right"></i>
          </li>
          <li>&nbsp;<a class="parent-item" href="<?php echo ROUTE_AJAX_URL;?>categories.php">Categories</a>&nbsp;<i class="fa fa-angle-right"></i>
          </li>
          <li class="active">List Categories</li>
        </ol>
      </div>
    </div>
  
    <div class="row">
      <div class="col-md-12 col-sm-12">
        <div class="card  card-box">
          <div class="card-head">
            <header>Categories</header>
            <div class="tools">
              <a class="fa fa-repeat btn-color box-refresh" href="javascript:;"></a>
              <a class="t-collapse btn-color fa fa-chevron-down" href="javascript:;"></a>
            </div>
          </div>
          <div class="card-body ">
            <div class="table-wrap">
            <div class="alert alert-danger text-center text-capitalize error" style="display:none;"></div>
            <div class="alert alert-success text-center text-capitalize success" style="display:none;"></div>
              <form id="category_form_fields">
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="name">Category Name:</label>
                      <input type="text" class="form-control" id="categories_name" name="categories_name">
                    </div>
                    <div class="form-group">
                      <input type="submit" value="submit" name="category_form" class="label label-rouded  label-danger btn" style="cursor:pointer;">
                    </div>
                  </div>
                </div>
              </form>
            </div>
            <hr>
            <!-- model code -->
            <div id="model">
              <div id="model-form">
                <h4 class="text-center text-primary">Edit Category</h4>
                <table cellpadding="0" width="100%" class="table text-center"></table>
                <div id="close-btn">x</div>
              </div>
            </div>
            <div>
              <div class=" pull-left">
                <div class="page-title" id="category_list_title">Categories List</div>
              </div>
              <div>
                <div class="error-message alert alert-danger text-center text-capitalize"></div>
                <div class="success-message alert alert-success text-center text-capitalize"></div>
              </div>
             
              <div id="category_list"></div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  
<!-- end page container -->
<?php include_once("footer_admin.php"); ?>
<script>
  $(document).ready(()=>{
    // fetching categories
    function loadCategories(page){
      $("#category_list").html('');

      $.ajax({
        url : '<?php echo ROUTE_AJAX_URL; ?>fetchCategories.php',
        type : 'POST',
        data : {page_no : page},
        success : function(data){
            $("#category_list").html(data);
        }
      })
    }
    loadCategories();

    // pagination code
    $(document).on('click',"#pagination_category a",function(e){
      e.preventDefault();
      // console.log(10);
      let page_id = $(this).attr("id");
      loadCategories(page_id);
    })
      

    // inserting categories
    $("#category_form_fields").submit(e => {
      e.preventDefault();
      let categories_name = $("#categories_name").val();
      let submit_name = $("input[name='category_form']").attr("name");
      if(categories_name === ''){
        displayMessage('please insert category',false);
      } else {
        if(submit_name === "category_form"){
          $.ajax({
            url : '<?php echo ROUTE_AJAX_URL; ?>insertCategories.php',
            type : "POST",
            data : {categories_name : categories_name, submit_name : submit_name},
            success : data => {
              if(data === "category_exist"){
                displayMessage("category name already exist in the database",false);
                $("#category_form_fields")[0].reset();
              } else {
                if(data === "category_insert"){
                  displayMessage("new category name added successfully",true);
                  $("#category_form_fields")[0].reset();
                  loadCategories();

                }
              }
            }
          })
        }
      }
      
    })

    // category status code
    $(document).on('click',".status_change_category",function(e){
      e.preventDefault();
      let status_code = $(this).data('status');
      let status_id = $(this).data('id');

      if(status_code != "" || status_id != ""){
        $.ajax({
          url : '<?php echo ROUTE_AJAX_URL; ?>changeStatusCategories.php',
          type : 'POST',
          data : {status_code : status_code,status_id:status_id},
          success : function(data){
              if(data === '1'){
                displayMessageAction("category status changed successfully",true);
                loadCategories();
              } else {
                displayMessageAction("category status not changed successfully",false);
                loadCategories();
              }
          }
        });
      }

    })

    // delete category code
    $(document).on('click', '#category_delete', function(e){
      e.preventDefault();
      let delete_id = $(this).data("id");
      if(delete_id != ""){
        if(confirm("Are You Want To Delete?")){
          $.ajax({
            url : '<?php echo ROUTE_AJAX_URL; ?>deleteCategories.php',
            type : 'POST',
            data : {delete_id : delete_id},
            success : function(data){
                if(data === '1'){
                  displayMessageAction("category deleted successfully",true);
                  loadCategories();
                } else {
                  displayMessageAction("category not deleted successfully",false);
                  loadCategories();
                }
            }
          });
        }
      }
    }) 

    // Show Model Box and load category
    $(document).on('click', '#category_edit', function(e){
      e.preventDefault();
      $("#model").show();
      let edit_id = $(this).data("id");
      if(edit_id != ""){
        $.ajax({
          url : '<?php echo ROUTE_AJAX_URL; ?>load_category_for_update.php',
          type : 'POST',
          data : {edit_id : edit_id},
          success : function(data){
            $("#model-form table").html(data);
             
          }
        });
      }
    })


    // update category
    $(document).on("click", "#update_category", e => {
      e.preventDefault();
      let category_name = $("#category_name").val();
      let category_id = $("#category_id").val();
      $.ajax({
        url : '<?php echo ROUTE_AJAX_URL; ?>updateCategory.php',
        type : 'POST',
        data : {category_name : category_name, category_id : category_id},
        success : function(data){
          console.log(data);
          if(data === '1'){
            $("#model").hide();
            displayMessageAction("category updated successfully",true);
            loadCategories();
          } else {
            $("#model").hide();
            displayMessageAction("category already exist",false);
            loadCategories();
          }
            
        }
      })

    }) 

    // hide model box
    $("#close-btn").on("click",function(){
      $("#model").hide();
      
    })


    // error and success message
    function displayMessage(msg,status){
      if(status === false){
        $(".error").show();
        $(".error").text(msg);
        timeoutMessage(); 
      }

      if(status === true){
        $(".success").show();
        $(".success").text(msg);
        timeoutMessage();
      }
    }

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

    // hide error after some time
    function timeoutMessage(){
      setTimeout(() => {
        $(".error").hide();
        $(".success").hide();

      }, 3000);
    }

    
  })
</script>