<?php
      include_once 'loginCheck.php';
      include_once './phpStuff/coreFunctions.php';
      include_once './phpStuff/telegramAPI.php';

      if (isset($_SESSION['resetPassword']) == true) {

            if (isset($_POST['updatePass'])) {
                  
                  $password_1 = $_POST['password_1'];
                  $password_2 = $_POST['password_2'];

                  if ($password_1 == $password_2) {
                        
                        $password = $password_2;

                        if (updateAdminPassword($password) == true) {
                              $_SESSION['message'] = "Password Changed!";
                              redirectTo('index.php');
                        }
                        else{
                              $_SESSION['message'] = "Password Couldn't Be Changed!";
                              redirectTo('reset_password.php');
                        }

                  }

                  else {
                        $_SESSION['alertTxt'] = "Passwords Don't Match!";
                  }
            }

?>



<!DOCTYPE html>
<html lang="en">
      <head>
            <!-- basic -->
            <meta charset="utf-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            
            <!-- mobile metas -->
            <meta name="viewport" content="width=device-width, initial-scale=1">
            <meta name="viewport" content="initial-scale=1, maximum-scale=1">

            <title>Update Password - Alvardah</title>
            <link rel="icon" href="favicon.png" type="image/x-icon">
            <link rel="stylesheet" type="text/css" href="./bootstrap/dist/css/bootstrap.min.css">

      
      <style type="text/css">


            img[alt="www.000webhost.com"] {
                  display: none;
            }
      
            body {
                  background-image: url(./pix/bg-light.jpg);
            }

            .form-container {
                  display: flex; 
                  justify-content: center;
                  align-items: center; 
                  height: 100vh; 
                  width: 100vw;
            }

            .form {
                  background: #f1f1f1;
                  box-shadow: 3px 3px 3px grey;
                  border-radius: 30px;
                  overflow: hidden;
                  padding: 40px;
                  width: 65%;
            }


            .row input {
                  width:90%;
            }
            .row i {
                  font-size:30px;
                  padding: 5px;
                  float: left;
            }

            .forgot-password {
                  color: #0275d8;
                  text-decoration: underline;
                  cursor: pointer;
            }

            @media only screen and (max-width: 768px){

                  .row input {
                        width:60%;
                  }

                  .form {
                  background: #f1f1f1;
                  box-shadow: 3px 3px 3px grey;
                  border-radius: 30px;
                  overflow: hidden;
                  padding: 40px;
                  width: 95%;
                  }

                  .row i {
                  font-size:30px;
                  padding: 5px;
                  float: left;
                  margin-right: 10px;
                  }
            }

      </style>

      </head>

      <body class="bg-light" >
            <div class="container form-container">      
                  
                  <form class="form" action="?" method="POST" autocomplete="off">


                        <h2 class="alert alert-success" align="center">Update Password</h2><br/>

                              <?php
                                    if (isset($_SESSION['alertTxt'])) {
                                          echo '<br><h3 align=center>'.$_SESSION['alertTxt'].'</h3><br>';
                                          unset($_SESSION['alertTxt']);
                                    }
                              ?>

                        <div class="input-group">
                              <input type="text" name="password_1" class="form-control" placeholder="Enter New Paassword" required onblur="limitText(this, 8);">
                        </div>
                        <br>
                        <div class="input-group">
                              <input type="text" name="password_2" class="form-control" placeholder="Re-Enter New Password" required onblur="limitText(this, 8);">
                        </div><br>
                        <div class="input-group">
                              <button class="btn btn-success container-fluid" type="submit" name="updatePass"> Update Password</button>
                        </div>

                        
                  </form>
            </div>
      
      <script src="https://kit.fontawesome.com/de41999cf3.js"></script>
      </body>

      <script language="javascript" type="text/javascript">
            function limitText(limitField, limitNum) {
                if (limitField.value.length < limitNum) {
                    alert("Password Too Short!");
                }
            }
      </script>

<?php
      }
      else {
    ?>
        <h1 align="center" style="color: red;">UNAUTHORIZED ACCESS, GET OUT!</h1>
    <?php
}
?>