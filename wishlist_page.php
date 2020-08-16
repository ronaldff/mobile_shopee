
<?php require_once("header.php"); ?>
<?php 
  if(!isset($_SESSION['USER_LOGIN'])){ ?>
    <script>
      window.location.href = 'index.php';
    </script>
<?php  } ?>
<!-- start #main-site -->
<main id="main-site">
 <!-- wishlist-area start -->
 <div class="wishlist-area ptb--100 bg__white">
    <div class="container font-rale">
      <h5 class="font-rale font-size-24 mb-4">Wishlist</h5>
      <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
          <div class="wishlist-content">
            <div class="wishlist-table table-responsive">
              <table>
                <thead>
                  <tr>
                    <th class="product-remove "><span class="font-rale">Remove</span></th>
                    <th class="product-thumbnail"><span class="font-rale">Image</span></th>
                    <th class="product-name"><span class="font-rale">Product Name</span></th>
                    <th class="product-price"><span class="font-rale">Product Price </span></th>
                    <th class="product-add-to-cart"><span class="font-rale">Add To Cart</span></th>
                  </tr>
                </thead>
                <tbody id="wishlistData"></tbody>
              </table>
            </div>  
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- wishlist-area end -->
</main>
<?php require_once("footer.php"); ?>