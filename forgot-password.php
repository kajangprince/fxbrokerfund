<!Doctype html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, shrink-to-fit=no, user-scalable=no">
    <meta name="handheldfriendly" content="yes">
    <meta name="description" content="forgot password, request for reset password link...">
    <meta name="keywords" content="forgot, password, rest, link, send, FX, Broker, Fund">
    <link rel="apple-touch-icon" sizes="180x180" href="images/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="images/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="images/favicon-16x16.png">
    <link rel="manifest" href="assets/images/site.webmanifest">
   
    <title>FXBF Forgot Password</title>

    
	<link href="https://fonts.googleapis.com/css?family=Lato:300,400,700,900&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <link rel="stylesheet" href="css/signup-loginstyle.css">

    </head>
	<body>
	<section class="ftco-section">
		<div class="container" style="margin-top:-50px">
			<div class="row justify-content-center">
				<div class="col-md-12 col-lg-10">
					<div class="wrap d-md-flex">
						<div class="text-wrap p-4 p-lg-5 text-center d-flex align-items-center order-md-last">
							<div class="text w-100">
								<h2>Forgot Password</h2>
								<p>Remembered password?</p>
								<a href="login" class="btn btn-white btn-outline-white">Login</a>
							</div>
			          </div>
			          
			 <?php

              //error_reporting(0);
              //Import the PHPMailer class into the global namespace
              use PHPMailer\PHPMailer\PHPMailer;
              use PHPMailer\PHPMailer\Exception;
            
              require "PHPMailer/src/Exception.php";
              require "PHPMailer/src/PHPMailer.php";
              require "PHPMailer/src/SMTP.php";

              include("config.php");

              //This code runs if the form has been submitted
              if (isset($_POST['submit']))
              {
              
              // check for valid email address
              $email = mysqli_real_escape_string($con,$_POST['email']);
              if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
                  $invalid_email = "<div class='' style='font-size:15px;color:red;font-family:monospace;'>Enter a valid email address</div>";
              }
              
              // checks if the email is in use
              $check = mysqli_query($con,"SELECT email FROM users WHERE email = '$email' LIMIT 1");
              $check2 =$check->num_rows;

              mysqli_real_escape_string($con,$email);
              
              
              //if the name exists it gives an error
              if ($check2 == 0) {
                $errormsg = "<div class='' style='font-size:15px;color:red;font-family:monospace;'>You will receive a reset link if this email exist in our system</div>";
              }else{
                //$successmsg = "<div class='' style='font-size:15px;color:green;font-family:monospace;'>A reset link has been sent to $email</div>";
                $resettoken = substr(md5(uniqid(rand(),1)),3,30);
                $pass = ($resettoken); //encrypted version for database entry
                //insert resettoken code to db column 
                $insert = mysqli_query($con,"UPDATE users SET resettoken = '$resettoken' WHERE email = '$email' LIMIT 1"); 
                {
                    //Create a new PHPMailer instance
                    $mail = new PHPMailer();
                    //Set PHPMailer to use the sendmail transport
                    $mail->isSendmail();
                    //Set who the message is to be sent from
                    $mail->setFrom("support@fxbrokerfund.com", "Fx Broker Fund");
                    //Set an alternative reply-to address
                    $mail->addReplyTo("noreply@fxbrokerfund.com", "Fx Broker Fund");
                    //Set who the message is to be sent to
                    $mail->addAddress("$email", "");
                    $body = "<!DOCTYPE html>
                    <head>
                    <meta charset='utf-8'>
                    <meta name='viewport' content='width=device-width, initial-scale=1'>
                    <title>Fx Broker Fund Password Recovery</title>
                    <link href='https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css' rel='stylesheet'>
                    <script type='text/javascript' src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js'></script>
                    <meta http-equiv='Content-Type' content='text/html; charset=utf-8' /> 
                    <meta name='viewport' content='width=device-width, initial-scale=1'> 
                    <meta http-equiv='X-UA-Compatible' content='IE=edge' /> 
                    <style type='text/css'> 
                        @media screen { 
                        @font-face { 
                        font-family: 'Lato'; 
                        font-style: normal; 
                        font-weight: 400; 
                        src: local('Lato Regular'), local('Lato-Regular'),
                        url(https://fonts.gstatic.com/s/lato/v11/qIIYRU-oROkIk8vfvxw6QvesZW2xOQ-xsNqO47m55DA.woff) 
                        format('woff'); } @font-face { font-family: 'Lato'; font-style: normal; font-weight: 700; 
                        src: local('Lato Bold'), local('Lato-Bold'), 
                        url(https://fonts.gstatic.com/s/lato/v11/qdgUG4U09HnJwhYI-uK18wLUuEpTyoUstqEm5AMlJo4.woff) 
                        format('woff'); } @font-face { font-family: 'Lato'; font-style: italic; font-weight: 400; 
                        src: local('Lato Italic'), local('Lato-Italic'),
                        url(https://fonts.gstatic.com/s/lato/v11/RYyZNoeFgb0l7W3Vu1aSWOvvDin1pK8aKteLpeZ5c0A.woff) 
                        format('woff'); } @font-face { font-family: 'Lato'; font-style: italic; font-weight: 700; 
                        src: local('Lato Bold Italic'), local('Lato-BoldItalic'), 
                        url(https://fonts.gstatic.com/s/lato/v11/HkF_qI1x_noxlxhrhMQYELO3LdcAZYWl9Si6vvxL-qU.woff) format('woff'); } }                
                    
                        ::-webkit-scrollbar {
                          width: 8px;
                        }

                        ::-webkit-scrollbar-track {
                          background: #f1f1f1; 
                        }
                    
                        ::-webkit-scrollbar-thumb {
                          background: #888; 
                        }
                    
                        ::-webkit-scrollbar-thumb:hover {
                          background: #555; 
                        } 
                    </style>
                    </head>
                    
                    <body className='snippet-body' style='background-color: #F8F9FD; margin: 0 !important; padding: 0 !important;'> <!-- HIDDEN PREHEADER TEXT -->  
                      <table border='0' cellpadding='0' cellspacing='0' width='100%'> <!-- LOGO --> 
                      <tr> <td bgcolor='#F8F9FD' align='center'> 
                      <table border='0' cellpadding='0' cellspacing='0' width='100%' style='max-width: 600px;'> 
                      <tr> <td align='center' valign='top' style='padding: 40px 10px 40px 10px;'> </td> </tr> 
                      </table> </td> </tr> <tr> <td bgcolor='#F8F9FD' align='center' style='padding: 0px 10px 0px 10px;'> 
                      <table border='0' cellpadding='0' cellspacing='0' width='100%' style='max-width: 600px;'> 
                      <tr> <td bgcolor='#F8F9FD' align='center' valign='top' style='padding: 40px 20px 20px 20px; border-radius: 4px 4px 0px 0px; color: #ffffff; font-family: 'Lato', Helvetica, Arial, sans-serif; font-size: 48px; font-weight: 400; line-height: 48px;'> 
                      <h1 style='font-size: 48px; font-weight: 400; margin: 2;'>Password Reset Instructions!</h1> 
                      <img src='https://www.fxbrokerfund.com/images/android-chrome-512x512.png' width='125' height='120' style='display: block; border: 0px; margin : 30px 20px 20px 20px' /> 
                      </td> </tr> </table> </td> </tr> <tr> 
                      <td bgcolor='#F8F9FD' align='center' style='padding: 0px 10px 0px 10px;'> <table border='0' cellpadding='0' cellspacing='0' width='100%' style='max-width: 600px;'> 
                      <tr> <td bgcolor='#F8F9FD' align='left' style='padding: 20px 30px 40px 30px; color: #ffffff; font-family: 'Lato', Helvetica, Arial, sans-serif; font-size: 18px; font-weight: 400; line-height: 25px;'> 
                      <p style='margin: 0;'>You or someone else have requested for your password and your password reset token is <span class='' style='color:#008000;'><b>$resettoken</b></span></p><br>
                      Copy and paste the reset token on the change password first input field following the link below &#128071;</td> </tr> 
                      <tr> <td bgcolor='#F8F9FD' align='left'> <table width='100%' border='0' cellspacing='0' cellpadding='0'> <tr> 
                      <td bgcolor='#F8F9FD' align='center' style='padding: 20px 30px 60px 30px;'> 
                      <table border='0' cellspacing='0' cellpadding='0'> 
                      <tr> <td align='center' style='border-radius: 20px;' bgcolor='#244A95'>
                      <a href='https://www.fxbrokerfund.com/passwordresettoken?resettoken=$pass' style='font-size: 20px; font-family: Helvetica, Arial, sans-serif; color: #000; text-decoration: none; padding: 15px 25px; border-radius: 20px; border: 1px solid #244A95; display: inline-block;'>Reset Password</a></td> </tr> </table> </td> </tr> </table> </td> </tr> 
                      <tr> <td bgcolor='#F8F9FD' align='left' style='padding: 0px 30px 20px 30px; color: #ffffff; font-family: 'Lato', Helvetica, Arial, sans-serif; font-size: 18px; font-weight: 400; line-height: 25px;'> 
                      <p style='margin: 0;'>This is an auto-generated email. Please <b>do not</b> reply to this email.</p> </td> </tr> 
                      <tr> <td bgcolor='#F8F9FD' align='left' style='padding: 0px 30px 40px 30px; border-radius: 0px 0px 4px 4px; color: #ffffff; font-family: 'Lato', Helvetica, Arial, sans-serif; font-size: 18px; font-weight: 400; line-height: 25px;'> 
                      <p style='margin: 0;'>Cheers,<br>Fx Broker Fund Team</p> </td> </tr> </table> </td> </tr> 
                      <tr> <td bgcolor='#F8F9FD' align='center' style='padding: 30px 10px 0px 10px;'> 
                      <table border='0' cellpadding='0' cellspacing='0' width='100%' style='max-width: 600px;'> 
                    
                    </body>
                    </html>";
                    $mail->MsgHTML($body);
                    //Set the subject line
                    $mail->Subject = "Fx Broker Fund Password Recovery";
                    $mail->AltBody = "You or someone else have requested for your password";
                    //Attach an image file
                    //send the message, check for errors
                    if ($mail->send()) {
                        $successmsg = "<div class='' style='font-size:15px;color:green;font-family:monospace;'>A reset link has been sent to $email</div>";
                    } else {
                        $errormsg = "<div class='' style='font-size:15px;color:red;font-family:monospace;'>Oops! An unknown error occured</div>";
                    } 
                   }
              }
                 }
          ?>

			          
				<div class="login-wrap p-4 p-lg-5">
			      	<div class="d-flex">
			      		<div class="w-100">
			      		    
            			  <!-- Not found in db error message -->
                          <?php if(isset($errormsg)){ echo $errormsg; }else{ echo "";} ?>
            
                          <!-- Invalid email message -->
                          <?php if(isset($invalid_email)){ echo $invalid_email; }else{ echo "";} ?>
            
                          <!-- success message -->
                          <?php if(isset($successmsg )){ echo $successmsg ; }else{ echo "";} ?>  
              
			      			<span class="mb-4">Enter your email and we'll send you instructions to reset your password.</span>
			      		</div>
			        </div>
			      	
					<form action="" method="POST" class="signin-form">
			      		<div class="form-group mb-3">
			      			<label class="label" for="name">Email</label>
			      			<input type="email" class="form-control" name="email" placeholder="Email" >
			      		</div>
		            <div class="form-group">
		            	<button type="submit" name="submit" class="form-control btn btn-primary submit px-3">Get Reset Link</button>
		            </div>
		          </form>
		        </div>
		      </div>
				</div>
			</div>
		</div>
	</section>

	<script src="js/jquery.min.js"></script>
  <script src="js/popper.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/main.js"></script>

	</body>
</html>

