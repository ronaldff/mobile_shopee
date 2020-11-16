<?php include_once("admin_constant.php"); ?>
<?php include_once("header_admin.php"); ?>
<?php include_once("menu_admin.php"); ?>

  <!-- start page content -->
  <div class="page-content-wrapper">
    <div class="page-content">
      <div class="page-bar">
          <div class="page-title-breadcrumb">
              <div class=" pull-left">
                  <div class="page-title">Dashboard </div>
              </div>
              <ol class="breadcrumb page-breadcrumb pull-right">
                  <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item" href="dashboard.php">Home</a>&nbsp;<i class="fa fa-angle-right"></i>
                  </li>
                  <li class="active">Dashboard</li>
              </ol>
          </div>
      </div>
      <!-- start widget -->
      <div class="state-overview">
        <div class="row">
              <div class="col-xl-3 col-md-6 col-12">
                <div class="info-box bg-blue">
                  <span class="info-box-icon push-bottom"><i class="material-icons">style</i></span>
                  <div class="info-box-content">
                    <span class="info-box-text">Orders</span>
                    <span class="info-box-number">450</span>
                    <div class="progress">
                      <div class="progress-bar width-60"></div>
                    </div>
                    <span class="progress-description">
                          60% Increase in 28 Days
                        </span>
                  </div>
                  <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
              </div>
              <!-- /.col -->
              <div class="col-xl-3 col-md-6 col-12">
                <div class="info-box bg-orange">
                  <span class="info-box-icon push-bottom"><i class="material-icons">card_travel</i></span>
                  <div class="info-box-content">
                    <span class="info-box-text">New Booking</span>
                    <span class="info-box-number">155</span>
                    <div class="progress">
                      <div class="progress-bar width-40"></div>
                    </div>
                    <span class="progress-description">
                          40% Increase in 28 Days
                        </span>
                  </div>
                  <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
              </div>
              <!-- /.col -->
              <div class="col-xl-3 col-md-6 col-12">
                <div class="info-box bg-purple">
                  <span class="info-box-icon push-bottom"><i class="material-icons">phone_in_talk</i></span>
                  <div class="info-box-content">
                    <span class="info-box-text">Inquiry</span>
                    <span class="info-box-number">52</span>
                    <div class="progress">
                      <div class="progress-bar width-80"></div>
                    </div>
                    <span class="progress-description">
                          80% Increase in 28 Days
                        </span>
                  </div>
                  <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
              </div>
              <!-- /.col -->
              <div class="col-xl-3 col-md-6 col-12">
                <div class="info-box bg-success">
                  <span class="info-box-icon push-bottom"><i class="material-icons">monetization_on</i></span>
                  <div class="info-box-content">
                    <span class="info-box-text">Total Earning</span>
                    <span class="info-box-number">13,921</span><span>$</span>
                    <div class="progress">
                      <div class="progress-bar width-60"></div>
                    </div>
                    <span class="progress-description">
                          60% Increase in 28 Days
                        </span>
                  </div>
                  <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
              </div>
              <!-- /.col -->
            </div>
        </div>
      <!-- end widget -->
    </div>
  </div>
</div>
<!-- end page container -->
<?php include_once("footer_admin.php"); ?>
