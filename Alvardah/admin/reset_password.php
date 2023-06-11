<?php
      require_once 'loginCheck.php';
      require_once './phpStuff/coreFunctions.php';
      require_once './phpStuff/telegramAPI.php';
?>

<?php
      if (isset($_POST['generateOTP'])) {

      
           $otp_text = generateRandomNumber();  


           $_SESSION['otpTEXT'] = $otp_text;    

            $subject = 'Password Reset';
            $message = 'Your One Time Password to reset the passoword of Alvardah admin panel is: ' . $otp_text;
            mailAdmin($subject, $message);
            
            
            $msg = 'OTP for Alvardah admin panel is: ' . $otp_text;
            sendTelegramMessage($chatid, $msg , $token);

            $_SESSION['message'] = 'OTP Sent! Please check your inbox.';
      }
?>


<?php

      if (isset($_POST['checkOTP'])) {
            
            $enteredOTP = $_POST['enteredOTP'];

            if ($enteredOTP == $_SESSION['otpTEXT']) {
                  unset($_SESSION['otpTEXT']);

                  $_SESSION['resetPassword'] = true;
                  redirectTo('update_password.php');
            }
            else {

                  redirectTo('reset_password.php');

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

            <title>Reset Password - Alvardah</title>
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
                  
                  <section style="display: flex;flex-direction: column;" class="form">
                  <form action="?" method="POST" autocomplete="off">


                        <h2 class="alert alert-success" align="center">Reset Password</h2><br/>

                        <p class="text-center d-inline-flex p-2">
                                    Click on 'Send OTP' button in order to receive the OTP via mail and telegram, enter it below to continue.
                        </p>
                              <?php 
                                    if (isset($_SESSION['message'])) {
                                          echo  "<center><i class='fas fa-exclamation-circle'></i> " . $_SESSION['message'] . "</center><br>";
                                          unset($_SESSION['message']);
                                    }
                              ?>
                        <button name="generateOTP" type="submit" class="mb-3 row btn btn-warning text-white form-control">Send OTP</button>
                        <br>
                              <br>
                        </form>
                        <form method="POST" action="?" autocomplete="off" >
                        <div class="mb-3 row">

                              <i class="far fa-comment"></i>
                              <input name="enteredOTP" type="number" class="form-control" placeholder="Enter OTP" onKeyDown="limitText(this,6);" onKeyUp="limitText(this,6);">

                              
                        </div>
                        <br>
                        <button name="checkOTP" type="submit" class="mb-3 row btn btn-success form-control">ENTER</button>
                  </form>
                  </section>
            </div>
      
      <script src="https://kit.fontawesome.com/de41999cf3.js"></script>

      <script language="javascript" type="text/javascript">
            function limitText(limitField, limitNum) {
                if (limitField.value.length > limitNum) {
                    limitField.value = limitField.value.substring(0, limitNum);
                }
            }
      </script>
      </body>
