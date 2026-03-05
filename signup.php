<?php
session_start();
// on login screen, redirect to dashboard if already logged in
if(isset($_SESSION['email'])){
    header("location:./marketplace");
}
?>

<!Doctype html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, shrink-to-fit=no, user-scalable=no">
    <meta name="handheldfriendly" content="yes">
    <meta name="description" content="Signup on Fx Broker Fund...">
    <meta name="keywords" content="signup, createaccount, account, create">
    <link rel="apple-touch-icon" sizes="180x180" href="apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="favicon-16x16.png">
    <meta name="theme-color" content="#234994" /> <!-- blue -->
    <link rel="manifest" href="site.webmanifest">
   
    <title>Signup FX Broker Fund</title>

    
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
								<h2>Welcome to FX Broker Fund</h2>
								<p>Already have an account?</p>
								<a href="login" class="btn btn-white btn-outline-white">Sign In</a>
							</div>
			      </div>
						<div class="login-wrap p-4 p-lg-5">
			      	<div class="d-flex">
			      		<div class="w-100">
			      			<h3 class="mb-4">Sign Up</h3>
			      		</div>
								<div class="w-100">
									<p class="social-media d-flex justify-content-end">
										<a href="#" class="social-icon d-flex align-items-center justify-content-center"><span class="fa fa-facebook"></span></a>
										<a href="#" class="social-icon d-flex align-items-center justify-content-center"><span class="fa fa-twitter"></span></a>
									</p>
								</div>
			      	</div>
			      	
						<form action="registration.php" method="POST" class="signin-form">
						    
						    <?php $unknownerror = array("unknownerror=true" => "<p style='color:red; margin-top:0px; margin-bottom:10px;'>Unknown error occured</p>"); 
                            if(isset($_GET['registerFailed'])) echo $unknownerror[$_GET['reason']]; ?>
						    
			      		<div class="form-group mb-3">
			      			<label class="label" for="name">Email</label>
			      			<input type="email" class="form-control" name="email" placeholder="Email*" required>
			      			
			      			<?php $InvalidEmailmsg = array("invalidemail=true" => "<p style='color:red; margin-top:0px; margin-bottom:10px;'>Invalid Email Address</p>"); 
                            if(isset($_GET['registerUnsuccessfulEmail'])) echo $InvalidEmailmsg[$_GET['reason']]; ?>
                            
                            <?php $InvalidEmailmsg = array("invalidemailexist=true" => "<span class='' style='color:red; margin-top:0px; margin-bottom:10px;'>
                            Email already exist. Please choose a different email</span>"); 
                            if(isset($_GET['registerUnsuccessfulEmailexist'])) echo $InvalidEmailmsg[$_GET['reason']]; ?>
			      		</div>
		            <div class="form-group mb-3">
		            	<label class="label" for="password">Password</label>
		              <input type="password" name="password" class="form-control" placeholder="Password*" required>
		                    <!-- RETURN PASSWORD ERROR MESSAGE IF ANY -->
                            <?php $InvalidPasswordmsg = array("invalidpasswordl=true" => "<span class='' style='color:red; margin-top:0px; margin-bottom:10px;'>
                            Password must contain 6 or more characters</span>" ); 
                            if(isset($_GET['registerUnsuccessfulPasswordl'])) echo $InvalidPasswordmsg[$_GET['reason']]; ?>
                            
                            <?php $InvalidPasswordmsg = array("emptypassword=true" => "<span class='' style='color:red; margin-top:0px; margin-bottom:10px;'>
                            Password must contain 6 or more characters</span>" ); 
                            if(isset($_GET['registerUnsuccessfulemptyPassword'])) echo $InvalidPasswordmsg[$_GET['reason']]; ?>
                            
                            <?php $InvalidPasswordmsg = array("unmatchedpasswordl=true" => "<span class='' style='color:red; margin-top:0px; margin-bottom:10px;'>
                            Password and Retype password must match</span>" ); 
                            if(isset($_GET['registerUnsuccessfulUnmatchedPassword'])) echo $InvalidPasswordmsg[$_GET['reason']]; ?>
		            </div>
		            <div class="form-group mb-3">
		            	<label class="label" for="password">Retype password</label>
		              <input type="password" name="cpassword" class="form-control" placeholder="Retype password*" required>
		            </div>
		            <div class="form-group">
		            	<button type="submit" name="submit" class="form-control btn btn-primary submit px-3">Sign Up</button>
		            </div>
		            <div class="form-group d-md-flex">
		            	<div class="w-50 text-left">
                        <label class="checkbox-wrap checkbox-primary mb-0">
                            By clicking "Sign Up" you agree to our <a href="terms">Terms of Service</a>
                            <input type="checkbox" checked disabled>
                            <span class="checkmark"></span>
                            </label>
                        </div>
                        <div class="w-50 text-md-right">
                        </div>
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

