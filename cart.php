<?php
include('functions/common_function.php');
include('include/connect.php');
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart</title>
    <!-- Bootstrap css -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <!-- Font Link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- css file link -->
    <link rel="stylesheet" href="style.css">
    <style>
      .cart_img{
    width: 100px;
    height: 100px;
}
  </style>
  </head>
<body>
    <!-- Navbar -->
    <div class="container-fluid p-0">
            <!-- first child -->
            <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container-fluid">
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0 fs-5">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="index.php">Home</a>
        </li>
        <li class="nav-item"> 
          <a class="nav-link" href="display_all.php">Products</a>
        </li>
        <?php
          if (isset($_SESSION['username'])) {
            echo "
            <li class='nav-item'> 
              <a class='nav-link' href='user/profile.php'>My Account</a>
            </li>";
          }else{
            echo "
            <li class='nav-item'> 
              <a class='nav-link' href='user/user_registration.php'>Register</a>
            </li>";
          }
        ?>
        <li class="nav-item"> 
          <a class="nav-link" href="#">Contacts</a>
        </li>
      </ul>
      <ul class="navbar-nav mb-2 mb-lg-0 fs-3 p-2">
        <li class="nav-item">
          <a class="nav-link" href="cart.php"><i class="fa-solid fa-cart-shopping"></i> <sup><?php cart_item() ?></sup></a>
        </li>
      </ul> 
    </div>
  </div>
</nav>

    <!-- calling cart function -->
    <?php
    cart();
    ?>

    <!-- Second Child -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-secondary">
      <ul class="navbar-nav me-auto px-2">
          <?php
          if(!isset($_SESSION['username'])){
            echo "   <li class='nav-item'>
            <a class='nav-link' aria-current='page' href='#'>Welcome Guest</a>
            </li>'";
             }else{
               echo "   <li class='nav-item'>
               <a class='nav-link' aria-current='page' href='user/profile.php'>Welcome ".$_SESSION['username']."</a>
               </li>";
             }
             
            if(!isset($_SESSION['username'])){
           echo "   <li class='nav-item'>
          <a class='nav-link' aria-current='page' href='user/user_login.php'>Login</a>
        </li>";
            }else{
              echo "   <li class='nav-item'>
              <a class='nav-link' aria-current='page' href='user/logout.php'>Logout</a>
            </li>";
            }
          ?>
      </ul>    
    </nav>

    <!-- Third Child-->
    <div class="bg-light">
      <h3 class="text-center">Kevin's Collection</h3>
      <p class="text-center">Welcome, have already figured what you are looking for?</p>
    </div>

    <!-- fourth child -->
    <div class="container">
        <div class="row">
          <form action="" method="post">
            <table class="table table-bordered text-center">
                <!-- Fetch cart data from data base -->
                <?php
                  global $con;
                    $get_ip_add = getIPAddress();
                    $total=0;
                    $cart_query = "Select * from cart_details where ip_address='$get_ip_add'";
                    $result_query = mysqli_query($con,$cart_query);
                    $result_count=mysqli_num_rows($result_query);
                    if($result_count> 0){
                      echo"<thead>
                      <tr>
                          <th>Product Title</th>
                          <th>Product Image</th>
                          <th>Total Price</th>
                          <th>Remove</th>
                      </tr>
                  </thead>";
                      
                    
                    while($row=mysqli_fetch_array($result_query)){
                      $product_id= $row['product_id'];
                      $select_products = "Select * from products where product_id='$product_id'";
                      $result_products = mysqli_query($con,$select_products);
                      while($row_product_price=mysqli_fetch_array($result_products)){
                        $product_price=array($row_product_price['product_price']);
                        $price_table=$row_product_price['product_price'];
                        $product_title=$row_product_price['product_title'];
                        $product_image1=$row_product_price['product_image1'];
                        $product_values=array_sum($product_price);
                        $total+=$product_values;
                ?>
                <tbody>
                    <tr>
                        <td><?php echo $product_title?></td>
                        <td><img src="./atmin/product_images/<?php echo $product_image1?>" alt="" class="cart_img"></td>
                        <td>Rp. <?php echo $price_table?></td>
                        <td><input type="checkbox" name="removeitem[]" value="<?php echo $product_id ?>"></td>
                    </tr>
                  <?php
                  }
                }
              }
              else{
                echo "<h2 class='text-center'>... Maybe Add Something Here</h2>";
              }
                ?>
                </tbody>
            </table>
            <!-- subtotal and buttons-->
            <div class="d-flex mb-3">
            <?php
            $get_ip_add = getIPAddress();
            $cart_query = "Select * from cart_details where ip_address='$get_ip_add'";
            $result_query = mysqli_query($con,$cart_query);
            $result_count=mysqli_num_rows($result_query);
            if($result_count> 0){
              echo"<h4 class='px-3' style='border: 5px solid black; padding: 10px;'>Subtotal : <strong>Rp. $total</strong></h4>
              <input type='submit' value='Continue To Shop' class='btn btn-light mx-2 px-2 btn-outline-dark' name='continue_shop'>              
              <input type='submit' value='Checkout' class='btn btn-dark px-5' name='checkout'>              
              <input type='submit' value='Remove' class='ms-auto btn btn-danger px-4' name='remove_cart'>";
            }else{
              echo "<input type='submit' value='Continue To Shop' class='btn btn-dark px-4' name='continue_shop'>";
            }
            if(isset($_POST['continue_shop'])){
              echo "<script>window.open('index.php','_self')</script>";
            }
            if(isset($_POST['checkout'])){
              echo "<script>window.open('./user/payment.php','_self')</script>";
            }
            ?>
            
            </div>
        </div>
    </div>
    </form>
    <!-- function to remove item -->
    <?php
function remove_cart_item() {
    global $con;
    if (isset($_POST['remove_cart'])) {
        if (!empty($_POST['removeitem'])) {
            foreach ($_POST['removeitem'] as $remove_id) {
                echo $remove_id;
                $delete_query = "DELETE FROM cart_details WHERE product_id=$remove_id";
                $run_delete = mysqli_query($con, $delete_query);
                
                if ($run_delete) {
                    echo "<script>window.open('cart.php', '_self')</script>";
                } 
            }
        } 
        }
    }
remove_cart_item();
?>


    <!-- Last Child/Footer -->
    
    </div>
    <?php
    include('./include/footer.php')
    ?>
    

    <!-- Bootstrap Js -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>