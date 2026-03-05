<!Doctype html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, shrink-to-fit=no, user-scalable=no">
    <meta name="handheldfriendly" content="yes">
    <meta name="description" content="Login to access GCL Auto Parts marketplace...">
    <meta name="keywords" content="login, access, panel, signin, gcl signin, sign, in">
    <link rel="apple-touch-icon" sizes="180x180" href="apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="favicon-16x16.png">
    <link rel="manifest" href="site.webmanifest">
   
    <title>Password Reset</title>

    
	<link href="https://fonts.googleapis.com/css?family=Lato:300,400,700,900&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <link rel="stylesheet" href="css/signup-loginstyle.css">

    </head>
	<body>
	    
     <?php
    
    	include("config.php");
    
    	if(isset($_POST['submit'])){
    	$email = $_POST['email'];
    	$password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    	if ($_POST["password"] === $_POST["cpassword"]) {
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    	}else{
    	   $unmatchedPasswordError = "<div class='' style='font-size:15px;color:red;font-family:monospace;'>New and Retype password must match</div>";
    	}
    
    	$resettoken = $_POST['resettoken'];
        $sql = mysqli_query($con,"SELECT email,resettoken FROM users WHERE email = '$email' AND resettoken = '$resettoken' LIMIT 1");
        $row = mysqli_num_rows($sql);
        if($row == 1){
            $null = NULL;
            $insert = mysqli_query($con,"UPDATE users SET password = '$password',resettoken = '$null' WHERE email = '$email' LIMIT 1"); 
            
            $successmsg = "<div class='' style='font-size:15px;color:green;font-family:monospace;'>Password Changed</div>";
        }else{
            $errormsg = "<div class='' style='font-size:15px;color:red;font-family:monospace;'>Failed to update password</div>";
        }
    	}
    ?>	    
	    
	<section class="ftco-section">
		<div class="container" style="margin-top:-50px">
			<div class="row justify-content-center">
				<div class="col-md-12 col-lg-10">
					<div class="wrap d-md-flex">
						<div class="text-wrap p-4 p-lg-5 text-center d-flex align-items-center order-md-last">
							<div class="text w-100">
								<p>Password Reset! &#128274;</</p>
							</div>
			            </div>
						<div class="login-wrap p-4 p-lg-5">
				     	<form action="" method="POST" class="signin-form">
				     	    
                        <!-- Failed to update password error message -->
                        <?php if(isset($errormsg)){ echo $errormsg; }else{ echo "";} ?>
                        
                        <!-- unmatched passwords error message -->
                        <?php if(isset($unmatchedPasswordError)){ echo $unmatchedPasswordError; }else{ echo "";} ?>
                        
                        <!-- unmatched passwords error message -->
                        <?php if(isset($successmsg)){ echo $successmsg; }else{ echo "";} ?>
                        
			      		<div class="form-group mb-3">
			      			<label class="label" for="name">Reset Token</label>
			      			<input type="text" class="form-control" name="resettoken" placeholder="Reset Token" >
			      		</div>
			      		<div class="form-group mb-3">
			      			<label class="label" for="name">Email</label>
			      			<input type="email" class="form-control" name="email" placeholder="Email" >
			      		</div>
		            <div class="form-group mb-3">
		            	<label class="label" for="password">New Password</label>
		              <input type="password" name="password" class="form-control" pattern=".{6,}" title="Choose 6 or more characters" 
                      placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;">
                      <?php if(isset($new_password_match_with_old)) { echo $new_password_match_with_old; } ?>
                     <?php if(isset($passtooshortmessage)) { echo $passtooshortmessage; } ?>
		            </div>
		            <div class="form-group mb-3">
		              <label class="label" for="password">Retype Password</label>
		              <input type="password" name="cpassword" pattern=".{6,}" title="Please retype your password" 
                      placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" class="form-control" >
		            </div>
		            <div class="form-group">
		            	<button type="submit" name="submit" class="form-control btn btn-primary submit px-3">Change password</button>
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

