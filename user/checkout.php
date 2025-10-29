<?php
include('../include/connect.php');
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout Page</title>
    <!-- Bootstrap css -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <!-- Font Link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- css file link -->
    <link rel="stylesheet" href="style.css">
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
          <a class="nav-link active" aria-current="page" href="../index.php">Home</a>
        </li>
        <li class="nav-item"> 
          <a class="nav-link" href="display_all.php">Products</a>
        </li>
        <?php
          if (isset($_SESSION['username'])) {
            echo "
            <li class='nav-item'> 
              <a class='nav-link' href='profile.php'>My Account</a>
            </li>";
          }else{
            echo "
            <li class='nav-item'> 
              <a class='nav-link' href='user_registration.php'>Register</a>
            </li>";
          }
        ?>
        <li class="nav-item"> 
          <a class="nav-link" href="#">Contacts</a>
        </li>
      </ul>
      <ul class="navbar-nav mb-2 mb-lg-0 fs-3 p-2">
      </ul> 
      <form class="d-flex" action="search_product.php" method="get">
        <input class="form-control me-2" type="search" placeholder="Search.." aria-label="Search" name="search_data">
        <input type="submit" value="Search" class="btn btn-outline-light" name="search_data_product">
      </form>
    </div>
  </div>
</nav>

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
               <a class='nav-link' aria-current='page' href='#'>Welcome ".$_SESSION['username']."</a>
               </li>";
             }

            if(!isset($_SESSION['username'])){
           echo "   <li class='nav-item'>
          <a class='nav-link' aria-current='page' href='user_login.php'>Login</a>
        </li>";
            }else{
              echo "   <li class='nav-item'>
              <a class='nav-link' aria-current='page' href='logout.php'>Logout</a>
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
      <div class="col-md-12 px-2">
        <!-- Products -->
        <div class="row">
            <?php
            if(!isset($_SESSION['username'])){
                include('user_login.php');
            }else{
                include('payment.php');
            }
            ?>
          </div>
        </div>
        <!-- row end -->
      </div>
      <!-- col end -->

    <!-- Last Child/Footer -->
    <?php
    include('../include/footer.php')
    ?>
    </div>




    <!-- Bootstrap Js -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>