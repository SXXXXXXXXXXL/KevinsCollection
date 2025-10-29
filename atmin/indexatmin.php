<!-- connect file -->
<?php
include('../include/connect.php');
include('../functions/common_function.php');
session_start();
?>

<style>
.prod_img{
    width: 30%;
    object-fit: contain;
}
</style>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>

    <!-- Bootstrap css -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <!-- css link -->
    <link rel="stylesheet" href="../style.css">
    <!-- Font Link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
    <!--   navbar   -->
    <div class="container-fluid p-0">
        <!-- first child -->
        <nav class="navbar navbar-expand-lg navbar-light bg-dark">
            <div class="container-fluid">
                <nav class="navbar navbar-expand-lg">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                        <?php
                            if(!isset($_SESSION['admin_name'])){
                                echo "   <li class='nav-item'>
                                <a class='nav-link text-light' aria-current='page' href='#'>Welcome Guest</a>
                                </li>'";
                                }else{
                                echo "   <li class='nav-item'>
                                <a class='nav-link text-light' aria-current='page' href=''>Welcome ".$_SESSION['admin_name']."</a>
                                </li>";
                                }

                                if(!isset($_SESSION['admin_name'])){
                                    echo "<li class='nav-item'>
                                   <a class='nav-link text-light' aria-current='page' href='admin_login.php'>Login</a>
                                 </li>";
                                     }else{
                                       echo "<li class='nav-item'>
                                       <a class='nav-link text-light' aria-current='page' href='logout_admin.php'>Logout</a>
                                     </li>";
                                     }
                                   ?>
                        </li>
                    </ul>
                </nav>
            </div>
        </nav>
        <!-- second child -->
        <div class="bg-light">
            <h3 class="text-center p-2">Manage Details</h3>
        </div>

        <!-- third child -->
        <div class="container">
        <div class="row">
            <div class="col-md-12 bg-secondary p-1 d-flex align-items-center">
                <div>
                </div>
                <div class="button text-center mx-1 p-3">
                    <button><a href="indexatmin.php?insert_products" class="nav-link text-dark bg-secondary my-1 mx-1 p-2">Insert Products</a></button>
                    <button><a href="indexatmin.php?view_products" class="nav-link text-dark bg-secondary my-1 mx-1 p-2">View Products</a></button>
                    <button><a href="indexatmin.php?insert_category" class="nav-link text-dark bg-secondary my-1 mx-1 p-2">Insert Category</a></button>
                    <button><a href="indexatmin.php?view_category" class="nav-link text-dark bg-secondary my-1 mx-1 p-2">View Category</a></button>
                    <button><a href="indexatmin.php?insert_brand" class="nav-link text-dark bg-secondary my-1 mx-1 p-2">Insert Brands</a></button>
                    <button><a href="indexatmin.php?view_brand" class="nav-link text-dark bg-secondary my-1 mx-1 p-2">View Brands</a></button>
                    <button><a href="indexatmin.php?list_orders" class="nav-link text-dark bg-secondary my-1 mx-1 p-2">All Orders</a></button>
                    <button><a href="indexatmin.php?list_payments" class="nav-link text-dark bg-secondary my-1 mx-1 p-2">All Payments</a></button>
                    <button><a href="indexatmin.php?list_users" class="nav-link text-dark bg-secondary my-1 mx-1 p-2">List Users</a></button>
                    <button><a href="logout_admin.php" class="nav-link text-dark bg-secondary my-1 mx-1 p-2">Logout</a></button>
                </div>
            </div>
        </div>
        </div>
        <!-- fourth child -->
        <div class="container my-3">
            <?php
            if(isset($_GET['insert_products'])){
                include ('insert_products.php');
            }
            if(isset($_GET['insert_category'])){
                include ('insert_cat.php');
            }
            if(isset($_GET['insert_brand'])){
                include ('insert_brands.php');
            }
            if(isset($_GET['view_products'])){
                include ('view_products.php');
            }
            if(isset($_GET['edit_products'])){
                include ('edit_products.php');
            }
            if(isset($_GET['delete_products'])){
                include ('delete_products.php');
            }
            if(isset($_GET['view_category'])){
                include ('view_category.php');
            }
            if(isset($_GET['view_brand'])){
                include ('view_brand.php');
            }
            if(isset($_GET['edit_category'])){
                include ('edit_category.php');
            }
            if(isset($_GET['delete_category'])){
                include ('delete_category.php');
            }
            if(isset($_GET['edit_brand'])){
                include ('edit_brand.php');
            }
            if(isset($_GET['delete_brand'])){
                include ('delete_brand.php');
            }
            if(isset($_GET['list_orders'])){
                include ('list_orders.php');
            }
            if(isset($_GET['delete_order'])){
                include ('delete_order.php');
            }
            if(isset($_GET['list_payments'])){
                include ('list_payments.php');
            }
            if(isset($_GET['list_users'])){
                include ('list_users.php');
            }
            if(isset($_GET['delete_user'])){
                include ('delete_user.php');
            }
            if(isset($_GET['delete_payment'])){
                include ('delete_payment.php');
            }
            ?>
        </div>
    </div>

     <!-- Last Child/Footer -->
     <?php
    include('../include/footer.php')
    ?>


    <!-- Bootstrap js -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>