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
          <div class="page-title">Contact Us</div>
        </div>
        <ol class="breadcrumb page-breadcrumb pull-right">
          <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item" href="<?php echo ROUTE_AJAX_URL;?>dashboard.php">Home</a>&nbsp;<i class="fa fa-angle-right"></i>
          </li>
          <li>&nbsp;<a class="parent-item" href="<?php echo ROUTE_AJAX_URL;?>contact_us.php">Contact-Us</a>&nbsp;<i class="fa fa-angle-right"></i>
          </li>
          <li class="active">Contact List</li>
        </ol>
      </div>
    </div>
    <!-- Edit Booking Form -->
    <div class="row">
      <div class="col-md-12 col-sm-12">
        <div class="card  card-box">
          <div class="card-head">
            <header>Contact</header>
          </div>
          <div class="card-body ">
            <div>
              <div class=" pull-left">
                <div class="page-title" id="contact_list_title">Contact List</div>
              </div>
              <div>
                <div class="error-message alert alert-danger text-center text-capitalize"></div>
                <div class="success-message alert alert-success text-center text-capitalize"></div>
              </div>
              <div id="contact_list"></div>
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
    function loadContact(page_id){
      $("#contact_list").html('');
      $.ajax({
        url : '<?php echo ROUTE_AJAX_URL; ?>fetchContacts_us.php',
        type : 'POST',
        data:{page_no : page_id},
        success : function(data){
          // console.log(data);
            $("#contact_list").html(data);
        }
      })
    }
    loadContact();

    // pagination code contact
    $(document).on('click',"#pagination_contact a",function(e){
      e.preventDefault();
      let page_id = $(this).attr("id");
      loadContact(page_id);
    })

    // delete contact code
    $(document).on('click', '#contact_delete', function(e){
      e.preventDefault();
      let delete_id = $(this).data("id");
      if(delete_id != ""){
        if(confirm("Are You Want To Delete?")){
          $.ajax({
            url : '<?php echo ROUTE_AJAX_URL; ?>deleteContact_us.php',
            type : 'POST',
            data : {delete_id : delete_id},
            success : function(data){
              if(data === '1'){
                displayMessageAction("contact deleted successfully",true);
                loadContact();
              } else {
                displayMessageAction("contact not deleted successfully",false);
                loadContact();
              }
            }
          });
        }
      }
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

    // hide error after some time
    function timeoutMessageAction(){
      setTimeout(() => {
        $(".error-message").hide();
        $(".success-message").hide();

      }, 3000);
    }


  })
</script>
