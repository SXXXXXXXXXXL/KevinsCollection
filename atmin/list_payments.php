<style>
.img_transactions{
    width: 50%;
    object-fit: contain;
}
</style>

<h3 class="text-center">All Payment</h3>
<table class="table table-bordered mt-5">
    <thead class="text-center">
        <tr>
            <th>No</th>
            <th>Amount</th>
            <th>Invoice Number</th>
            <th>Payment Mode</th>
            <th>Payment Evidence</th>
            <th>Order Date</th>
            <th>Delete</th>
        </tr>
    </thead>
    <tbody class='text-center'>
        <?php
        $get_payments = "SELECT * FROM user_payments";
        $result = mysqli_query($con, $get_payments);

        if (mysqli_num_rows($result) == 0) {
            echo "<tr><td colspan='6'><h2 class='text-center mt-5'>No Completed Payment Yet</h2></td></tr>";
        } else {
            $number = 0;
            while ($row_data = mysqli_fetch_assoc($result)) {
                $order_id = $row_data['order_id'];
                $payment_id = $row_data['payment_id'];
                $amount = $row_data['amount'];
                $invoice_number = $row_data['invoice_number'];
                $payment_mode = $row_data['payment_mode'];
                $transaction_details= $row_data['transaction_details'];
                $date = $row_data['date'];
                $number++;
                
                echo "
                <tr>
                    <td>$number</td>
                    <td>$invoice_number</td>
                    <td>$amount</td>
                    <td>$payment_mode</td>
                    <td><img src='../user/transaction_details/$transaction_details' class='img_transactions'></td>
                    <td>$date</td>
                    <td><a href='indexatmin.php?delete_payment=$payment_id'><i class='fa-solid fa-trash'></i></a></td>
                </tr>";
            }
        }
        ?>
    </tbody>
</table>
