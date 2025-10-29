<h3 class="text-center">All Orders</h3>
<table class="table table-bordered mt-5">
    <thead class="text-center">
        <tr>
            <th>No</th>
            <th>Due Amount</th>
            <th>Total Products</th>
            <th>Invoice Number</th>
            <th>Order Date</th>
            <th>Status</th>
            <th>Delete</th>
        </tr>
    </thead>
    <tbody class='text-center'>
        <?php
        $get_orders = "SELECT * FROM user_orders";
        $result = mysqli_query($con, $get_orders);

        if (mysqli_num_rows($result) == 0) {
            echo "<tr><td colspan='6'><h2 class='text-center mt-5'>No Order Yet</h2></td></tr>";
        } else {
            $number = 0;
            while ($row_data = mysqli_fetch_assoc($result)) {
                $order_id = $row_data['order_id'];
                $user_id = $row_data['user_id'];
                $total_products= $row_data['total_products'];
                $amount_due = $row_data['amount_due'];
                $invoice_number = $row_data['invoice_number'];
                $order_date = $row_data['order_date'];
                $order_status = $row_data['order_status'];
                $number++;
                
                echo "
                <tr>
                    <td>$number</td>
                    <td>$amount_due</td>
                    <td>$total_products</td>
                    <td>$invoice_number</td>
                    <td>$order_date</td>
                    <td>$order_status</td>
                    <td><a href='indexatmin.php?delete_order=$order_id'><i class='fa-solid fa-trash'></i></a></td>
                </tr>";
            }
        }
        ?>
    </tbody>
</table>
