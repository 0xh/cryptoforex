<!DOCTYPE html>
<head>
	<!-- Meta -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width">
    <!-- SEO Meta -->
    <meta name="description" content="">
    <meta name="keywords" content="">
    <!-- Favicon -->
    <link rel="shortcut icon" href="images/favicon/favicon.ico" type="image/x-icon">
    <!-- CSS -->
    <link rel="stylesheet" href="css/main.css">
    <!-- Script-->
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <script src="js/main.js"></script>
</head>
<body>

	<!-- header -->

	<header class="header">

		<div class="top">
			<div class="shell center">
				<div class="logo">
					<a href="./">
						<img src="images/logo.png" alt="">
					</a>
				</div>
			</div>
		</div>
		<div class="bot">
			<div class="shell">
				<nav>
					<ul class="flex right">
						<li class="active but">
							<a href="#">About Us</a>
							<ul class="submenu">
								<li class="no-active">What is XcrypteX</li>
								<li><a href="./Our-technology.html">Our technology</a></li>
								<li><a href="./Crypto-Currencies.html">Crypto Currencies</a></li>
								<!-- <li><a href="./team.html">The ReadyMadeSoft Team</a></li> -->
								<!-- <li><a href="./Careers.html">Careers</a></li> -->
							</ul>
						</li>
						<li class="but">
							<a href="#">Solutions</a>
							<ul class="submenu">
								<li class="no-active">What`s included</li>
								<li><a href="./crm.html"><i class="ic ic1"></i>CRM</a></li>
								<li><a href="./Client-Area.html"><i class="ic ic2"></i>Client Area</a></li>
								<li><a href="./Affiliates-Program.html"><i class="ic ic3"></i>Affiliates Program</a></li>
								<li><a href="./Marketing-Tools.html"><i class="ic ic4"></i>Marketing Tools</a></li>
								<li><a href="./Risk-Managment.html"><i class="ic ic5"></i>Risk Managment</a></li>
								<li><a href="./Pricing.html"><i class="ic ic6"></i>Pricing  Feed Data</a></li>
								<li><a href="#"><i class="ic ic7"></i>Brokerage Hosting Server</a></li>
							</ul>
						</li>
						<li><a href="./White_Label_Program.html">White Label Program</a></li>
						<li><a href="./Customers-Support.html">Customers Support</a></li>
						<li><a href="./Contact.html">Contact</a></li>
					</ul>
				</nav>
				<div class="search">
					<a href="#" class="search"></a>
					<div class="form hidden">
						<form action="#">
							<input type="search" placeholder="search" name="search">
							<input type="submit" value="search">
						</form>
					</div>
				</div>
			</div>
		</div>

	</header>
	<!-- End -->
        @yield('content')

        <!-- Footer -->

        	<footer class="footer">
        		<div class="shell center">
        			<p>Â© Sky Mechanics Ltd. All Rights Reserved.</p>
        		</div>
        	</footer>
        	<!-- End -->

        	<div id="top"></div>

        	<div class="mobi">
        		<span></span>
        		<span></span>
        		<span></span>
        	</div>

        	<div class="bgc"></div>

        	<div class="popup popup_form">
        		<div class="close"></div>
        		<h2>You are going to invest <b>$2000</b> <br /> this diamond</h2>
        		<strong>Are you sure?</strong>
        		<div class="wrap flex">
        			<div class="item">
        				<p>REF. 12042017</p>
        				<p>CARAT 10</p>
        			</div>
        			<div class="item">
        				<p>Color F</p>
        				<p>Clarity VS1</p>
        			</div>
        		</div>
        		<p>Price Potential</p>
        		<b>$ 250 000</b>
        		<div class="button">
        			<a href="#" class="up">Yes</a>
        			<a href="#" class="down">No</a>
        		</div>
        	</div>
        </body>
        </html>
