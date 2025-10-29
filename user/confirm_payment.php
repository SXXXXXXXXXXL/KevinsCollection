<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include('../include/connect.php');
include('../functions/common_function.php');
session_start();

if (isset($_GET['order_id'])) {
    $order_id = $_GET['order_id'];
    
    // Fetch data from user_orders
    $select_data = "SELECT * FROM user_orders WHERE order_id = $order_id";
    $result = mysqli_query($con, $select_data);
    if (!$result) {
        die('Error fetching order data: ' . mysqli_error($con));
    }
    $row = mysqli_fetch_assoc($result);

    $invoice_number = $row['invoice_number'];
    $amount_due = $row['amount_due'];
}

if (isset($_POST['confirm_payment'])) {
    $invoice_number = $_POST['invoice_number'];
    $amount = $_POST['amount'];
    $payment_mode = $_POST['payment_mode'];

    $transaction_details = $_FILES['transaction_details']['name'];
    $transaction_details_tmp = $_FILES['transaction_details']['tmp_name'];

    move_uploaded_file($transaction_details_tmp, "./transaction_details/$transaction_details");

    // Insert payment details into the database
    $insert_query = "INSERT INTO user_payments (order_id, invoice_number, amount, payment_mode, transaction_details) 
                     VALUES ($order_id, '$invoice_number', '$amount', '$payment_mode', '$transaction_details')";
    $result_insert = mysqli_query($con, $insert_query);

    if (!$result_insert) {
        die('Error inserting payment details: ' . mysqli_error($con));
    }

    // Update the order status
    $update_orders = "UPDATE user_orders SET order_status ='Complete' WHERE order_id = $order_id";
    $result_orders = mysqli_query($con, $update_orders);

    if (!$result_orders) {
        die('Error updating order status: ' . mysqli_error($con));
    }

    // Retrieve the product_id from orders_pending
    $select_product_id = "SELECT product_id FROM orders_pending WHERE order_id = $order_id";
    $result_product_id = mysqli_query($con, $select_product_id);

    if (!$result_product_id) {
        die('Error fetching product ID: ' . mysqli_error($con));
    }

    $row_product = mysqli_fetch_assoc($result_product_id);
    if (!$row_product) {
        die('No product found for the given order ID');
    }

    $product_id = $row_product['product_id'];

    // Ensure the product_id is valid
    if (empty($product_id)) {
        die('Product ID is empty');
    }

    // Delete the product from the catalog
    $delete_product = "DELETE FROM products WHERE product_id = $product_id";
    $result_delete = mysqli_query($con, $delete_product);

    if (!$result_delete) {
        die('Error deleting product from catalog: ' . mysqli_error($con));
    }

    // Check if the product was actually deleted
    $check_product = "SELECT * FROM products WHERE product_id = $product_id";
    $result_check = mysqli_query($con, $check_product);

    if (mysqli_num_rows($result_check) == 0) {
        echo "<script>alert('Payment Successful and Product Removed from Catalog')</script>";
    } else {
        echo "<script>alert('Payment Successful but Failed to Remove Product from Catalog')</script>";
    }

    echo "<script>window.open('profile.php?my_orders', '_self')</script>";
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirm Payment</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        .hidden {
            display: none;
        }
    </style>
</head>
<body class="bg-secondary">
    <div class="container mt-5">
        <h2 class="text-center">Confirm Payment</h2>
        <form action="" method="post" enctype="multipart/form-data">
            <div class="form-outline my-4 text-center w-50 m-auto">
                <input type="text" class="form-control w-50 m-auto" name="invoice_number" value="<?php echo $invoice_number ?>" readonly>
            </div>
            <div class="form-outline my-4 text-center w-50 m-auto">
                <label for="">Amount :</label>
                <input type="text" class="form-control w-50 m-auto" name="amount" value="<?php echo $amount_due ?>" readonly>
            </div>
            <div class="form-outline my-4 text-center w-50 m-auto">
                <select name="payment_mode" id="payment_mode" class="form-select w-50 m-auto" onchange="showPaymentInfo()">
                    <option>Select payment mode</option>
                    <option value="Transfer Bank">Transfer Bank</option>
                    <option value="Gopay">Gopay</option>
                    <option value="Shopeepay">Shopeepay</option>
                    <option value="COD">COD</option>
                </select>
            </div>
            <div id="payment_info" class="form-outline my-4 text-center w-50 m-auto hidden">
                <p id="payment_details"></p>
            </div>
            <div class="form-outline my-4 text-center w-50 m-auto">
                <label for="">Upload your transfer/payment details picture here :</label>
                <input type="file" class="form-control w-50 m-auto mt-3" name="transaction_details" required="required">
            </div>
            <div class="form-outline my-4 text-center w-50 m-auto">
                <input type="submit" class="btn btn-dark px-4" name="confirm_payment" value="Confirm">
            </div>
        </form>
    </div>

    <script>
        function showPaymentInfo() {
            const paymentMode = document.getElementById('payment_mode').value;
            const paymentInfo = document.getElementById('payment_info');
            const paymentDetails = document.getElementById('payment_details');

            paymentInfo.classList.add('hidden'); // Hide the payment info by default

            if (paymentMode === 'Transfer Bank') {
                paymentDetails.textContent = 'Bank Account: 1234567890';
                paymentInfo.classList.remove('hidden');
            } else if (paymentMode === 'Gopay' || paymentMode === 'Shopeepay') {
                paymentDetails.textContent = 'Phone Number: +62 812-3456-7890';
                paymentInfo.classList.remove('hidden');
            } else {
                paymentDetails.textContent = '';
            }
        }
    </script>
</body>
</html>
