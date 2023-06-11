<?php
    require_once './phpStuff/coreFunctions.php';
?>

<?php
    
    if (isset($_SESSION['loggedIn']) == true) {
        
?>

<?php

    if (isset($_POST['updateProduct'])) {
        
        $img_name = $_FILES['img']['name'];
        $img_type = $_FILES['img']['type'];
        $img_size = $_FILES['img']['size'];
        $tmp_name = $_FILES['img']['tmp_name'];

        updateProductImage($img_name, $img_size, $img_type, $tmp_name);



        $id = $_POST['id'];
        $name = $_POST['productName'];
        $detail = $_POST['productDetail'];
        $price = $_POST['productPrice'];
        $remark = $_POST['productRemark'];



        if (updateProductDetails($id, $name, $detail, $price, $remark, $img_name) == true) {
            redirectTo('dashboard.php');
        }
        else {
            redirectTo('index.php');
        }
    

    }
    
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Product - Alvardah</title>
    <link rel="stylesheet" type="text/css" href="./bootstrap/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container-fluid">
        <div class="container" style="background:#f1f1f1;">
            <div class="form-container" style="padding: 30px;">
                <h2 class="alert alert-info text-center">Edit Product</h2>



                <?php 
                    // Displaying existing DATA

                    global $conn;

                    $id = $_GET['id'];

                    $sql = "SELECT * FROM `inventory` WHERE `id` = '$id'";

                    $result = mysqli_query($conn, $sql);

                    $product = mysqli_fetch_array($result);
                ?>


                <div class="container-fluid d-flex justify-content-center">
                    <img width="200px" src="./products/<?php echo $product['pic'];?>" >
                </div>

                <form action="?" method="POST" autocomplete="off" enctype="multipart/form-data">
                    <input  hidden name="id" value="<?php echo $product['id']; ?>">
                    <fieldset class="form-group">
                        <label class="form-label">Name</label>
                        <input class="form-control" type="" name="productName" value="<?php echo $product['name']; ?>">
                    </fieldset>
                    <fieldset class="form-group">
                        <label class="form-label">Detail</label><br>
                        <textarea class="form-control" rows="4" name="productDetail"><?php echo $product['detail']; ?></textarea>
                    </fieldset>
                    <fieldset class="form-group">
                        <label class="form-label">Price</label>
                        <input class="form-control" type="number" name="productPrice" value="<?php echo $product['price']; ?>">
                    </fieldset>
                    <fieldset class="form-group">
                        <label class="form-label">Remark</label>
                        <input class="form-control" type="text" name="productRemark" value="<?php echo $product['remark']; ?>">
                    </fieldset>
                    <fieldset class="form-group">
                        <label class="form-label">Image</label>
                        <input class="form-control" type="file" name="img">
                    </fieldset>
                    <fieldset>
                        <button class="btn btn-success form-control" type="submit" name="updateProduct">
                            Save Changes
                        </button>
                    </fieldset>
                </form>
            </div>
        </div>
    </div>
</body>
</html>

<?php
}
else {
    ?>
        <h1 align="center" style="color: red;">UNAUTHORIZED ACCESS, GET OUT!</h1>
    <?php
}
?>