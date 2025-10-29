<style>
    .user_img{
        width: 30%;
    }
</style>

<h3 class="text-center">All Users</h3>
<table class="table table-bordered mt-5">
    <thead class="text-center">
        <tr>
            <th>No</th>
            <th>Username</th>
            <th>User Email</th>
            <th>User Image</th>
            <th>User Address</th>
            <th>User Mobile</th>
            <th>Delete</th>
        </tr>
    </thead>
    <tbody class='text-center'>
        <?php
        $get_payments = "SELECT * FROM user_table";
        $result = mysqli_query($con, $get_payments);

        if (mysqli_num_rows($result) == 0) {
            echo "<tr><td colspan='6'><h2 class='text-center mt-5'>No Users Yet</h2></td></tr>";
        } else {
            $number = 0;
            while ($row_data = mysqli_fetch_assoc($result)) {
                $user_id = $row_data['user_id'];
                $username = $row_data['username'];
                $user_email = $row_data['user_email'];
                $user_image = $row_data['user_image'];
                $user_address = $row_data['user_address'];
                $user_mobile = $row_data['user_mobile'];
                $number++;
                
                echo "
                <tr>
                    <td>$number</td>
                    <td>$username</td>
                    <td>$user_email</td>
                    <td><img src='../user/user_images/$user_image' alt='$username' class='user_img'></td>
                    <td>$user_address</td>
                    <td>$user_mobile</td>
                    <td><a href='indexatmin.php?delete_user=$user_id'><i class='fa-solid fa-trash'></i></a></td>
                </tr>";
            }
        }
        ?>
    </tbody>
</table>
