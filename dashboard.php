<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Admin</title>

	<!-- Bootstrap -->
	<link href="css/dashboard.css" rel="stylesheet">

	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
	  <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
	  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->
</head>

<body>
	<div class="header">
		<div class="wrapper">
			<div class="logo"><a href="#"><img src="images/logo.png"></a></div>


			<div class="right_side">
				<ul>
					<li>Welcome Admin</li>
					<li><a href="">Log Out</a></li>
				</ul>
			</div>
			<div class="nav_top">
				<ul>
					<li class="active"><a href=" home.php ">Dashboardu</a></li>
					<li><a href=" settings.php ">Employees</a></li>
					<li><a href=" agentloclist.php ">Setting</a></li>
					<li><a href=" geoloclist.php ">Configuration</a></li>
				</ul>

			</div>
		</div>
	</div>
	<div class="clear"></div>
	<div class="clear"></div>
	<div class="content">
		<div class="wrapper">
			<div class="left_sidebr">
				<ul>
					<li><a href="" class="dashboard">Dashboard</a></li>
					<li><a href="" class="user">Employees</a>
						<ul class="submenu">
							<li><a href="./list-users.php">Show all employees</a></li>
						</ul>
						<ul class="submenu">
							<li><a href="">Edit employees</a></li>
						</ul>
						<ul class="submenu">
							<li><a href="">Delete employees</a></li>
						</ul>
						<ul class="submenu">
							<li><a href="">Add new employees</a></li>
						</ul>

					</li>
					<li><a href="" class="Setting">Setting</a>
						<ul class="submenu">
							<li><a href="">Chnage Password</a></li>
							<li><a href="">Mange Contact Request</a></li>
							<li><a href="#">Manage Login Page</a></li>

						</ul>

					</li>
					<li><a href="" class="social">Configuration</a>
						<ul class="submenu">
							<li><a href="">Payment Settings</a></li>
							<li><a href="">Manage Email Content</a></li>
							<li><a href="#">Manage Limits</a></li>
						</ul>

					</li>
				</ul>
			</div>
			<div class="right_side_content">
				<h1>Dashboard</h1>
				<div class="tab">
					<ul>
						<li class="selected"><a href=""><span class="left"><img class="selected-act"
										src="images/dashboard-hover.png"><img src="images/dashboard.png"
										class="hidden" /></span><span class="right">Dashboard</span></a></li>
						<li><a href=""><span class="left"><img class="selected-act" src="images/user-hover.png"><img
										class="hidden" src="images/user.png" /></span><span
									class="right">Users</span></a></li>
						<li><a href=""><span class="left"><img class="selected-act" src="images/setting-hover.png"><img
										class="hidden" src="images/setting.png" /></span><span
									class="right">Setting</span></a></li>
						<li><a href=""><span class="left"><img class="selected-act"
										src="images/configuration-hover.png"><img class="hidden"
										src="images/configuration.png" /></span><span
									class="right">Configuration</span></a></li>

					</ul>
				</div>
			</div>

		</div>
	</div>
	<div class="footer">
		<div class="wrapper">
			<p>Copyright © 2014 yourwebsite.com. All rights reserved</p>
		</div>

	</div>

</body>

</html>