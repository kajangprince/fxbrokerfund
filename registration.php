<?php 

//Import the PHPMailer class into the global namespace
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require "PHPMailer/src/Exception.php";
require "PHPMailer/src/PHPMailer.php";
require "PHPMailer/src/SMTP.php";

include_once("pdoconfig.php");

// check for valid email address
$email = strtolower($_POST['email']);
if(!filter_var($email, FILTER_VALIDATE_EMAIL)){	
	die(header("location:./signup?registerUnsuccessfulEmail=true&reason=invalidemail=true"));
	die();
}else{
	$email = strtolower($_POST['email']);	
}

if(empty($_POST['password'])){
    die(header("location:./signup?registerUnsuccessfulemptyPassword=true&reason=emptypassword=true"));
	die();
}

if ($_POST["password"] === $_POST["cpassword"]) {
   $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
}elseif(strlen($_POST['password'])<6){
	die(header("location:./signup?registerUnsuccessfulPasswordl=true&reason=invalidpasswordl=true"));
	die();
}else{
	die(header("location:./signup?registerUnsuccessfulUnmatchedPassword=true&reason=unmatchedpasswordl=true"));
	die();
}

$verification_code = substr(md5(uniqid(rand(),1)),3,30);


$error = false;
            if(!isset($password) || trim($password) == '') {
				die(header("location:./signup?registerFailedPassword=true&reason=empty_Passwordcredential=true"));
				die();
            $error = true;			
			}
			
			if(!isset($email) || trim($email) == '') {
				die(header("location:./signup?registerFailedEmail=true&reason=empty_Emailcredential=true"));
				die();
            $error = true;			
			}

			if(!$error){
                $sql = $con->prepare("SELECT email FROM users WHERE email = :email");
                $sql->execute(array('email' => $email));
                if($sql->rowCount() > 0){
                $row = $sql->fetch(PDO::FETCH_ASSOC);
                if($email==$row['email'])
                {
                    die(header("location:./signup?registerUnsuccessfulEmailexist=true&reason=invalidemailexist=true"));
                    die();
                }            
                }else{
                    
                    $reg1 = "INSERT INTO users(password, verification_code, email) 
                    VALUES(:password, :verification_code, :email)";
                   
                    $stmt = $con->prepare($reg1);
                    $stmt->bindParam(":password",$password);
                    $stmt->bindParam(":verification_code",$verification_code);
                    $stmt->bindParam(":email",$email);						
                    $stmt->execute();
                    
        
                    /**
                     * This example shows sending a message using a local sendmail binary.
                     */

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
                    <title>Fx Broker Fund Email Verification</title>
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
                      <h1 style='font-size: 48px; font-weight: 400; margin: 2;'>Welcome to Fx Broker Fund!</h1> 
                      <img src='https://www.fxbrokerfund.com/images/android-chrome-512x512.png' width='125' height='120' style='display: block; border: 0px; margin : 30px 20px 20px 20px' /> 
                      </td> </tr> </table> </td> </tr> <tr> 
                      <td bgcolor='#F8F9FD' align='center' style='padding: 0px 10px 0px 10px;'> <table border='0' cellpadding='0' cellspacing='0' width='100%' style='max-width: 600px;'> 
                      <tr> <td bgcolor='#F8F9FD' align='left' style='padding: 20px 30px 40px 30px; color: #ffffff; font-family: 'Lato', Helvetica, Arial, sans-serif; font-size: 18px; font-weight: 400; line-height: 25px;'> 
                      <p style='margin: 0;'>Thank you for choosing Fx Broker Fund. First, help us verify your email by clicking on the below button.</p> </td> </tr> 
                      <tr> <td bgcolor='#F8F9FD' align='left'> <table width='100%' border='0' cellspacing='0' cellpadding='0'> <tr> 
                      <td bgcolor='#F8F9FD' align='center' style='padding: 20px 30px 60px 30px;'> 
                      <table border='0' cellspacing='0' cellpadding='0'> 
                      <tr> <td align='center' style='border-radius: 20px;' bgcolor='#244A95'>
                      <a href='https://www.fxbrokerfund.com/confirm-email?vkey=$verification_code' style='font-size: 20px; font-family: Helvetica, Arial, sans-serif; color: #000; text-decoration: none; padding: 15px 25px; border-radius: 20px; border: 1px solid #244A95; display: inline-block;'>Verify email</a></td> </tr> </table> </td> </tr> </table> </td> </tr> 
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
                    $mail->Subject = "Fx Broker Fund Email Verification";
                    //Read an HTML message body from an external file, convert referenced images to embedded,
                    //convert HTML into a basic plain-text alternative body
                    //$mail->msgHTML(file_get_contents("email-content.html"), __DIR__);
                    //Replace the plain text body with one created manually
                    $mail->AltBody = "Thank you for choosing Fx Broker Fund. First, help us verify your email by clicking on the below button.";
                    //Attach an image file
                    //send the message, check for errors
                    if (!$mail->send()) {
                        die(header("location:./signup?registerFailed=true&reason=unknownerror=true"));
                        die();
                    } else {
                        die(header("location:./login?registerationSuccessful=true&reason=successfullyregistered=true"));
                        die();
                        $con = null;
                    }                   
                }
            }

?>