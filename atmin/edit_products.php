<?php
    if(isset($_GET['edit_products'])){
        $edit_id=$_GET['edit_products'];
        $get_data="SELECT * FROM products WHERE product_id=$edit_id";
        $result=mysqli_query($con, $get_data);
        $row=mysqli_fetch_assoc($result);
        $product_title=$row['product_title'];
        $product_desc=$row['product_desc'];
        $product_keywords=$row['product_keywords'];
        $category_id=$row['category_id'];
        $brand_id=$row['brand_id'];
        $product_image1=$row['product_image1'];
        $product_image2=$row['product_image2'];
        $product_image3=$row['product_image3'];
        $product_price=$row['product_price'];

        // fetch categories
        $select_category="SELECT * FROM categories WHERE category_id=$category_id";
        $result_category=mysqli_query($con, $select_category);
        $row_category=mysqli_fetch_assoc($result_category);
        $category_title=$row_category['category_title'];

        // fetch brand
        $select_brand="SELECT * FROM brands WHERE brand_id=$brand_id";
        $result_brand=mysqli_query($con, $select_brand);
        $row_brand=mysqli_fetch_assoc($result_brand);
        $brand_title=$row_brand['brand_title'];
    }
?>

<div class="container">
    <h2 class="text-center">Edit Products</h2>
    <form method="post" enctype="multipart/form-data">
        <div class="form-outline w-50 m-auto mb-4">
            <label for="product_title" class="form-label">Product Title</label>
            <input type="text" id="product_title" name="product_title" class="form-control border border-dark" value="<?php echo $product_title ?>" required="required">
        </div>
        <div class="form-outline w-50 m-auto mb-4">
            <label for="product_desc" class="form-label">Product Description</label>
            <input type="text" id="product_desc" name="product_desc" class="form-control border border-dark" value="<?php echo $product_desc ?>" required="required">
        </div>
        <div class="form-outline w-50 m-auto mb-4">
            <label for="product_keyword" class="form-label">Product Keywords</label>
            <input type="text" id="product_keyword" name="product_keyword" class="form-control border border-dark" value="<?php echo $product_keywords ?>" required="required">
        </div>
        <div class="form-outline w-50 m-auto mb-4">
            <label for="product_cat" class="form-label">Product Category</label>
            <select name="product_cat" id="product_cat" class="form-select border border-dark">   
                <option value="<?php echo $category_id ?>"><?php echo $category_title ?></option>
                <?php
                    $select_category_all="SELECT * FROM categories";
                    $result_category_all=mysqli_query($con, $select_category_all);
                    while($row_category_all=mysqli_fetch_assoc($result_category_all)){
                        $category_id=$row_category_all['category_id'];
                        $category_title=$row_category_all['category_title'];
                        echo "<option value='$category_id'>$category_title</option>";
                    }
                ?>
            </select>
        </div>
        <div class="form-outline w-50 m-auto mb-4">
            <label for="product_brand" class="form-label">Product Brand</label>
            <select name="product_brand" id="product_brand" class="form-select border border-dark">
                <option value="<?php echo $brand_id ?>"><?php echo $brand_title ?></option>
                <?php
                    $select_brand_all="SELECT * FROM brands";
                    $result_brand_all=mysqli_query($con, $select_brand_all);
                    while($row_brand_all=mysqli_fetch_assoc($result_brand_all)){
                        $brand_id=$row_brand_all['brand_id'];
                        $brand_title=$row_brand_all['brand_title'];
                        echo "<option value='$brand_id'>$brand_title</option>";
                    }
                ?>
            </select>
        </div>
        <div class="form-outline w-50 m-auto mb-4">
            <label for="product_image1" class="form-label">Product Image 1</label>
            <div class="d-flex">
                <input type="file" id="product_image1" name="product_image1" class="form-control w-90 m-auto border border-dark">
                <img src="product_images/<?php echo $product_image1 ?>" alt="" class="prod_img">
            </div>            
        </div>
        <div class="form-outline w-50 m-auto mb-4">
            <label for="product_image2" class="form-label">Product Image 2</label>
            <div class="d-flex">
                <input type="file" id="product_image2" name="product_image2" class="form-control w-90 m-auto border border-dark">
                <img src="product_images/<?php echo $product_image2 ?>" alt="" class="prod_img">
            </div>            
        </div>
        <div class="form-outline w-50 m-auto mb-4">
            <label for="product_image3" class="form-label">Product Image 3</label>
            <div class="d-flex">
                <input type="file" id="product_image3" name="product_image3" class="form-control w-90 m-auto border border-dark">
                <img src="product_images/<?php echo $product_image3 ?>" alt="" class="prod_img">
            </div>            
        </div>
        <div class="form-outline w-50 m-auto mb-4">
            <label for="product_price" class="form-label">Product Price</label>
            <input type="text" id="product_price" name="product_price" class="form-control border border-dark" value="<?php echo $product_price ?>" required="required">
        </div>
        <div class="form-outline w-50 m-auto mb-4 text-center">
            <input type="submit" id="edit_product" name="edit_product" class="btn btn-dark" value="Update Product" required="required">
        </div>
    </form>
</div>

<!-- Updating products -->
<?php
    if(isset($_POST['edit_product'])){
        $product_title=$_POST['product_title'];
        $product_desc=$_POST['product_desc'];
        $product_keyword=$_POST['product_keyword'];
        $product_category=$_POST['product_cat'];
        $product_brand=$_POST['product_brand'];
        $product_price=$_POST['product_price']; 

        $product_image1=$_FILES['product_image1']['name'];
        $product_image2=$_FILES['product_image2']['name'];
        $product_image3=$_FILES['product_image3']['name'];

        $tmp_product_image1=$_FILES['product_image1']['tmp_name'];
        $tmp_product_image2=$_FILES['product_image2']['tmp_name'];
        $tmp_product_image3=$_FILES['product_image3']['tmp_name'];

        // Check if new images are uploaded, if not keep the existing ones
        if(empty($product_image1)){
            $product_image1 = $row['product_image1'];
        } else {
            move_uploaded_file($tmp_product_image1,"./product_images/$product_image1");
        }

        if(empty($product_image2)){
            $product_image2 = $row['product_image2'];
        } else {
            move_uploaded_file($tmp_product_image2,"./product_images/$product_image2");
        }

        if(empty($product_image3)){
            $product_image3 = $row['product_image3'];
        } else {
            move_uploaded_file($tmp_product_image3,"./product_images/$product_image3");
        }

        // query to update product
        $update_product="UPDATE products SET product_title='$product_title', product_desc='$product_desc', product_keywords='$product_keyword', category_id='$product_category', brand_id='$product_brand', product_image1='$product_image1', product_image2='$product_image2', product_image3='$product_image3', product_price='$product_price', date=NOW() WHERE product_id=$edit_id";
        $result_update=mysqli_query($con,$update_product);
        if($result_update){
            echo "<script>alert('Product updated successfully')</script>";
            echo "<script>window.open('indexatmin.php?view_products','_self')</script>";
        }
    }
?>
