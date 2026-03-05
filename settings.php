<?php
session_start();
if(!isset($_SESSION['email'])){
	header("location:./login");
}
?>

<?php 

function escape($string){
   return htmlspecialchars($string, ENT_QUOTES, 'UTF-8');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, shrink-to-fit=no, user-scalable=no">
  <meta name="handheldfriendly" content="yes">
  <link rel="apple-touch-icon" sizes="180x180" href="images/apple-touch-icon.png">
  <link rel="icon" type="image/png" sizes="32x32" href="images/favicon-32x32.png">
  <link rel="icon" type="image/png" sizes="16x16" href="images/favicon-16x16.png">
  <link rel="manifest" href="/site.webmanifest">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <title>Account settings</title>
  <!-- plugins:css -->
  <link rel="stylesheet" href="vendors/ti-icons/css/themify-icons.css">
  <link rel="stylesheet" href="vendors/base/vendor.bundle.base.css">
  <!-- endinject -->
  <!-- plugin css for this page -->
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <link rel="stylesheet" href="css/style.css">
  <!-- endinject -->
  <link rel="shortcut icon" href="images/favicon.png" />

  <style>
  /* JS moving horizontal text */
    div.marquee {
      white-space:no-wrap;
      overflow:hidden;
      margin-top:-20px;      
    }
    div.marquee > div.marquee-text {
        white-space:nowrap;
        display:inline;
        width:auto;
        background-color:#FD7E14;
        color:#fff;
        font-size:20px;
    }
  </style>

</head>

<body>

    <!-- partial:partials/_navbar.html -->
    <nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
      <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
        <a class="navbar-brand brand-logo me-5" href="dashboard"><img src="images/logo.png" class="me-2" alt="logo"/></a>
        <a class="navbar-brand brand-logo-mini" href="dashboard"><img src="images/logo.png" alt="logo"/></a>
      </div>
      <div class="navbar-menu-wrapper d-flex align-items-center justify-content-end">
        <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
          <span class="ti-view-list"></span>
        </button>
        <ul class="navbar-nav mr-lg-2">
          <li class="nav-item nav-search d-none d-lg-block">
            <div class="input-group">
              <div class="input-group-prepend hover-cursor" id="navbar-search-icon">
                <span class="input-group-text" id="search">
                  <i class="ti-search"></i>
                </span>
              </div>
              <input type="text" class="form-control" id="navbar-search-input" placeholder="Search now" aria-label="search" aria-describedby="search">
            </div>
          </li>
        </ul>
        <ul class="navbar-nav navbar-nav-right">
          <li class="nav-item dropdown me-1">
            <a class="nav-link count-indicator dropdown-toggle d-flex justify-content-center align-items-center" id="messageDropdown" href="#" data-bs-toggle="dropdown">
              <i class="ti-email mx-0"></i>
            </a>
            <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="messageDropdown">
              <p class="mb-0 font-weight-normal float-left dropdown-header">Messages</p>
              <a class="dropdown-item">
                <div class="item-thumbnail">
                    <img src="images/faces/face4.jpg" alt="image" class="profile-pic">
                </div>
                <div class="item-content flex-grow">
                  <h6 class="ellipsis font-weight-normal">Active Coding FX Trading Bot</h6>
                  <p class="font-weight-light small-text text-muted mb-0">
                    This feature is not available in your location
                  </p>
                </div>
              </a>    
            </div>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link count-indicator dropdown-toggle" id="notificationDropdown" href="#" data-bs-toggle="dropdown">
              <i class="ti-bell mx-0"></i>
              <span class="count"></span>
            </a>
            <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="notificationDropdown">
              <p class="mb-0 font-weight-normal float-left dropdown-header">Notifications</p>

                <!-- Fetch user data from notifications table -->
                <?php
                
                include_once("pdoconfig.php");

                $email = $_SESSION['email'];
                $unread = "unread";

                $stmt = $con->prepare("SELECT id,user_email,message,created_at FROM notifications WHERE user_email = :user_email AND status = :unread ORDER BY id DESC");
                $stmt->execute(array('user_email' => $email , 'unread' => $unread));
                while($row = $stmt->fetch(PDO::FETCH_ASSOC))
                {
                $Validate_id = $row['id'];
                $id = escape($Validate_id);

                $Validate_message = $row['message'];
                $message = escape($Validate_message);

                $time = $row['created_at'];	
                $timestamp = strtotime($time);
                $formatted_time = date('d F Y', $timestamp);

                echo "<a class='dropdown-item'>
                <div class='item-thumbnail'>
                  <div class='item-icon bg-success'>
                    <i class='ti-bell mx-0'></i>
                  </div>
                </div>
                
                <div class='item-content'>
                <h6 class='font-weight-normal'>$message</h6>
                <p class='font-weight-light small-text mb-0 text-muted'>
                $formatted_time
                </p>
                </div>
                </a>";

                }

                ?>

            </div>
          </li>
          <li class="nav-item nav-profile dropdown">
            <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown" id="profileDropdown">
              <img src="images/faces/face28.jpg" alt="profile"/>
            </a>
            <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="profileDropdown">
              <a href="settings" class="dropdown-item">
                <i class="ti-settings text-primary"></i>
                Settings
              </a>
              <a href="logout" class="dropdown-item">
                <i class="ti-power-off text-primary"></i>
                Logout
              </a>
            </div>
          </li>
        </ul>
        <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
          <span class="ti-view-list"></span>
        </button>
      </div>
    </nav>
    <!-- partial -->
    <div class="container-fluid page-body-wrapper">
      <!-- partial:partials/_sidebar.html -->
      <nav class="sidebar sidebar-offcanvas" id="sidebar">
        <ul class="nav">
          <li class="nav-item">
            <a class="nav-link" href="dashboard">
              <i class="ti-home menu-icon"></i>
              <span class="menu-title">Dashboard</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
              <i class="ti-wallet menu-icon"></i>
              <span class="menu-title">Cashier</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="ui-basic">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"> <a class="nav-link" href="tradingplan">Buy Plan</a></li>
                <li class="nav-item"> <a class="nav-link" href="withdrawal">Withdrawal</a></li>
              </ul>
            </div>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="trading-activity">
              <i class="ti-layout-list-post menu-icon"></i>
              <span class="menu-title">Activity</span>
            </a>
          </li>
          <li class="nav-item active">
            <a class="nav-link" data-bs-toggle="collapse" href="#auth" aria-expanded="false" aria-controls="auth">
              <i class="ti-user menu-icon"></i>
              <span class="menu-title">My Profile</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="auth">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"> <a class="nav-link" href="personal-details"> Personal details </a></li>
                <li class="nav-item"> <a class="nav-link" href="verification"> Verification </a></li>
              </ul>
            </div>
          </li>
          <li class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="#auth" aria-expanded="false" aria-controls="auth">
              <i class="ti-lock menu-icon"></i>
              <span class="menu-title">Authentications</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="auth">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"> <a class="nav-link" href="change-password"> Change password </a></li>
                <li class="nav-item"> <a class="nav-link" href="forgot-password"> Reset password </a></li>
              </ul>
            </div>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="documentation">
              <i class="ti-write menu-icon"></i>
              <span class="menu-title">Documentation</span>
            </a>
          </li>
        </ul>
      </nav>
      <!-- partial -->

        

      <div class="main-panel">        
        <div class="content-wrapper">
          <div class="row">                  
            <div class="col-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">                 
                  <h4 class="card-title">Account settings</h4>
                  

                <?php

                // FETCH USER EMAIL ACTIVE STATUS TO SEE IF VERIFIED OR NOT
                $not_active = "0";
                $sql = $con->prepare("SELECT is_verified FROM users WHERE email = :email LIMIT 1");
                $sql->execute(array('email' => $email));
                if($sql->rowCount() > 0){
                $row = $sql->fetch(PDO::FETCH_ASSOC);
                if ($row['is_verified']==$not_active)
                {                   
                    echo"<div class='alert alert-danger' title='Not verified'>
                    $email <i class='fa fa-times-circle' title='Not verified'></i>
                    <a href='settings?confirm=$id'><button class='btn btn-primary'>Request for verification link</button></a>
                    </div>";  
                }else{
                    echo"<div class='alert alert-info' title='Verified'>Email: $email <i class='fa fa-check' title='Verified' style='color:green; font-size:13px'></i></div>";
                }
                }

                ?>
                
                <?php

                //SEND NEW VERIFICATION LINK TO CLIENT

                if(isset($_GET["confirm"])){
                    
                $id = $_GET["confirm"];

                $result = $con->prepare("SELECT is_verified,email,verification_code FROM users WHERE email = :email");
                $result->execute(array('email' => $email));
                while($row = $result->fetch(PDO::FETCH_ASSOC))
                {
                    $active_email = $row['is_verified'];	
                    $email = $row['email'];		
                    $vkey = $row['verification_code'];

                    $email = "$email";
                    $message = '<html><body>';			
                    $message .= '<div class="image" style="text-align:center; display:block;"><img src="www.activecodefxtrading.com/images/acftlogo.png" alt="ACFT Logo" /></div>';
                    $message .= '<table rules="all" style="border-color: #666;" cellpadding="10">';
                    $message .= "<tr style='background: #eee; font-size:18px'><td><strong>Verify your email</strong> </td></tr>";
                    $message .= "<tr style='font-size:16px'><td>Help us verify your email by clicking on the below button.<br><br>";			
                    $message .= "<div class='button' style='text-align:center; display:block;'><a href='https://www.activecodefxtrading.com/confirm-email?vkey=$vkey'><button class='button' style='background-color:mediumblue; border:none; border-radius:15px; color:white; padding:15px 32px; text-decoration:none; outline:none; font-size:16px;'>verify your email</button></a> <br><br>";
                    $message .= " or copy and paste the link below in your browser <br><br> https://www.activecodefxtrading.com/confirm-email?vkey=$vkey</div></td></tr>";
                    $message .= "</table>";
                    $message .= "</body></html>";			
                    $ehead = "MIME-Version: 1.0" . "\r\n";
                    $ehead.= "Content-type: text/html; charset=iso-8859-1" . "\r\n";
                    $ehead.= "From: ACFT <support@activecodefxtrading.com>\r\n".
                            "Reply-To: noreply@activecodefxtrading.com\r\n" .
                            "X-Mailer: PHP/" . phpversion();
                    
                    $subj = "ACFT Email Verification";
                    $mailsend=mail("$email","$subj","$message","$ehead");	
                    if($mailsend){
                        echo"<p style='color:green'>A confirmation link has been sent to your email</p>";
                    }else{
                        echo"<p style='color:red'>Something went wrong!</p>";
                    }				 
                    }
                }
                ?>  
                  
                  
                <h4 class="card-title">Change Password</h4>
                  <form method="POST" action="change-password-validation.php">
                    <p class="card-description">
                      <!-- SHOW PASSWORD CHANGED SUCCESSFUL MESSAGE -->
                      <?php $passwordchanged = array("successful=true" => 
                      "<div style='color: #3c763d;background-color: #dff0d8; border-color: #d6e9c6;padding: 15px; border: 1px solid transparent; border-radius: 4px;'>                        
                      <a href='#' style='text-decoration: none; float: right; font-size: 21px; font-weight: 700; line-height: 1; color: #000; text-shadow: 0 1px 0 #fff; filter: alpha(opacity=20); opacity: .2;' data-dismiss='alert' aria-label='close'>&times;</a>
                      <strong>Submitted!</strong> you have successfully changed your password<br></div>" );                        
                      if(isset($_GET['password-changed'])) echo $passwordchanged[$_GET['reason']]; ?>               
                   </p>         
   
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Old Password</label>
                          <div class="col-sm-9">
                            <input class="form-control" type="password" name="currentPassword" pattern=".{6,}" placeholder="Enter old password" />                        
                            <?php $reason = array("incorrectfailure=true" => "<p style='color:red; margin-bottom: 10px;'>Your current password is incorrect</p>"); 
                            if(isset($_GET['change-password-failed'])) echo $reason[$_GET['reason']]; ?>   
                        </div>  
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">New Password</label>
                          <div class="col-sm-9">
                            <!-- mismatched password error -->
                            <input class="form-control" type="password" name="newPassword" pattern=".{6,}" placeholder="Enter new password"/>
                            <?php $reason = array("mismatchedfailure=true" => "<p style='color:red; margin-bottom: 10px;'>Mismatched passsword, choose another password.</p>"); 
                            if(isset($_GET['change-password-failed-mismatched'])) echo $reason[$_GET['reason']]; ?>  
                          
                            <!-- Password length error -->
                            <?php $reason = array("npassfailure=true" => "<p style='color:red; margin-bottom: 10px;'>Password must be more than 6 characters.</p>"); 
                            if(isset($_GET['change-password-failed-invalid-npass-length'])) echo $reason[$_GET['reason']]; ?>  
                          </div>
                        </div>
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group row">
                          <div class="col-sm-9">
                            
                          </div>
                        </div>
                      </div>

                    <button type="submit" name="update" class="btn btn-primary me-2">Submit</button>
                    <!--<button class="btn btn-dark" disabled>Cancel</button>-->
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- content-wrapper ends -->

        <div class="row">
                    <div class="col-md-6 col-12 mb-md-0 mb-4">
                      <div class="card">
                        <h5 class="card-header">Security Settings</h5>
                        <div class="card-body">
                          <p>This settings affects your use of Active Code FX Trading platorm...</p>
                          <!-- Connections -->                                                      
                          <div class="d-flex mb-3">
                            <div class="flex-shrink-0">
                              <img src="assets/img/icons/brands/activity.png" alt="google" class="me-3" height="30" />
                            </div>
                            <div class="flex-grow-1 row">
                              <div class="col-9 mb-sm-0 mb-2">
                                <h6 class="mb-0">Save my Activity Logs</h6>
                                <small class="text-muted">You can save all activity logs including unusual activity detected.</small>
                              </div>
                              <div class="col-3 text-end">
                                <div class="form-check form-switch">
                                  <input class="form-check-input float-end" type="checkbox" role="switch" />
                                </div>
                              </div>
                            </div>
                          </div>
                          <div class="d-flex mb-3">
                            <div class="flex-shrink-0">
                              <img src="assets/img/icons/brands/security.png" alt="slack" class="me-3" height="30" />
                            </div>
                            <div class="flex-grow-1 row">
                              <div class="col-9 mb-sm-0 mb-2">
                                <h6 class="mb-0">Security Pin Code</h6>
                                <small class="text-muted">Your default security code is 5432.
                                  We will ask you this code during login 
                                  attempts from unknown devices and transactions.</small>
                              </div>
                              <div class="col-3 text-end">
                                <div class="form-check form-switch">
                                  <input class="form-check-input float-end" type="checkbox" role="switch" checked />
                                </div>
                              </div>
                            </div>
                          </div>
                          <div class="d-flex mb-3">
                            <div class="flex-shrink-0">
                              <img src="assets/img/icons/brands/2fasecurity.png" alt="2fasecurity" class="me-3" height="30" />
                            </div>
                            <div class="flex-grow-1 row">
                              <div class="col-9 mb-sm-0 mb-2">
                                <h6 class="mb-0">2FA Authentication </h6>
                                <small class="text-muted">Your account is secured with 2FA security by default.
                                 You will receive a code from us for validation on sign in from unknown devices.
                                </small>
                              </div>
                              <div class="col-3 text-end">
                                <div class="form-check form-switch">
                                  <input class="form-check-input float-end" type="checkbox" role="switch" checked/>
                                </div>
                              </div>
                            </div>
                          </div>
                         
                          
                            
                          <!-- /Connections -->
                        </div>
                      </div>
                    </div>
                    <div class="col-md-6 col-12">
                      <div class="card">
                        <h5 class="card-header">Display Settings</h5>
                        <div class="card-body">
                          <!-- Social Accounts -->
                          <div class="d-flex mb-3">
                            <div class="flex-shrink-0">
                              <img
                                src="assets/img/icons/brands/darkmode.png"
                                alt="facebook"
                                class="me-3"
                                height="30"
                              />
                            </div>
                            <div class="flex-grow-1 row">
                              <div class="col-8 col-sm-7 mb-sm-0 mb-2">
                                <h6 class="mb-0">Enable Dark Mode</h6>
                                <small class="text-muted">This feature is not available.</small>
                              </div>
                              <div class="col-3 text-end">
                                <div class="form-check form-switch" onclick="toggleTheme('dark');">
                                  <input class="form-check-input float-end" type="checkbox" role="switch"/>
                                </div>
                              </div>
                            </div>
                          </div>
                          <div class="d-flex mb-3">
                            <div class="flex-shrink-0">
                              <img
                                src="assets/img/icons/brands/darkmode.png"
                                alt="twitter"
                                class="me-3"
                                height="30"
                              />
                            </div>
                            <div class="flex-grow-1 row">
                              <div class="col-8 col-sm-7 mb-sm-0 mb-2">
                                <h6 class="mb-0">Disable Dark Mode</h6>
                                <small>If enabled.</small>
                              </div>
                              <div class="col-3 text-end">
                                <div class="form-check form-switch">
                                  <input class="form-check-input float-end" type="checkbox" role="switch" disabled/>
                                </div>
                              </div>
                            </div>
                          </div>
                          <div class="d-flex mb-3">
                            <div class="flex-grow-1 row">
                              <div class="col-8 col-sm-7 mb-sm-0 mb-2">
                                <h6 class="mb-0" style="font-size:18px">Activity Log</h6>
                              </div>
                            </div>
                          </div>
                          <div class="d-flex mb-3">
                            <div class="flex-shrink-0">
                              <img
                                src="assets/img/icons/brands/activity.png"
                                alt="dribbble"
                                class="me-3"
                                height="30"
                              />
                            </div>
                          
                            <!-- alert box -->
                          <script>
                          function myNotifications() {
                            alert("No records found!");
                          }
                          </script>

                            <div class="flex-grow-1 row">
                              <div class="col-8 col-sm-7 mb-sm-0 mb-2">
                                <h6 class="mb-0">Unknown Device Login</h6>
                                <small>No unknown activities detected.</small>
                              </div>
                              <div class="col-4 col-sm-5 text-end">
                                <a href="javascript:void()" style="font-size:12px" onclick="myNotifications()">view full log</a>
                              </div>
                            </div>
                          </div>
                          <div class="d-flex mb-3">
                            <div class="flex-shrink-0">
                              <img
                                src="assets/img/icons/brands/accountstatus.png"
                                alt="accountstatus"
                                class="me-3"
                                height="30"
                              />
                            </div>
                            <div class="flex-grow-1 row">
                              <div class="col-8 col-sm-7 mb-sm-0 mb-2">
                                <h6 class="mb-0">Account Status</h6>
                                <small class="text-muted">You have not violated our policy.</small>
                              </div>
                            </div>
                          </div>
                          <!-- /Social Accounts -->
                       </form>
                      </div>
                    </div>
                    <!-- /Account -->
                  </div>
                  </div>

                    <br>

                  <div class="card">
                    <h5 class="card-header">Delete Account</h5>
                    <div class="card-body">
                      <div class="mb-3 col-12 mb-0">
                        <div class="alert alert-warning">
                          <h6 class="alert-heading fw-bold mb-1">Are you sure you want to delete your account?</h6>
                          <p class="mb-0">Once you delete your account, there is no going back. Please be certain.</p>
                        </div>
                      </div>
                      <form action="settings.php" method="POST" id="formAccountDeactivation" onsubmit="return true">
                        <div class="form-check mb-3">
                          <input
                            type="checkbox"
                            name="accountActivation"
                            id="accountActivation"
                          />
                            <span class="" style="color:grey; font-size:15px">I confirm my account deactivation</span>
                        </div>
                        <button type="submit" class="btn btn-danger deactivate-account">Deactivate Account</button>
                      </form>

                    <?php 

                    if(isset($_POST['accountActivation'])){
                        echo"<br><div class='alert alert-info'>
                        We have received your request and your account will be deactivated. 
                        </div>";
                    }

                    ?>

                    </div>
                  </div>
                </div>

                </script>

                <!-- Jquery -->
                <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
                <!-- Dont submit Delete account form if checkmark not marked -->
                <script>

                $( '#formAccountDeactivation' ).on('submit', function(e) {
                if($( 'input[name^="accountActivation"]:checked' ).length === 0) {
                    alert( 'You must confirm you want to deactivate your account' );
                    e.preventDefault();
                }
                });

                </script>                
        <!-- content-wrapper ends -->

        <!-- partial:partials/_footer.html -->
        <footer class="footer">
          <div class="d-sm-flex justify-content-center justify-content-sm-between">
            <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">Copyright &copy; ACFT <script>document.write(new Date().getFullYear());</script>. All rights reserved </span>
            <!--<span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center">Only the best <a href="https://www.bootstrapdash.com/" target="_blank"> Bootstrap dashboard </a> templates</span>-->
                <!-- Start of google translator -->
                <div id="google_translate_element"></div>
                <script type="text/javascript">
                function googleTranslateElementInit() {
                new google.translate.TranslateElement({pageLanguage: 'en'}, 'google_translate_element');
                }
                </script>
                <script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
                <!-- End of google translator -->
          </div>
        </footer>
        <!-- partial -->
      </div>
      <!-- main-panel ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->
  <!-- plugins:js -->
  <script src="vendors/base/vendor.bundle.base.js"></script>
  <!-- endinject -->
  <!-- inject:js -->
  <script src="js/off-canvas.js"></script>
  <script src="js/hoverable-collapse.js"></script>
  <script src="js/template.js"></script>
  <script src="js/todolist.js"></script>
  <!-- endinject -->
</body>

</html>
