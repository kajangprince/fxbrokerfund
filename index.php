<?php
session_start();
// on login screen, redirect to dashboard if already logged in
if(isset($_SESSION['email'])){
    header("location:./marketplace"); 
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
		<meta name="description" content="Welcome to FX Broker Fund, home of trading...">
		<meta name="keywords" content="fx, trading, forex, commodities, indices, broker, fund">
        <link rel="apple-touch-icon" sizes="180x180" href="apple-touch-icon.png">
        <link rel="icon" type="image/png" sizes="32x32" href="favicon-32x32.png">
        <link rel="icon" type="image/png" sizes="16x16" href="favicon-16x16.png">
        <meta name="theme-color" content="#234994" /> <!-- blue -->
        <link rel="shortcut icon" href="favicon.png" />
        <link rel="manifest" href="site.webmanifest">
		<!-- Loading third party fonts -->
		<link href="http://fonts.googleapis.com/css?family=Roboto+Condensed:300,400,700" rel="stylesheet" type="text/css">
		<link href="fonts/font-awesome.min.css" rel="stylesheet" type="text/css">
		<!-- Loading main css file -->
		<link rel="stylesheet" href="indexstyle.css">		
		<title>FX Broker Fund</title>
		
        <style>
        
        /* Start Marquee Slider Styles */
        
        body {
          --space: 2rem;
          align-content: center;
          gap: var(--space);
        }
        
        .marquee {
          --duration: 60s;
          --gap: var(--space);
        
          display: flex;
          overflow: hidden;
          user-select: none;
          gap: var(--gap);
        }
        
        .marquee__group {
          flex-shrink: 0;
          display: flex;
          align-items: center;
          justify-content: space-around;
          gap: var(--gap);
          min-width: 100%;
          animation: scroll var(--duration) linear infinite;
        }
        
        @media (prefers-reduced-motion: reduce) {
          .marquee__group {
            animation-play-state: paused;
          }
        }
        
        .marquee__group img {
          max-width: clamp(10rem, 1rem + 28vmin, 20rem);
          aspect-ratio: 1;
          object-fit: cover;
          border-radius: 1rem;
        }
        
        .marquee__group p {
          background-image: linear-gradient(
            75deg,
            hsl(240deg 70% 49%) 0%,
            hsl(253deg 70% 49%) 11%,
            hsl(267deg 70% 49%) 22%,
            hsl(280deg 71% 48%) 33%,
            hsl(293deg 71% 48%) 44%,
            hsl(307deg 71% 48%) 56%,
            hsl(320deg 71% 48%) 67%,
            hsl(333deg 72% 48%) 78%,
            hsl(347deg 72% 48%) 89%,
            hsl(0deg 73% 47%) 100%
          );
          -webkit-background-clip: text;
          -webkit-text-fill-color: transparent;
        }
        
        .marquee--borders {
          border-block: 3px solid dodgerblue;
          padding-block: 0.75rem;
        }
        
        .marquee--reverse .marquee__group {
          animation-direction: reverse;
          animation-delay: calc(var(--duration) / -2);
        }
        
        @keyframes scroll {
          0% {
            transform: translateX(0);
          }
        
          100% {
            transform: translateX(calc(-100% - var(--gap)));
          }
        }

        /* End of Marquee Slider */
        
        .grid-container {
          display: grid;
          grid-template-columns: auto auto auto;
          padding: 10px;
        }
        .grid-item {
          color: green;
          padding: 10px;
          font-size: 15px;
          text-align: center;
        }

        </style>

	</head>
	<body>
		
		<div id="site-content">
			<header class="site-header">
				<div class="container">
					<a href="index" id="branding">
						<img src="images/fxbrokerfundlogo.png" alt="Fx Broker Fund Logo" class="logo">
						<div class="branding-copy">
							<h1 class="site-title">Trading made easy</h1>
							<!--<small class="site-description">Better returns with us</small>-->
						</div>
					</a> <!-- #branding -->

					<a href="login" class="pull-right button muted">Signup/Login</a>
				</div> <!-- .container -->
		    </header> <!-- .site-header -->
	
    <!--==========================
     Marquee Slider
    ============================-->	   
    
            <?php
				
        include_once("pdoconfig.php");

        // $email = $_SESSION['email'];

        $email = "support@sahmax.com";

        $stmt = $con->prepare("SELECT * FROM rates WHERE email = :email LIMIT 1");
        $stmt->execute(array('email' => $email));
        while($row = $stmt->fetch(PDO::FETCH_ASSOC))
        {
        $Validate_id = $row['id'];
        $id = escape($Validate_id);

        $Validate_btc_buy = $row['btcbuy'];	
        $btc_buy = escape($Validate_btc_buy);

        $Validate_btc_sell = $row['btcsell'];	
        $btc_sell = escape($Validate_btc_sell);

        $Validate_deriv_buy = $row['derivbuy'];	
        $deriv_buy = escape($Validate_deriv_buy);

        $Validate_deriv_sell = $row['derivsell'];	
        $deriv_sell = escape($Validate_deriv_sell);

        $Validate_pm_buy = $row['pmbuy'];	
        $pm_buy = escape($Validate_pm_buy);
        
        $Validate_pm_sell = $row['pmsell'];	
        $pm_sell = escape($Validate_pm_sell);
        
        $Validate_usdt_buy = $row['usdtbuy'];	
        $usdt_buy = escape($Validate_usdt_buy);
        
        $Validate_usdt_sell = $row['usdtsell'];	
        $usdt_sell = escape($Validate_usdt_sell);
        
        $Validate_neteller_buy = $row['netellerbuy'];	
        $neteller_buy = escape($Validate_neteller_buy);
        
        $Validate_neteller_sell = $row['netellersell'];	
        $neteller_sell = escape($Validate_neteller_sell);

        $time =  $row['updated_at'];
        $timestamp = strtotime($time);
        $formatted_time = date('d F Y', $timestamp);
        
        }         

        ?>


    <div class="marquee marquee--borders" style="--duration: 40s">
      <div class="marquee__group">
        <p><img src="https://sahmax.com/images/bitcoin-btc-logo.svg" alt="Bitcoin Logo" style="width:20px"> Buy - &#x20A6;<?php echo $btc_buy; ?>/&#36; <img src="https://sahmax.com/images/star.gif"></p>
        <p aria-hidden="true"><img src="https://sahmax.com/images/bitcoin-btc-logo.svg" alt="Bitcoin Logo" style="width:20px"><span style="color:green"> Sell - &#x20A6;<?php echo $btc_sell; ?>/&#36;</span> <img src="https://sahmax.com/images/star.gif"></p>
        <p aria-hidden="true"><img src="https://sahmax.com/images/deriv-logo.png" alt="Deriv Logo" style="width:20px"> Buy - &#x20A6;<?php echo $deriv_buy; ?>/&#36; <img src="https://sahmax.com/images/star.gif"></p>
        <p aria-hidden="true"><img src="https://sahmax.com/images/deriv-logo.png" alt="Deriv Logo" style="width:20px"><span style="color:green"> Sell - &#x20A6;<?php echo $deriv_sell; ?>/&#36;</span> <img src="https://sahmax.com/images/star.gif"></p>
        <!--</div>
        <div aria-hidden="true" class="marquee__group">-->
        <p><img src="https://sahmax.com/images/perfectmoney-logo.png" alt="Perfect money Logo" style="width:20px"> Buy - &#x20A6;<?php echo $pm_buy; ?>/&#36; <img src="https://sahmax.com/images/star.gif"></p>
        <p><img src="https://sahmax.com/images/perfectmoney-logo.png" alt="Perfect money Logo" style="width:20px"><span style="color:green"> Sell - &#x20A6;<?php echo $pm_sell; ?>/&#36;</span> <img src="https://sahmax.com/images/star.gif"></p>
        <p><img src="https://sahmax.com/images/tether-usdt-logo.svg" alt="USDT Logo" style="width:20px"> Buy - &#x20A6;<?php echo $usdt_buy; ?>/&#36; <img src="https://sahmax.com/images/star.gif"></p>
        <p><img src="https://sahmax.com/images/tether-usdt-logo.svg" alt="USDT Logo" style="width:20px"><span style="color:green"> Sell - &#x20A6;<?php echo $usdt_sell; ?>/&#36;</span> <img src="https://sahmax.com/images/star.gif"></p>
        <p><img src="https://sahmax.com/images/neteller-logo.png" alt="Neteller Logo" style="width:20px"> Buy - &#x20A6;<?php echo $neteller_buy; ?>/&#36; <img src="https://sahmax.com/images/star.gif"></p>
        <p><img src="https://sahmax.com/images/neteller-logo.png" alt="Neteller Logo" style="width:20px"><span style="color:green"> Sell - &#x20A6;<?php echo $neteller_sell; ?>/&#36;</span> <img src="https://sahmax.com/images/star.gif"></p>
        <p><img src="https://sahmax.com/images/litecoin-logo.png" alt="LTC Logo" style="width:20px"></p>
        <p><img src="https://sahmax.com/images/eth-logo.png" alt="ETH Logo" style="width:20px"></p>
        <p><img src="https://sahmax.com/images/ripple-logo.png" alt="XRP Logo" style="width:20px"></p>
        <p><img src="https://sahmax.com/images/tron-logo.png" alt="Tron Logo" style="width:20px"></p>
        <p><img src="https://sahmax.com/images/dogecoin-logo.png" alt="Dogecoin Logo" style="width:20px"></p>
        <p><img src="https://sahmax.com/images/cardano-logo.png" alt="Cardano Logo" style="width:20px"></p>
        <p><img src="https://sahmax.com/images/usdc-logo.png" alt="USDC Logo" style="width:20px"></p>
        <p><img src="https://sahmax.com/images/solana-logo.png" alt="Solana Logo" style="width:20px"></p>
        <p><img src="https://sahmax.com/images/eth-classic.png" alt="ETH Classic Logo" style="width:20px"></p>
      </div>
    </div>
    
    <!--==========================
     End Marquee Slider
    ============================-->	

			<main class="main-content">
				<div class="hero" data-bg-image="dummy/bg.jpg">
					<div class="container">
						<div class="row">
							<div class="col-md-6">
								<h2 class="hero-title">FXBF</h2>
								<p>Trading Made Easy With FX Broker Fund</p>
								<div class="rate-box">
									<div class="num">94.5%</div>
									<div class="label">Average Rate <br>of Returning Clients</div>
								</div>
								<ul class="check-list">
									<li><i class="fa fa-check"></i> We're a leading exchange platform, with best market rates. </li>
									<li><i class="fa fa-check"></i> Trade your crypto coins. Fast pay, no Delay. </li>
									<li><i class="fa fa-check"></i> Buy and sell Deriv dollar. Trusted and reliable.</li>
									<li><i class="fa fa-check"></i> Buy and sell perfect money. Best market rates.</li>
									<li><i class="fa fa-check"></i> Receive payment. safe trading, no bad guys.</li> 
									<li><i class="fa fa-check"></i> Initiate trade, sit back and watch us in action.</li> 
								</ul>
							</div>
							<div class="col-md-5 col-md-offset-1">
								<div class="request-form">
									<h2>A leading exchange platform</h2>
									<p>We are a committed company, dedicated to meet and understand the needs of our
                                    customers with the aim of offering the best market rates with a high degree of 
                                    professionalism and excellence in quality of service.</p>
                                <div class="grid-container">
                                  <div class="grid-item"><img src="https://sahmax.com/images/bitcoin-btc-logo.svg" alt="Bitcoin Logo" style="width:20px"> Buy - &#x20A6;<?php echo $btc_buy; ?>/&#36; <img src="https://sahmax.com/images/star.gif"></div>
                                  <div class="grid-item"><img src="https://sahmax.com/images/bitcoin-btc-logo.svg" alt="Bitcoin Logo" style="width:20px"><span style="color:green"> Sell - &#x20A6;<?php echo $btc_sell; ?>/&#36;</span> <img src="https://sahmax.com/images/star.gif"></div>
                                  <div class="grid-item"><img src="https://sahmax.com/images/deriv-logo.png" alt="Deriv Logo" style="width:20px"> Buy - &#x20A6;<?php echo $deriv_buy; ?>/&#36; <img src="https://sahmax.com/images/star.gif"></div>  
                                  <div class="grid-item"><img src="https://sahmax.com/images/deriv-logo.png" alt="Deriv Logo" style="width:20px"><span style="color:green"> Sell - &#x20A6;<?php echo $deriv_sell; ?>/&#36;</span> <img src="https://sahmax.com/images/star.gif"></div>
                                  <div class="grid-item"><img src="https://sahmax.com/images/perfectmoney-logo.png" alt="Perfect money Logo" style="width:20px"> Buy - &#x20A6;<?php echo $pm_buy; ?>/&#36; <img src="https://sahmax.com/images/star.gif"></div>
                                  <div class="grid-item"><img src="https://sahmax.com/images/perfectmoney-logo.png" alt="Perfect money Logo" style="width:20px"><span style="color:green"> Sell - &#x20A6;<?php echo $pm_sell; ?>/&#36;</span> <img src="https://sahmax.com/images/star.gif"></div>  
                                  <div class="grid-item"><img src="https://sahmax.com/images/tether-usdt-logo.svg" alt="USDT Logo" style="width:20px"> Buy - &#x20A6;<?php echo $usdt_buy; ?>/&#36; <img src="https://sahmax.com/images/star.gif"></div>
                                  <div class="grid-item"><img src="https://sahmax.com/images/tether-usdt-logo.svg" alt="USDT Logo" style="width:20px"><span style="color:green"> Sell - &#x20A6;<?php echo $usdt_sell; ?>/&#36;</span> <img src="https://sahmax.com/images/star.gif"></div>
                                  <div class="grid-item"><img src="https://sahmax.com/images/neteller-logo.png" alt="Neteller Logo" style="width:20px"> Buy - &#x20A6;<?php echo $neteller_buy; ?>/&#36; <img src="https://sahmax.com/images/star.gif"></div>  
                                  <div class="grid-item"><img src="https://sahmax.com/images/neteller-logo.png" alt="Neteller Logo" style="width:20px"><span style="color:green"> Sell - &#x20A6;<?php echo $neteller_sell; ?>/&#36;</span> <img src="https://sahmax.com/images/star.gif"></div>  
                                </div>
                               </div>
							</div>
						</div>
					</div>
				</div>
				
				<div class="fullwidth-block cta">
					<div class="container">
						<img src="images/macbook-frame.png" alt="FXBF" class="screen">
						<h2 class="cta-text">While we're a leading exchange platform, our 
						mission is simple: We responsibly provide financial services that enable 
						growth and economic progress.</h2>
						<a href="signup" class="button">GET STARTED</a> 
					</div>
				</div>

				<div class="fullwidth-block border-top-bottom">
					<div class="container">
						<img src="dummy/tradingview.png" alt="trading view" style="pointer-events:none">
						<img src="dummy/deriv.png" alt="deriv logo" style="pointer-events:none">
						<img src="dummy/investopedia.png" alt="Investopedia logo" style="pointer-events:none">
						<img src="dummy/metatrader.png" alt="metatrader logo" style="pointer-events:none">
						<a href="http://perfectmoney.com" title="Perfect Money - new generation of Internet payment system">
                        <img hspace="5" src="http://perfectmoney.com/img/banners/en_US/accepted_3.jpg" width="150" height="75"></a>
					</div>
				</div>

			</main> <!-- .main-content -->

			<footer class="site-footer">
				<div class="container">
					<p class="copy"><a href="contact">Contact Us</a></p>
					<p class="copy">Copyright &copy;<script>document.write(new Date().getFullYear());</script> FXBF. All rights reserved</p>
				</div> <!-- .container -->
				<!-- Start of google translator -->
				<div id="google_translate_element"></div>
				<script type="text/javascript">
				function googleTranslateElementInit() {
					new google.translate.TranslateElement({pageLanguage: 'en'}, 'google_translate_element');
				}
				</script>
	
				<script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
				<!-- End of google translator -->
			</footer> <!-- .site-footer -->
		</div> <!-- #site-content -->
		
		<script src="js/jquery-1.11.1.min.js"></script>
		<script src="js/plugins.js"></script>
		<script src="js/app.js"></script>
		
		<script src="//code.tidio.co/qqxfqqymmkv7js8he385zm8e4aam5bof.js" async></script>
		
</body>
</html>