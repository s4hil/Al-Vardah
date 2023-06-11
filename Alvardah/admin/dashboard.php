<?php
    include_once './phpStuff/coreFunctions.php';

    if (isset($_SESSION['loggedIn']) == true) {
?>

<?php

    if (isset($_GET['logout'])) {
        logOut();
    }

    if (isset($_GET['delete'])) {
        
        $id = $_GET['id'];

        if (deleteProduct($id) == true){
            redirectTo('dashboard.php');
         } 
    }

    if (isset($_GET['edit'])) {
        
        $id = $_GET['id'];

        redirectTo('editProduct.php?id='. $id);
    }

?>


<?php

    if (isset($_POST['bestprodbtn'])) {


        $img_name = $_FILES['bpimg']['name'];
        $img_type = $_FILES['bpimg']['type'];
        $img_size = $_FILES['bpimg']['size'];
        $tmp_name = $_FILES['bpimg']['tmp_name'];

        if (uploadBestProductImage($img_name, $img_type, $img_size, $tmp_name) == true){
                    

        $id = $_POST['bestprodid'];
        $name = $_POST['bestprodname'];
        $detail = mysqli_real_escape_string($_POST['bestproddetails']);
        $price = $_POST['bestprodprice'];
        uploadBestProduct($name, $detail, $price, $img_name);
        alert('Updated');
    }
    
    else{
        echo "<script>alert('Error, Size should be less than 300kbs and of the format jpg, jpeg, png');</script>";

    }

    }


?>



<?php


    if (isset($_POST['addProduct'])) {

       

        $img_name = $_FILES['img']['name'];
        $img_type = $_FILES['img']['type'];
        $img_size = $_FILES['img']['size'];
        $tmp_name = $_FILES['img']['tmp_name'];
        
        if (uploadProductImage($img_name, $img_type, $img_size, $tmp_name) == true){
                    


        $name = $_POST['prodName'];
        $detail = mysqli_real_escape_string($conn,$_POST['prodDetail']);
        $price = $_POST['prodPrice'];
        $remark = $_POST['prodRemark'];
        addProductToInventory($name, $detail, $price, $remark, $img_name);
    }
    
    else{
        echo "<script>alert('Error, Size should be less than 300kbs and of the format jpg, jpeg, png');</script>";

    }




    }

    if (isset($_POST['updateStatus'])) {
        
        $id = $_POST['id'];
        $status = $_POST['statusbox'];

        updateStatus($id, $status);
    }


?>

<?php

    if (isset($_POST['addUser'])) {

        $userName = base64_encode($_POST['userName']);
        $userPassword = base64_encode($_POST['userPassword']);
        $userEmail = $_POST['userEmail'];
        $userNumber = $_POST['userNumber'];

        if (addUser($userName, $userPassword, $userEmail, $userNumber) == true) {
            alert('Added!');
        }
        else{
            alert('Failed To Add!');
        }
    }
?>




<?php
    
    if (isset($_POST['updateBio'])) {

       



        $img_name = $_FILES['abtPic']['name'];
        $img_type = $_FILES['abtPic']['type'];
        $img_size = $_FILES['abtPic']['size'];
        $tmp_name = $_FILES['abtPic']['tmp_name'];
        
        if (uploadBioImage($img_name, $img_type, $img_size, $tmp_name) == true){
                    
            $name = $_POST['abtName'];
            $bio = mysqli_real_escape_string($conn, $_POST['abtBio']);

            updateAbout($name, $bio, $img_name);
    }
}
?>

<?php

    if (isset($_POST['updateQuote'])) {
        global $conn;

        $author = $_POST['author'];
        $quote = mysqli_real_escape_string($conn, $_POST['quote']);

       if (updateQuote($author, $quote) == true) {
            alert('Quote Updated!');
        } 
        else{
            alert('Failed To Update The Quote!');
        }
    }

?>





<!DOCTYPE html>
<html dir="ltr" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin - Alvardah</title>
    <link rel="canonical" href="https://www.wrappixel.com/templates/ample-admin-lite/" />
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="favicon.png">
    <!-- Custom CSS -->
   <link href="css/style.min.css" rel="stylesheet">
   <link rel="stylesheet" type="text/css" href="css/customStyle.css">
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet">

    <style type="text/css">
        img[alt="www.000webhost.com"] {
                  display: none;
            }

        #date, #time {
            border-radius: 15px;
            animation: blinks 2s ease-in-out infinite;
        }

        @keyframes blinks {
            0% {
                opacity: 1;
            }
            50% {
                opacity: 0;
            }
            100% {
                opacity: 1;
            }
        }
    </style>
</head>

<body>
    <!-- ============================================================== -->
    <!-- Preloader - style you can find in spinners.css -->
    <!-- ============================================================== -->
    <div class="preloader">
        <div class="lds-ripple">
            <div class="lds-pos"></div>
            <div class="lds-pos"></div>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- Main wrapper - style you can find in pages.scss -->
    <!-- ============================================================== -->
    <div id="main-wrapper" data-layout="vertical" data-navbarbg="skin5" data-sidebartype="full"
        data-sidebar-position="absolute" data-header-position="absolute" data-boxed-layout="full">
        <!-- ============================================================== -->
        <!-- Topbar header - style you can find in pages.scss -->
        <!-- ============================================================== -->
        <header class="topbar" data-navbarbg="skin5">
            <nav class="navbar top-navbar navbar-expand-md navbar-dark">
                <div class="navbar-header" data-logobg="skin6">
                    <!-- ============================================================== -->
                    <!-- Logo -->
                    <!-- ============================================================== -->
                    <a class="navbar-brand" href="dashboard.html">
                        <!-- Logo icon -->
                        <b class="logo-icon">
                            <!-- Dark Logo icon -->
                            <img src="./pix/logo.png" alt="homepage" width="150"/>
                        </b>
                        <!--End Logo icon -->
                    </a>
                    
                    <a style="font-size: x-large;" class="nav-toggler waves-effect waves-light text-dark d-block d-md-none"
                        href="javascript:void(0)"><i class="fas fa-align-justify"></i></a>
                </div>
                
                <div class="navbar-collapse collapse" id="navbarSupportedContent" data-navbarbg="skin5">
                    <ul class="navbar-nav d-none d-md-block d-lg-none">
                        <li class="nav-item">
                            <a class="nav-toggler nav-link waves-effect waves-light text-white"
                                href="javascript:void(0)"><i class="ti-menu ti-close"></i></a>
                        </li>
                    </ul>
                    
                    <ul class="navbar-nav d-flex justify-content-end ml-auto">

                        
                        <li class=" in">
                            
                        </li>
                        
                        <li>
                            <span class="text-white" style="font-size: larger">Hi, 
                            
                                <?php
                                if (isset($_SESSION['user'])) {
                                    echo base64_decode($_SESSION['user']);
                                }
                                ?>
                            </span>
                            &nbsp;
                            &nbsp;
                            &nbsp;
                            &nbsp;
                        </li>
                       
                    </ul>
                </div>
            </nav>
        </header>
        
        <aside class="left-sidebar" data-sidebarbg="skin6">
            <!-- Sidebar scroll-->
            <div class="scroll-sidebar">
                <!-- Sidebar navigation-->
                <nav class="sidebar-nav">
                    <ul id="sidebarnav">
                        <!-- User Profile-->
                        <br>
                        <li onclick="fadeOutRest(dashboard);" class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link"
                                href="#" aria-expanded="false"><i class="fas fa-clock fa-fw"
                                    aria-hidden="true"></i><span class="hide-menu">Dashboard</span></a>
                        </li>
                        <li onclick="fadeOutRest(home);" class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link"
                                href="#" aria-expanded="false">
                                <i class="fas fa-home" aria-hidden="true"></i><span class="hide-menu">Edit Home</span></a>
                        </li>
                        <li onclick="fadeOutRest(products);" class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link"
                                href="#" aria-expanded="false"><i class="fas fa-shopping-cart"
                                    aria-hidden="true"></i><span class="hide-menu">Inventory</span></a>
                        </li>
                        <li onclick="fadeOutRest(orders);" class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link"
                                href="#" aria-expanded="false"><i class="fa fa-list-ul"
                                    aria-hidden="true"></i><span class="hide-menu">Orders</span></a>
                        </li>
                        <li onclick="fadeOutRest(feedback);" class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link"
                                href="#" aria-expanded="false"><i class="fas fa-sticky-note"
                                    aria-hidden="true"></i><span class="hide-menu">Feedback</span></a>
                        </li>
                        <li onclick="fadeOutRest(account);" class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link"
                                href="#" aria-expanded="false"><i class="fa fa-user"
                                    aria-hidden="true"></i><span class="hide-menu">Account</span></a>
                        </li>
                        <li onclick="fadeOutRest(about);" class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link"
                                href="#" aria-expanded="false"><i class=" fas fa-exclamation-circle"
                                    aria-hidden="true"></i><span class="hide-menu">About</span></a>
                        </li>
                        
                        <!-- LOGOUT BUTTON -->
                        <li class="sidebar-item"> 

                            <form action="?" method="GET" style="margin:20px;">
                                <button name="logout" class="btn btn-danger">Log Out</button> &nbsp;
                            </form>
                        </li>

                    </ul>

                </nav>
                <!-- End Sidebar navigation -->
            </div>
            <!-- End Sidebar scroll-->
        </aside>
        
        <div class="page-wrapper" style="min-height: 250px;">
           
            <div class="container-fluid">
                
                <!-- ============================================================== -->
                <!-- Start Page Content -->
                <!-- ============================================================== -->
                
                <div class="row" id="dashboard">
                    <div class="col-md-12">
                        <div class="white-box">
                            <div class="container alert alert-info">
                                <h2 align="center">Welcome to Alvardah ADMIN PANEL!</h2> 
                            </div>

                            <div class="container">
                                <div class="row d-flex justify-content-around">
                                <div id="date" class="alert alert-warning class col-lg-4 col-sm-8">Date: <?php echo date('D/M/Y'); ?></div>
                                <div id="time" class="alert alert-secondary col-lg-4 col-sm-8">Time: <?php echo date('h:i'); ?></div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

                <div class="row" id="home">
                    <div class="col-md-12">
                        <div class="white-box">
                            <h3 class="box-title text-center"><div class="alert alert-success"><h2>Edit Home</h2></h3>

                                

                            <div class="container" style="background:#f1f1f1; padding: 20px;">
                                <div class="container" style="color: grey;">
                                    <h2 class="text-dark">Best Product</h2><br>    
                                    
                                    <!-- Button trigger modal -->
                                        <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#exampleModal">
                                          Edit Best Product
                                        </button>

                                        <!-- Modal -->
                                        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                          <div class="modal-dialog" role="document">
                                            

                                            <?php
                                                $bProd  = fetchBestProduct('1');
                                            ?>

                                            <form method="POST" autocomplete="off" action="?" class="form" enctype="multipart/form-data">

                                                <div class="modal-content">
                                                  <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Best Product</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                      <span aria-hidden="true">&times;</span>
                                                    </button>
                                                  </div>
                                                  <div class="modal-body">
                                                    <input hidden name="bestprodid" value="<?php echo $bProd['id']?>">

                                                    <fieldset class="form-group">
                                                        <label>Name</label>
                                                        <input class="form-control" type="text" name="bestprodname" value="<?php echo $bProd['name'];?>">
                                                    </fieldset>
                                                    <fieldset class="form-group">
                                                        <label>Details</label>
                                                        <textarea type="text" name="bestproddetails" rows="4" class="form-control"><?php echo $bProd['details'];?></textarea>
                                                    </fieldset>
                                                    <fieldset class="form-group">
                                                        <label>Price</label>
                                                        <input class="form-control" type="text" name="bestprodprice" value="<?php echo $bProd['price'];?>">
                                                    </fieldset>
                                                    <fieldset class="form-group">
                                                        <label>pic</label>
                                                        <input class="form-control" type="file" name="bpimg">
                                                    </fieldset>

                                                  </div>
                                                  <div class="modal-footer">
                                                    <div type="button" class="btn btn-secondary" data-dismiss="modal">Close</div>
                                                    <button type="submit" class="btn btn-primary" name="bestprodbtn">Save changes</button>
                                                  </div>
                                                </div>

                                            </form>

                                          </div>
                                        </div>

                                </div>
                            </div>

                            
                            <br>
                            

                            <div class="container" style="background:#f1f1f1; padding: 20px;">
                                <div class="container" style="color: grey;">
                                    <h2 class="text-dark">About Us</h2><br>     
                                    
                                    <!-- Button trigger modal -->
                                    <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#biomodal">
                                      Edit About
                                    </button>



                                    <?php

                                        global $conn;
                                        $sql = "SELECT * FROM `about` WHERE `id` = '1'";
                                        $res = mysqli_query($conn, $sql);
                                        $abt = mysqli_fetch_array($res);

                                    ?>



                                    <!-- Modal -->
                                    <div class="modal fade" id="biomodal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                      <div class="modal-dialog">
                                        <div class="modal-content">
                                          <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">About</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                          </div>
                                          <div class="modal-body">
                                           
                                            <form action="?" method="POST" autocomplete="off" enctype="multipart/form-data">
                                                <fieldset class="form-group">
                                                    <label>Name</label>
                                                    <input type="text" name="abtName" class="form-control" value="<?php echo $abt['name']; ?>" maxlength="150">
                                                </fieldset>
                                                <fieldset class="form-group">
                                                    <label>Bio</label>
                                                    <textarea rows="5" type="text" name="abtBio" class="form-control"><?php echo $abt['bio'];?></textarea>
                                                </fieldset>
                                                <fieldset class="form-group">
                                                    <label>Image</label>
                                                    <input type="file" class="form-control" name="abtPic" accept="images/*">
                                                </fieldset>
                                                
                                            <div class="btn btn-secondary" data-bs-dismiss="modal">Close</div>
                                            <button type="submit" class="btn btn-primary" name="updateBio">
                                                Save changes
                                            </button>
                                            </form>
                                          </div>
                                        </div>
                                      </div>
                                    </div>


                                </div>
                            </div>



                                <br>



                            <div class="container" style="background:#f1f1f1; padding: 20px;">
                                <div class="container" style="color: grey;">
                                    <h2 class="text-dark">Quote</h2><br>    
                                    
                                    <!-- Button trigger modal -->
                                        <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#updateQuote">
                                          Edit Quote
                                        </button>

                                        <!-- Modal -->
                                        <div class="modal fade" id="updateQuote" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                          <div class="modal-dialog" role="document">
                                            

                                            <?php
                                                global $conn;
                                                $quote = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM `quotes` WHERE `id` = '1'"));
                                            ?>

                                            <form method="POST" autocomplete="off" action="?" class="form">

                                                <div class="modal-content">
                                                  <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Quote</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                      <span aria-hidden="true">&times;</span>
                                                    </button>
                                                  </div>
                                                  <div class="modal-body">
                                                    
                                                    <fieldset class="form-group">
                                                        <label>Author</label>
                                                        <input class="form-control" type="text" name="author" value="<?php echo $quote['author'];?>">
                                                    </fieldset>
                                                    <fieldset class="form-group">
                                                        <label>Quote</label>
                                                        <textarea type="text" name="quote" rows="4" class="form-control"><?php echo $quote['quote'];?></textarea>
                                                    </fieldset>
                                                    

                                                  </div>
                                                  <div class="modal-footer">
                                                    <div type="button" class="btn btn-secondary" data-dismiss="modal">Close</div>
                                                    <button type="submit" class="btn btn-primary" name="updateQuote">Save changes</button>
                                                  </div>
                                                </div>

                                            </form>

                                          </div>
                                        </div>

                                </div>
                            </div>



                        </div>


                    </div>
                </div>

                        
                

                <div class="row" id="products">
                    <div class="col-md-12">
                        <div class="white-box">
                            <h3 class="box-title text-center"><div class="alert alert-success"><h2>Inventory</h2></h3>
                            
                            <button class="btn btn-success float-right"  data-toggle="modal" data-target=".bd-example-modal-lg" style="margin-bottom: 15px">
                                <i class="fas fa-plus"></i>
                                Add Product
                            </button>

                            <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                              <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Add Product</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                      <span aria-hidden="true">&times;</span>
                                    </button>
                                  </div>
                                  <div class="modal-body">
                                    <form action="?" method="POST" class="form" autocomplete="off" enctype="multipart/form-data">
                                        
                                        <fieldset class="form-group">
                                            <label>Name</label>
                                            <input type="text" name="prodName" class="form-control">
                                        </fieldset><br>
                                        <fieldset class="form-group">
                                            <label>Detail</label>
                                            <textarea name="prodDetail" class="form-control" rows="4" name="details"></textarea>
                                        </fieldset><br>
                                        <fieldset class="form-group">
                                            <label>Price</label>
                                            <input type="text" name="prodPrice" class="form-control">
                                        </fieldset><br>
                                        <fieldset class="form-group">
                                            <label>Remark</label>
                                            <input type="text" name="prodRemark" class="form-control">
                                        </fieldset><br>
                                        <fieldset class="form-group">
                                            <label>Image</label>
                                            <input type="file" name="img" class="form-control" accept="image/*">
                                        </fieldset><br>
                                    
                                    
                                  </div>
                                  <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary" name="addProduct">Add</button>
                                    </form>

                                  </div>
                                </div>

                              </div>
                            </div>


                            <?php

                            // Fetch Products From DB | Populate the table.
    
                                global $conn;

                                $query = "SELECT * FROM `inventory`";

                                $res = mysqli_query($conn, $query);
                                ?>
                                
                                
                            


                            <table class="table table-striped" id="inventoryTable" style="width: 100%;">
                                <thead class="bg-light text-white">
                                    <th hidden>db_id</th>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Price</th>
                                    <th id="rmrk">Remark</th>
                                    <th>Action</th>
                                </thead>
                                <tbody>

                                <?php while ($product = mysqli_fetch_array($res)) {
                                    ?>

                                    <tr>
                                        <td hidden><?php echo $product['id']; ?></td>
                                        <td><?php echo $product['productid']; ?></td>
                                        <td><?php echo $product['name']; ?></td>
                                        <td><?php echo $product['price']; ?></td>
                                        <td id="rmrk"><?php echo $product['remark']; ?></td>
                                        <td>
                                            <a href="dashboard.php?edit&id=<?php echo $product['id']; ?>">
                                                <button class="btn btn-primary" id="actionBtn">
                                                    <i class="fas fa-edit"></i>
                                                    Edit
                                                </button>
                                            </a>
                                            <a href="dashboard.php?delete&id=<?php echo $product['id']; ?>">
                                                <button class="btn btn-danger" id="actionBtn">
                                                    <i class="fas fa-trash-alt"></i>
                                                    Delete
                                                </button>
                                            </a>
                                        </td>
                                    </tr>

                                <?php }?>

                                </tbody>
                            </table>

                        </div>
                    </div>
                </div>

                <div class="row" id="orders">
                    <div class="col-md-12">
                        <div class="white-box">
                            <h3 class="box-title text-center"><div class="alert alert-success"><h2>Orders</h2></h3>
                        

                        <div class="container">
                            
                            <table class="table" id="orderTable" style="width: 100%;">
                                <thead  class="bg-dark text-white"> 
                                    <tr>
                                        <td>Date</td>
                                        <td>ID</td>
                                        <td>Product</td>
                                        <td>Customer</td>
                                        <td>Number</td>
                                        <td>Status</td>
                                        <td>Action</td>
                                    </tr>
                                </thead>
                                <tbody>

                                    <?php

                                        global $conn;

                                        $sql = "SELECT * FROM `orders`";
                                        $result = mysqli_query($conn, $sql);

                                        while ($order = mysqli_fetch_array($result)) {
                                            ?>

                                            <tr style="background: #fff;">
                                                <td><?php echo $order['date'] ;?></td>
                                                <td><?php echo $order['orderid'] ;?></td>
                                                <td><?php echo $order['product'] ;?></td>
                                                <td><?php echo $order['customer'] ;?></td>
                                                <td><?php echo $order['number'] ;?></td>
                                                <form method="POST" action="?">
                                                    
                                                    <td>
                                                        <input hidden name="id" value="<?php echo $order['id'] ;?>">
                                                        <select name="statusbox">
                                                            <option><?php echo $order['status'] ;?></option>
                                                            <option value="Placed">Placed</option>
                                                            <option value="Out For Delivery">Out For Delivery</option>
                                                            <option value="Delivered">Delivered</option>
                                                        </select>
                                                    </td>
                                                    <td>
                                                        <button class="btn btn-success" type="submit" name="updateStatus">Update Status</button>

                                                         <!-- Button trigger modal -->
                                                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#orderdetails">
                                                          More
                                                        </button>

                                                        <!-- Modal -->
                                                        <div class="modal fade" id="orderdetails" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                          <div class="modal-dialog">
                                                            <div class="modal-content">
                                                              <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalLabel">Order Details</h5>
                                                                <div class="btn-close" data-bs-dismiss="modal" aria-label="Close"></div>
                                                              </div>
                                                              <div class="modal-body">
                                                                Size: <?php echo $order['size'] . '<br>' ;?>
                                                                Address: <?php echo $order['address'] . '<br>' ;?>
                                                                Email: <?php echo $order['email'] . '<br>' ;?>
                                                              </div>
                                                              <div class="modal-footer d-flex justify-content-between">

                                                                    <a 
                                                                    href="./phpStuff/deleteOrder.php?delOrdr&oID=<?php echo $order['orderid']; ?>" 
                                                                    class="btn btn-danger">Delete Entry</a>

                                                                    <button class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                                
                                                              </div>
                                                            </div>
                                                          </div>
                                                        </div>

                                                    </td>
                                                </form>

                                               

                                            </tr>

                                            <?php
                                        }

                                    ?>

                                </tbody>
                            </table>


                        </div>
                        </div>
                    </div>
                </div>
                <div class="row" id="feedback">
                    <div class="col-md-12">
                        <div class="white-box">
                            <h3 class="box-title text-center"><div class="alert alert-success"><h2>Feedback</h2></h3>

                                
                                <div id="card-container" class="container-fluid d-flex flex-row">


                                    <?php
                                    // Fetching Feedback from Database 

                                    global $conn;
                                    $sql = "SELECT * FROM `feedback`";
                                    $res = mysqli_query($conn, $sql);
                                    while ($feedback = mysqli_fetch_array($res)) {?>



                                    <div class="card" style="width: 18rem; margin: 15px;">
                                      <div class="card-body">
                                        <h5 class="card-title"><?php echo $feedback['name'] ;?></h5>
                                        
                                      </div>
                                      <ul class="list-group list-group-flush">
                                        <li class="list-group-item"><?php echo $feedback['number'] ;?></li>
                                        <li class="list-group-item"><?php echo $feedback['email'] ;?></li>
                                      </ul>
                                      <p class="card-text" style="padding: 12px;">
                                        <?php echo $feedback['message'] ;?>
                                      </p>
                                    </div> 
                                    <?php } ?>  
                                </div>
                                
                        </div>
                    </div>
                </div>
                <div class="row" id="account">
                    <div class="col-md-12">
                        <div class="white-box">
                            <h3 class="box-title text-center"><div class="alert alert-success"><h2>Account</h2></h3>
                            
                            <div class="container d-flex flex-column" style="background: #f1f1f1; padding: 20px; width: 60%; border-radius: 15px;">
                                <button href="reset_password.php" class="btn btn-secondary">Change Password</button><br><br>
                                
                                <button href="#" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#showusers">Show Users</button><br><br>

                                <!-- Modal -->
                                <div class="modal fade" id="showusers" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                  <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                      <div class="modal-header">
                                        <h5 class="modal-title" id="showusers">Users</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                      </div>
                                      <div class="modal-body">

                                        <?php
                                            global $conn;
                                            $sql = "SELECT * FROM  `admin`";
                                            $res = mysqli_query($conn, $sql);
                                        ?>

                                        <table class="table table-striped">
                                            <tr>
                                                <td>Name</td>
                                                <td>Email</td>
                                                <td>Number</td>
                                            </tr>
                                            <?php 
                                                while ($admin = mysqli_fetch_array($res)) {
                                            ?>
                                            <tr>
                                                <td><?php echo base64_decode($admin['name']) ;?></td>
                                                <td><?php echo $admin['email'] ;?></td>
                                                <td><?php echo $admin['number'] ;?></td>
                                            </tr>
                                        <?php } ?>
                                        </table>
                                      </div>
                                      <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                      </div>
                                    </div>
                                  </div>
                                </div>


                                <button href="#" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#addusers">Add User</button>

                                <!-- Modal -->
                                <div class="modal fade" id="addusers" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                  
                                  <form method="POST" action="?" autocomplete="off">
                                      <div class="modal-dialog">
                                        <div class="modal-content">
                                          <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Add User</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                          </div>
                                          <div class="modal-body">
                                            
                                            <fieldset class="form-group">
                                                <label>Username</label>
                                                <input class="form-control" type="text" name="userName">
                                            </fieldset>
                                            <fieldset class="form-group">
                                                <label>Password</label>
                                                <input class="form-control" type="password" name="userPassword">
                                            </fieldset>
                                            <fieldset class="form-group">
                                                <label>Email</label>
                                                <input class="form-control" type="text" name="userEmail">
                                            </fieldset>
                                            <fieldset class="form-group">
                                                <label>Number</label>
                                                <input class="form-control" type="number" name="userNumber">
                                            </fieldset>

                                          </div>
                                          <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-primary" name="addUser">ADD</button>
                                          </div>
                                        </div>
                                      </div>
                                  </form>

                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="row" id="about">
                    <div class="col-md-12">
                        <div class="white-box">
                            <h3 class="box-title text-center"><div class="alert alert-success"><h2>About</h2></h3>

                            <div class="container text-center"><br>
                                <h5>The website, 'ALVARDAH', was designed and developed by: <a href="https://bit.ly/sahilparray">Sahil Parray</a>.</h5><br><br>
                                <p>Contact Developer:</p>
                                <div class="icon-container" style="font-size: 40px;">
                                    <a href="http://fb.com/shl.pry"><i class="fab fa-facebook"></i></a>
                                    <a href="http://instagram.com/sahil_parray"><i class="fab fa-instagram"></i></a>
                                    <a href="mailto:s4hilp4rr4y@gmail.com"><i class="fas fa-envelope"></i></a>
                                    <a href="http://twitter.com/sahil_parray_"><i class="fab fa-twitter"></i></a>
                                </div><br><br>
                                <a href="userManual.pdf">
                                    <button class="btn btn-primary">User Instructions</button>
                                </a>
                            </div>
                    </div>
                </div>
                

            </div>
           </div>
            <footer class="footer text-center">
                <p>
                   © Alvardah 2020 <br>
                   Made with &lt;3 by <a href="https://bit.ly/sahilparray"> Sahil Parray</a>
                </p>
            </footer>
            <!-- ============================================================== -->
            <!-- End footer -->
            <!-- ============================================================== -->
        </div>
        <!-- ============================================================== -->
        <!-- End Page wrapper  -->
        <!-- ============================================================== -->
    </div>
    <!-- ============================================================== -->
    <!-- End Wrapper -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- All Jquery -->
    <!-- ============================================================== -->
    <script src="plugins/bower_components/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap tether Core JavaScript -->
    <script src="plugins/bower_components/popper.js/dist/umd/popper.min.js"></script>
    <script src="bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="js/app-style-switcher.js"></script>
    <!--Wave Effects -->
    <script src="js/waves.js"></script>
    <!--Menu sidebar -->
    <script src="js/sidebarmenu.js"></script>
    <!--Custom JavaScript -->
    <script src="js/custom.js"></script>
    <script type="text/javascript" src="./js/tabs.js"></script>
    <script src="https://kit.fontawesome.com/de41999cf3.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js"></script>

    <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>
    
    <script>
            $('#inventoryTable').DataTable({
                order: [[2,'asc']]
            });
    </script>
    <script>
            $('#orderTable').DataTable({
                order: [[1,'asc']]
            });
    </script>

    <style type="text/css">
        .icon-container a{
            margin: 10px;
        }
        .icon-container i:hover {
            transform: scale(1.5);
            color: blue;
        }
    </style>
</body>

</html>

<?php
} 
else{
    ?>
        <h1 align="center" style="color: red;">UNAUTHORIZED ACCESS, GET OUT!</h1>
    <?php
}

?>