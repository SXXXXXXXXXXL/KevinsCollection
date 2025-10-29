<?php
include('../include/connect.php');

if(isset($_POST['insert_product'])){
    
    $product_title=$_POST['product_title'];
    $product_desc=$_POST['product_desc'];
    $product_keyword=$_POST['product_keyword'];
    $product_category=$_POST['product_category'];
    $product_brand=$_POST['product_brand'];
    $product_price=$_POST['product_price'];
    $product_status='true';

    //access images
    $product_image1=$_FILES['product_image1']['name'];
    $product_image2=$_FILES['product_image2']['name'];
    $product_image3=$_FILES['product_image3']['name'];
    
    //access images tmp name
    $temp_image1=$_FILES['product_image1']['tmp_name'];
    $temp_image2=$_FILES['product_image2']['tmp_name'];
    $temp_image3=$_FILES['product_image3']['tmp_name'];

    //checking empty condition
    if($product_title== '' or $product_desc=='' or $product_keyword=='' or $product_category=='' or $product_brand=='' or $product_price== '' or $product_image1=='' or $product_image2=='' or $product_image3== ''){
        echo"<script>alert('Please Fill all the fields')</script>";
        exit();
    }else{
        move_uploaded_file($temp_image1,"./product_images/$product_image1");
        move_uploaded_file($temp_image2,"./product_images/$product_image2");
        move_uploaded_file($temp_image3,"./product_images/$product_image3");

        //insert query
        $insert_products="insert into products (product_title,product_desc,product_keywords,category_id,brand_id,product_image1,product_image2,product_image3,product_price,date,status) values ('$product_title','$product_desc','$product_keyword','$product_category','$product_brand','$product_image1','$product_image2','$product_image3','$product_price',NOW(),'$product_status')";
        $result_query=mysqli_query($con,$insert_products);
        if($result_query){
            echo"<script>alert('Products Successfully Added')</script>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Insert Products - Admin Dashboard</title>
    <!-- Bootstrap css -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <!-- css link -->
    <link rel="stylesheet" href="../style.css">
    <!-- Font Link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body class="mt-3">
    <div class="container">
        <h2 class="text-center">Insert Products</h2>
        <!-- form -->
        <form action="" method="post" enctype="multipart/form-data">
            <!-- title -->
            <div class="form-outline mb-4 w-70 m-auto">
                <label for="product_title" class="form-label">Product Title</label>
                <input type="text" name="product_title" id="product_title" class="form-control border border-dark" placeholder="Enter Product Title.." autocomplete="off" required="required">
            </div>
            <!-- Description -->
            <div class="form-outline mb-4 w-70 m-auto">
                <label for="product_desc" class="form-label">Product Description</label>
                <input type="text" name="product_desc" id="product_desc" class="form-control border border-dark" placeholder="Enter Product Description.." autocomplete="off" required="required">
            </div>
            <!-- Keywords -->
            <div class="form-outline mb-4 w-70 m-auto">
                <label for="product_keyword" class="form-label">Product Keyword</label>
                <input type="text" name="product_keyword" id="product_keyword" class="form-control border border-dark" placeholder="Enter Product Keyword.." autocomplete="off" required="required">
            </div>
            <!-- Category -->
            <div class="form-outline mb-4 w-70 m-auto">
                <label for="product_category" class="form-label">Select Category</label>
                <select name="product_category" id="product_category" class="form-select border border-dark" required>
                    <option value="">Select Category</option>
                    <?php
                    $select_query = "SELECT * FROM categories";
                    $result_query = mysqli_query($con, $select_query);
                    while($row = mysqli_fetch_assoc($result_query)){
                        $category_title = $row['category_title'];
                        $category_id = $row['category_id'];
                        echo "<option value='$category_id'>$category_title</option>";
                    }
                    ?>
                </select>
            </div>
            <!-- Brand -->
            <div class="form-outline mb-4 w-70 m-auto">
                <label for="product_brand" class="form-label">Select Brand</label>
                <select name="product_brand" id="product_brand" class="form-select border border-dark" required>
                    <option value="">Select Brand</option>
                    <?php
                    $select_query = "SELECT * FROM brands";
                    $result_query = mysqli_query($con, $select_query);
                    while($row = mysqli_fetch_assoc($result_query)){
                        $brand_title = $row['brand_title'];
                        $brand_id = $row['brand_id'];
                        echo "<option value='$brand_id'>$brand_title</option>";
                    }
                    ?>
                </select>
            </div>
            <!-- Image 1 -->
            <div class="form-outline mb-4 w-70 m-auto">
                <label for="product_image1" class="form-label">Insert Image 1</label>
                <input type="file" name="product_image1" id="product_image1" class="form-control border border-dark" required="required">
            </div>
            <!-- Image 2 -->
            <div class="form-outline mb-4 w-70 m-auto">
                <label for="product_image2" class="form-label">Insert Image 2</label>
                <input type="file" name="product_image2" id="product_image2" class="form-control border border-dark" required="required">
            </div>
            <!-- Image 3 -->
            <div class="form-outline mb-4 w-70 m-auto">
                <label for="product_image3" class="form-label">Insert Image 3</label>
                <input type="file" name="product_image3" id="product_image3" class="form-control border border-dark" required="required">
            </div>
            <!-- Price -->
            <div class="form-outline mb-4 w-70 m-auto">
                <label for="product_price" class="form-label">Product Price</label>
                <input type="text" name="product_price" id="product_price" class="form-control border border-dark" placeholder="Enter Product Price.." autocomplete="off" required="required">
            </div>
            <!-- Submit -->
            <div class="form-outline mb-4 w-70 m-auto">
                <input type="submit" name="insert_product" class="btn btn-dark mb-3 px-3" value="Insert Products">
            </div>
        </form>
    </div>
</body> 
</html>
