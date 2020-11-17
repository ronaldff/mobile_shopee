<!-- start page container -->
<div class="page-container">
  <!-- start sidebar menu -->
  <div class="sidebar-container">
    <div class="sidemenu-container navbar-collapse collapse fixed-menu">
      <div id="remove-scroll">
          <ul class="sidemenu page-header-fixed p-t-20" data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200">
              <li class="sidebar-toggler-wrapper hide">
                <div class="sidebar-toggler">
                  <span></span>
                </div>
              </li>
              <li class="sidebar-user-panel">
                <div class="user-panel">
                  <div class="row">
                    <div class="sidebar-userpic">
                      <?php if($_SESSION['ADMIN_ROLE'] === '1') { ?>
                        <img src="<?php echo ADMIN_LOGIN_LINK_URL; ?>img/dp.jpg" class="img-responsive" alt="vendor"> </div>
                      <?php  } else { ?>
                        <img src="<?php echo ADMIN_LOGIN_LINK_URL; ?>img/piyush.jpg" class="img-responsive" alt="admin"> </div>
                      <?php   }  ?>
                      
                    </div>
                    <div class="profile-usertitle">
                      <?php if($_SESSION['ADMIN_ROLE'] === '1') { ?>
                        <div class="sidebar-userpic-name"> <?php echo $_SESSION['ADMIN_USERNAME']; ?> </div>
                      <?php  } else { ?>
                        <div class="sidebar-userpic-name"> <?php echo AUTHOR_NAME; ?> </div>
                        <div class="profile-usertitle-job"> <?php echo AUTHOR_JOB; ?> </div>
                      <?php   }  ?>
                      
                    </div>
                  </div>
                  
              </li>
              
              <li class="nav-item start active">
                  <a href="dashboard.php" class="nav-link nav-toggle">
                      <i class="material-icons">dashboard</i>
                      <span class="title">Dashboard</span>
                  </a>
              </li>

              <li class="nav-item">
                  <a href="<?php echo ROUTE_AJAX_URL; ?>manage_product.php" class="nav-link nav-toggle">
                      <i class="material-icons">vpn_key</i>
                      <span class="title">Products</span>
                      <span class="arrow"></span>
                  </a>
              </li>

              <?php
                if($_SESSION['ADMIN_ROLE'] === '1'){ ?>
                  <li class="nav-item">
                      <a href="<?php echo ROUTE_AJAX_URL; ?>manage_order_vendor.php" class="nav-link nav-toggle">
                          <i class="material-icons">vpn_key</i>
                          <span class="title">Manage Order</span>
                          <span class="arrow"></span>
                      </a>
                  </li>
              <?php   } else { ?>

                <li class="nav-item">
                      <a href="<?php echo ROUTE_AJAX_URL; ?>manage_order.php" class="nav-link nav-toggle">
                          <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                          <span class="title">Manage Order</span>
                          <span class="arrow"></span>
                      </a>
                  </li>

              <?php } ?>
              
            <?php if($_SESSION['ADMIN_ROLE'] !== '1') { ?>
              <li class="nav-item">
                  <a href="<?php echo ROUTE_AJAX_URL; ?>categories.php" class="nav-link nav-toggle">
                      <i class="material-icons">business_center</i>
                      <span class="title">Categories</span>
                      <span class="arrow"></span>
                  </a>
              </li>

              <li class="nav-item">
                  <a href="<?php echo ROUTE_AJAX_URL; ?>vendor.php" class="nav-link nav-toggle">
                      <i class="fa fa-truck" aria-hidden="true"></i>
                      <span class="title">Vendor Management</span>
                      <span class="arrow"></span>
                  </a>
              </li>
           
              <li class="nav-item">
                  <a href="<?php echo ROUTE_AJAX_URL;?>registered_user.php" class="nav-link nav-toggle">
                      <i class="material-icons">group</i>
                      <span class="title">Users</span>
                      <span class="arrow"></span>
                  </a>
              </li>
              <li class="nav-item">
                  <a href="<?php echo ROUTE_AJAX_URL; ?>contact_us.php" class="nav-link nav-toggle">
                      <i class="material-icons">local_taxi</i>
                      <span class="title">Contact Us</span>
                      <span class="arrow"></span>
                  </a>
              </li>
            <?php } ?>
              
          </ul>
      </div>
    </div>
  </div>
  <!-- end sidebar menu -->

