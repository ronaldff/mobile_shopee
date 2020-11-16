        <!-- start footer -->
        <div class="page-footer">
            <div class="page-footer-inner"> <?php echo CURRENT_YEAR;?> &copy; <?php echo FOOTER_TEXT_CREATER; ?>
            <a href="javascript:;" target="_top" class="makerCss"><?php echo AUTHOR_NAME; ?></a>
            </div>
            <div class="scroll-to-top">
                <i class="icon-arrow-up"></i>
            </div>
        </div>
        <!-- end footer -->
    </div>
    <!-- start js include path -->
    <script src="<?php defined("ADMIN_LOGIN_LINK_URL") ?  print_r(ADMIN_LOGIN_LINK_URL) : ""; ?>plugins/jquery/jquery.min.js" ></script>
    <script src="<?php defined("ADMIN_LOGIN_LINK_URL") ?  print_r(ADMIN_LOGIN_LINK_URL) : ""; ?>plugins/popper/popper.min.js" ></script>
    <script src="<?php defined("ADMIN_LOGIN_LINK_URL") ?  print_r(ADMIN_LOGIN_LINK_URL) : ""; ?>plugins/jquery-blockui/jquery.blockui.min.js" ></script>
	<script src="<?php defined("ADMIN_LOGIN_LINK_URL") ?  print_r(ADMIN_LOGIN_LINK_URL) : ""; ?>plugins/jquery-slimscroll/jquery.slimscroll.min.js"></script>
    <!-- bootstrap -->
    <script src="<?php defined("ADMIN_LOGIN_LINK_URL") ?  print_r(ADMIN_LOGIN_LINK_URL) : ""; ?>plugins/bootstrap/js/bootstrap.min.js" ></script>
    <script src="<?php defined("ADMIN_LOGIN_LINK_URL") ?  print_r(ADMIN_LOGIN_LINK_URL) : ""; ?>plugins/sparkline/jquery.sparkline.min.js" ></script>
	<script src="<?php defined("ADMIN_LOGIN_LINK_URL") ?  print_r(ADMIN_LOGIN_LINK_URL) : ""; ?>js/pages/sparkline/sparkline-data.js" ></script>
    <!-- Common js-->
	<script src="<?php defined("ADMIN_LOGIN_LINK_URL") ?  print_r(ADMIN_LOGIN_LINK_URL) : ""; ?>js/app.js" ></script>
    <script src="<?php defined("ADMIN_LOGIN_LINK_URL") ?  print_r(ADMIN_LOGIN_LINK_URL) : ""; ?>js/layout.js" ></script>
    <script src="<?php defined("ADMIN_LOGIN_LINK_URL") ?  print_r(ADMIN_LOGIN_LINK_URL) : ""; ?>js/theme-color.js" ></script>
    <!-- material -->
    <script src="<?php defined("ADMIN_LOGIN_LINK_URL") ?  print_r(ADMIN_LOGIN_LINK_URL) : ""; ?>plugins/material/material.min.js"></script>
    <!-- animation -->
    <script src="<?php defined("ADMIN_LOGIN_LINK_URL") ?  print_r(ADMIN_LOGIN_LINK_URL) : ""; ?>js/pages/ui/animations.js" ></script>
    <!-- morris chart -->
    <script src="<?php defined("ADMIN_LOGIN_LINK_URL") ?  print_r(ADMIN_LOGIN_LINK_URL) : ""; ?>plugins/morris/morris.min.js" ></script>
    <script src="<?php defined("ADMIN_LOGIN_LINK_URL") ?  print_r(ADMIN_LOGIN_LINK_URL) : ""; ?>plugins/morris/raphael-min.js" ></script>
    <script src="<?php defined("ADMIN_LOGIN_LINK_URL") ?  print_r(ADMIN_LOGIN_LINK_URL) : ""; ?>js/pages/chart/morris/morris_home_data.js" ></script>
    <!-- end js include path -->
    <script>
        $(function(){
            var pgurl = window.location.href;
            jQuery("#remove-scroll ul li a").each(function(){
                if(jQuery(this).attr("href") == pgurl){
                    jQuery(this).closest(".nav-item").addClass("active");
                    jQuery("#remove-scroll ul li a").eq(0).closest(".nav-item").removeClass("active");
                }
            });
        });
    </script>
  </body>
</html>