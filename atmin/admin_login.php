<?php
include('../include/connect.php');
include('../functions/common_function.php');
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <!-- Bootstrap css -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <!-- Font Link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body class="bg-secondary">
<div class="container-fluid my-3">
    <h2 class="text-center">Admin Login</h2>
    <div class="row d-flex align-items-center justify-content-center">
        <div class="lg-12 col-xl-6 mt-5">
            <form action="" method="post">
                <!-- admin username -->
                <div class="form-outline mb-4">
                    <label for="admin_name" class="form-label">Username</label>
                    <input type="text" id="admin_name" name="admin_name" class="form-control" placeholder="Enter username.." required="required"/>
                </div>
                <!-- Password field -->
                <div class="form-outline mb-4">
                    <label for="admin_password" class="form-label">Password</label>
                    <input type="password" id="admin_password" name="admin_password" class="form-control" placeholder="Enter Password.." autocomplete="off" required="required"/>
                </div>
                <div class="text-center">
                    <input type="submit" value="Login" class="btn btn-dark px-3 py-2" name="admin_login">
                </div>
                <div class="">
                    <p>Don't have an account? <a href="admin_registration.php" class="text-danger">Register Now</a></p> 
                </div>
            </form>
        </div>
    </div>
</div>
</body>
</html>

<?php
include('../include/connect.php');

if(isset($_POST['admin_login'])){
    $admin_username = mysqli_real_escape_string($con, $_POST['admin_name']);
    $admin_pw = mysqli_real_escape_string($con, $_POST['admin_password']);

    // Adjust the query to match your table column names
    $select_query = "SELECT * FROM admin_table WHERE admin_name='$admin_username' AND admin_password='$admin_pw'";
    $result = mysqli_query($con, $select_query);
    $admin_ip = getIPAddress();

    if($result && mysqli_num_rows($result) > 0){
        $_SESSION['admin_name'] = $admin_username;
        echo "<script>alert('Logged in successfully')</script>";
        echo "<script>window.open('indexatmin.php', '_self')</script>";
    } else {
        echo "<script>alert('Invalid Credentials')</script>";
    }
}
?>
