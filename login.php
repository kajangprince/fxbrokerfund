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
    <meta name="description" content="Login to access FX Broker Fund marketplace...">
    <meta name="keywords" content="login, access, panel, signin, FXBF signin, sign, in">
    <link rel="apple-touch-icon" sizes="180x180" href="apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="favicon-16x16.png">
    <link rel="manifest" href="site.webmanifest">
    <link rel="shortcut icon" type="image/png" href="assets/images/favicon.png"> 
    <meta name="theme-color" content="#234994" /> <!-- blue -->
    <title>Logon to FX Broker Fund MarketPlace</title>
    
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
								<p>Don't have an account?</p>
								<a href="signup" class="btn btn-white btn-outline-white">Sign Up</a>
							</div>
			      </div>
						<div class="login-wrap p-4 p-lg-5">
			      	<div class="d-flex">
			      		<div class="w-100">
			      			<h3 class="mb-4">Sign in</h3>
			      		</div>
						<div class="w-100">
							<p class="social-media d-flex justify-content-end">
								<a href="#" class="social-icon d-flex align-items-center justify-content-center"><span class="fa fa-facebook"></span></a>
								<a href="#" class="social-icon d-flex align-items-center justify-content-center"><span class="fa fa-twitter"></span></a>
							</p>
						</div>
			        </div>
			      	
					<form action="validation.php" method="POST" class="signin-form">
					    
					    <!-- SHOW registeration SUCCESSFUL MESSAGE -->
                        <?php $registerationsuccessfulmsg = array("successfullyregistered=true" => 
                        "<div style='color: #3c763d;background-color: #dff0d8; border-color: #d6e9c6; padding: 15px; margin-top:-20px; border: 1px solid transparent; border-radius: 4px;'>                        
                        <a href='#' style='text-decoration: none; float: right; font-size: 21px; font-weight: 700; line-height: 1; color: #000; text-shadow: 0 1px 0 #fff; filter: alpha(opacity=20); opacity: .2;' data-dismiss='alert' aria-label='close'>&times;</a>
                        <strong>Verify!</strong> Help us verify your email, a link has been sent to you.<br></div>" );                        
                        if(isset($_GET['registerationSuccessful'])) echo $registerationsuccessfulmsg[$_GET['reason']]; ?>
                        
                        <!--<form method="POST" class="register-form" name="frmChange" onSubmit="return validateForm()" id="login-form">-->
                        <?php $reason = array("wrong_logincredentials=true" => "<p style='color:red; margin-top: -30px; margin-bottom: -5px;'>wrong email or password!</p>"); 
                        if(isset($_GET['loginFailed'])) echo $reason[$_GET['reason']]; ?>
                        
			      		<div class="form-group mb-3">
			      			<label class="label" for="name">Email</label>
			      			<input type="email" class="form-control" name="email" placeholder="Email" >
			      		</div>
		            <div class="form-group mb-3">
		            	<label class="label" for="password">Password</label>
		              <input type="password" name="password" class="form-control" placeholder="Password" >
		            </div>
		            <div class="form-group">
		            	<button type="submit" name="login" class="form-control btn btn-primary submit px-3">Sign In</button>
		            </div>
		            <div class="form-group d-md-flex">
		            	<div class="w-50 text-left">
                        <label class="checkbox-wrap checkbox-primary mb-0">Remember Me
                            <input type="checkbox" checked>
                            <span class="checkmark"></span>
                            </label>
                        </div>
                        <div class="w-50 text-md-right">
                            <a href="forgot-password">Forgot Password</a>
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

