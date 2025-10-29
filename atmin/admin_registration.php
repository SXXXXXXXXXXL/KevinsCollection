<?php
include('../include/connect.php');
include('../functions/common_function.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Registration</title>
    <!-- Bootstrap css -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <!-- Font Link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body class="bg-secondary">
<div class="container-fluid my-3">
    <h2 class="text-center">Admin Registration</h2>
    <div class="row d-flex align-items-center justify-content-center">
        <div class="lg-12 col-xl-6">
            <form action="" method="post" enctype="multipart/form-data">
                <!-- Admin username -->
                <div class="form-outline mb-4">
                    <label for="admin_name" class="form-label">Username</label>
                    <input type="text" id="admin_name" name="admin_name" class="form-control" placeholder="Enter username.." required="required"/>
                </div>
                <!-- Email field -->
                <div class="form-outline mb-4">
                    <label for="admin_email" class="form-label">E-mail</label>
                    <input type="email" id="admin_email" name="admin_email" class="form-control" placeholder="Enter E-mail.." required="required"/>
                </div>
                <!-- Password field -->
                <div class="form-outline mb-4">
                    <label for="admin_pw" class="form-label">Password</label>
                    <input type="password" id="admin_pw" name="admin_pw" class="form-control" placeholder="Enter password.." autocomplete="off" required="required"/>
                </div>
                <!-- Confirm Password field -->
                <div class="form-outline mb-4">
                    <label for="admin_con_pw" class="form-label">Confirm Password</label>
                    <input type="password" id="admin_con_pw" name="admin_con_pw" class="form-control" placeholder="Confirm password.." autocomplete="off" required="required"/>
                </div>
                <div class="text-center">
                    <input type="submit" value="Register" class="btn btn-dark text-light px-3 py-2 border-0" name="admin_register">
                </div>
                <div class="">
                    <p>Already have an account? <a href="admin_login.php" class="text-danger">Login Here</a></p> 
                </div>
            </form>
        </div>
    </div>
</div>
</body>
</html>

<?php
if(isset($_POST['admin_register'])){
    $admin_name = $_POST['admin_name'];
    $admin_email = $_POST['admin_email'];
    $admin_pw = $_POST['admin_pw'];
    $admin_con_pw = $_POST['admin_con_pw'];
    $admin_ip = getIPAddress();

    // Check for duplicate username or email
    $select_query = "SELECT * FROM admin_table WHERE admin_name='$admin_name' OR admin_email='$admin_email'";
    $result = mysqli_query($con, $select_query);
    $num_rows = mysqli_num_rows($result);

    if($num_rows > 0){
        $row = mysqli_fetch_assoc($result);
        if($row['admin_name'] == $admin_name){
            echo "<script>alert('Cannot input data - Username already exists')</script>";
        } elseif($row['admin_email'] == $admin_email){
            echo "<script>alert('Cannot input data - Email already exists')</script>";
        }
        echo "<script>window.open('admin_registration.php', '_self')</script>";
    } else if($admin_pw != $admin_con_pw){
        echo "<script>alert('Passwords do not match')</script>";
    } else {
        // Insert query
        $insert_query = "INSERT INTO admin_table (admin_name, admin_email, admin_password, admin_ip) VALUES ('$admin_name', '$admin_email', '$admin_pw', '$admin_ip')";
        
        // Debugging SQL query
        echo "SQL Query: $insert_query<br>";

        $sql_execute = mysqli_query($con, $insert_query);

        if($sql_execute){
            echo "<script>alert('Data inserted successfully')</script>";
            echo "<script>window.open('admin_login.php', '_self')</script>";
        } else {
            
            echo "<script>alert('Failed to insert data')</script>";
            echo "<script>window.open('admin_registration','_self')</script>";
        }
    }
}
?>
