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
					<li>
						<?php
						session_start();
						if (isset($_SESSION["admin_name"])) {
							$user_name = $_SESSION["admin_name"];
							echo "Welcome, $user_name!";
						} else {
							echo "Welcome, User!";
						}
						?>
					</li>
					<li><a href="./logout.php">Log Out</a></li>
				</ul>
			</div>
			<!-- <div class="nav_top">
				<ul>
					<li class="active"><a href=" home.php ">Dashboard</a></li>
					<li><a href=" settings.php ">Users</a></li>
					<li><a href=" agentloclist.php ">Setting</a></li>
					<li><a href=" geoloclist.php ">Configuration</a></li>
				</ul>

			</div> -->
		</div>
	</div>
	<div class="clear"></div>
	<div class="clear"></div>
	<div class="content">
		<div class="wrapper">
			<div class="bedcram">
				<ul>
					<li><a href="#">Home</a></li>
					<li>List Users</li>
				</ul>
			</div>
			<div class="left_sidebr">
				<ul>
					<li><a href="" class="dashboard">Dashboard</a></li>
					<li><a href="" class="user">Employees</a>
						<ul class="submenu">
							<li><a href="">Manage Employees</a></li>
						</ul>

					</li>
					<!-- <li><a href="" class="Setting">Setting</a>
						<ul class="submenu">
							<li><a href="./forgotPassword.php">Chnage Password</a></li>
							<li><a href="">Mange Contact Request</a></li>
							<li><a href="#">Manage Login Page</a></li>
						</ul>

					</li> -->
					<!-- <li><a href="" class="social">Configuration</a>
						<ul class="submenu">
							<li><a href="">Payment Settings</a></li>
							<li><a href="">Manage Email Content</a></li>
							<li><a href="#">Manage Limits</a></li>
						</ul>

					</li> -->
				</ul>
			</div>
			<div class="right_side_content">
				<h1>List Users</h1>
				<div class="list-contet">
					<div class="form-left">
						<div class="form">
							<form role="form">

								<form method="GET" action="">
									<input type="text" class="search-box search-upper" name="search"
										placeholder="Search...">
									<button type="submit" class="submit-btn">Search</button>
								</form>
								<!-- <input type="text" class="search-box search-upper" placeholder="Search.." />
								<input type="submit" class="submit-btn" value="Search"> -->
							</form>
						</div>
						<a href="./addEmployee.php">
							<li class="submit-btn add-user"> Add More Employees</li>
						</a>

						<!-- <input type="button"  class="submit-btn add-user" value="Add Moree Users"> -->
					</div>
					<table width="100%" cellspacing="0">
						<thead>
							<tr>
								<!-- <th width="10px">S.no</th>
								<th width="100px">User Name</th>
								<th width="98px">First Name</th>
								<th width="100px">Last Name</th>
								<th width="113px"> E-Mail</th>
								<th width="97px">User Type</th>
								<th width="50px" class="payment">Payment<br>Status</th>
								<th width="126px">Action</th> -->
								<th width="10px">No</th>
								<th width="30px">Image</th>
								<th width="100px">First Name</th>
								<th width="100px">Last Name</th>
								<th width="100px">Email</th>
								<th width="20px">Age</th>
								<th width="30px">Gender</th>
								<th width="30px"> Role</th>
								<th width="100px">Joining Date</th>
								<th width="100px">Action</th>
							</tr>
						</thead>
						<tbody>
							<?php
							require_once "./config.php";
							session_start();

							if (isset($_SESSION['loggedin']) || $_SESSION['loggedin'] == true) {

								$searchTerm = isset($_GET['search']) ? $_GET['search'] : '';
								if (!empty($searchTerm)) {
									$searchTerm = mysqli_real_escape_string($link, $searchTerm);
									$sql = "SELECT * FROM employees WHERE first_name LIKE '%$searchTerm%' OR last_name LIKE '%$searchTerm%' OR email LIKE '%$searchTerm%' or age LIKE '%$searchTerm%'";
								} else {
									$recordsPerPage = 8;
									$page = isset($_GET['page']) ? $_GET['page'] : 1;
									$offset = ($page - 1) * $recordsPerPage;
									$sql = "SELECT * FROM employees LIMIT $offset, $recordsPerPage";
								}


								if ($result = mysqli_query($link, $sql)) {

									if (mysqli_num_rows($result) > 0) {
										$rows = mysqli_fetch_all($result, MYSQLI_ASSOC);
										$count = ($page - 1) * $recordsPerPage + 1;
										foreach ($rows as $row) { ?>
											<tr class="hov">
												<td>
													<?= $count++; ?>
												</td>
												<td>
													<img src="./man.png" alt="Employees image" width="25" height="25">
												</td>
												<td>
													<?= $row["first_name"]; ?>
												</td>
												<td>
													<?= $row["last_name"]; ?>
												</td>
												<td>
													<?= $row["email"]; ?>
												</td>
												<td>
													<?= $row["age"]; ?>
												</td>
												<td>
													<?= $row["gender"]; ?>
												</td>
												<td>
													<?= $row["designation"]; ?>
												</td>
												<td>
													<?= $row["joining_date"]; ?>
												</td>
												<td>
													<a href="./edit-user.php?id=<?= $row["id"]; ?>"><img
															src="images/edit-icon.png" /></a>
													<a href="./deleteEmployee.php?id=<?= $row["id"]; ?>"><img
															src="images/cross.png" /></a>
													<!-- <a href="#"><img src="images/correct.png" /></a> -->
													<!-- <a href="#"><img src="images/view.png" /></a> -->
												</td>
											</tr>
											<?php
										}
										mysqli_free_result($result);
									} else { ?>
										<tr>
											<td class="text-center text-danger fw-bold" colspan="9">Oops no record were found please
												search
												correct name </td>
										</tr>
										<?php
									}
								}
							} else {
								header("location: login.php");

							}

							?>
						</tbody>
					</table>
					<div class="paginaton-div">
						<ul class="pagination justify-content-center">
							<?php
							$totalRecordsSql = 'Select COUNT(*) from employees';
							$result = mysqli_query($link, $totalRecordsSql);
							$totalRecords = mysqli_fetch_array($result)[0];

							$totalPages = ceil($totalRecords / $recordsPerPage);

							if ($page > 1) {
								echo '<li class="page-item"><a class="page-link" href="?page=' . ($page - 1) . '">&laquo; Previous</a></li>';
							}
							for ($i = 1; $i <= $totalPages; $i++) {
								echo '<li class="page-item"><a class="page-link" href="?page=' . $i . '">' . $i . '</a></li>';
							}
							if ($page < $totalPages) {
								echo '<li class="page-item"><a class="page-link" href="?page=' . ($page + 1) . '">Next &raquo;</a></li>';
							}
							?>
						</ul>
					</div>

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