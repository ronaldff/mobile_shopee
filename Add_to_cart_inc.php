<?php
  class Add_to_cart_inc{

    public function add_to_cart($pid,$qty){
      $_SESSION['cart'][$pid]['qty'] = $qty;
      ?>
      <script>
        alert('Product added in the cart');
      </script>
      <?php
    }


    public function updateProduct($pid,$qty){
      if(isset($_SESSION['cart'][$pid])){
        $_SESSION['cart'][$pid]['qty'] = $qty;
      }
    }


    public function removeProduct($pid){
      if(isset($_SESSION['cart'][$pid])){
        unset($_SESSION['cart'][$pid]);
        ?>
        <script>
          alert("product removed from the cart");
        </script>
        <?php
      }
    }

    public function emptyProduct(){
      unset($_SESSION['cart'][$pid]);
    }

    public function totalProduct(){
      if(isset($_SESSION['cart'])){
        return count($_SESSION['cart']);
      } else {
        return 0;
      }
    }











  }

?>