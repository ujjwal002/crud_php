<?php
require_once "./config.php";
session_start();

if (isset($_SESSION['loggedin']) || $_SESSION['loggedin'] == true) {

	$fname_err = $lname_err = $email_err = $age_err = $gender_err = $designation_err = $date_err = "";
	$fname = $lname = $email = $age = $gender = $designation = "";

	if (isset($_POST["id"]) && !empty($_POST["id"])) {
		$id = $_POST["id"];

		if (empty(trim($_POST["fname"]))) {
			$fname_err = "This field is required.";
		} else {
			$fname = ucfirst(trim($_POST["fname"]));
			if (!ctype_alpha($fname)) {
				$fname_err = "Invalid name format.";
			}
		}

		if (empty(trim($_POST["lname"]))) {
			$lname_err = "This field is required.";
		} else {
			$lname = ucfirst(trim($_POST["lname"]));
			if (!ctype_alpha($lname)) {
				$lname_err = "Invalid name format.";
			}
		}

		if (empty(trim($_POST["email"]))) {
			$email_err = "This field is required.";
		} else {
			$email = filter_var($_POST["email"], FILTER_SANITIZE_EMAIL);
			if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
				$email_err = "Please enter a valid email address.";
			}
		}

		if (empty(trim($_POST["age"]))) {
			$age_err = "This field is required.";
		} else {
			$age = trim($_POST["age"]);
			if (!ctype_digit($age)) {
				$age_err = "Please enter a valid age number";
			}
		}

		if (empty($_POST["gender"])) {
			$gender_err = "This field is required.";
		} else {
			$gender = $_POST["gender"];
		}

		if (empty($_POST["designation"])) {
			$designation_err = "This field is required.";
		} else {
			$designation = $_POST["designation"];
		}

		if (empty($_POST["date"])) {
			$date_err = "This field is required";
		} else {
			$date = $_POST["date"];
		}

		if (empty($fname_err) && empty($lname_err) && empty($email_err) && empty($age_err) && empty($gender_err) && empty($designation_err) && empty($date_err)) {
			$sql = "UPDATE employees SET first_name = ?, last_name = ?, email = ?, age = ?, gender = ?, designation = ?, joining_date = ? WHERE id = ?";

			if ($stmt = mysqli_prepare($link, $sql)) {
				mysqli_stmt_bind_param($stmt, "sssisssi", $param_fname, $param_lname, $param_email, $param_age, $param_gender, $param_designation, $param_date, $param_id);

				$param_fname = $fname;
				$param_lname = $lname;
				$param_email = $email;
				$param_age = $age;
				$param_gender = $gender;
				$param_designation = $designation;
				$param_date = $date;
				$param_id = $id;

				if (mysqli_stmt_execute($stmt)) {
					echo "<script>" . "alert('Record has been updated successfully.');" . "</script>";
					echo "<script>" . "window.location.href='./'" . "</script>";
					exit;
				} else {
					echo "Oops! Something went wrong. Please try again later.";
				}
			}

			mysqli_stmt_close($stmt);
		}


		mysqli_close($link);
	} else {

		if (isset($_GET["id"]) && !empty(trim($_GET["id"]))) {

			$id = trim($_GET["id"]);

			$sql = "SELECT * FROM employees WHERE id = ?";


			if ($stmt = mysqli_prepare($link, $sql)) {

				mysqli_stmt_bind_param($stmt, "i", $param_id);

				$param_id = $id;

				if (mysqli_stmt_execute($stmt)) {

					$result = mysqli_stmt_get_result($stmt);


					if (mysqli_num_rows($result) == 1) {
						$row = mysqli_fetch_array($result);

						$fname = $row["first_name"];
						$lname = $row["last_name"];
						$email = $row["email"];
						$age = $row["age"];
						$gender = $row["gender"];
						$date = $row["joining_date"];
						$designation = $row["designation"];
					} else {

						echo "<script>" . "window.location.href='./edit-user.php'" . "</script>";
						exit;
					}
				} else {
					echo "Oops! Something went wrong. Please try again later";
				}
			}
			mysqli_stmt_close($stmt);

			mysqli_close($link);
		} else {
			echo "<script>" . "window.location.href='./list-users.php'" . "</script>";
			exit;
		}
	}
} else {
	header("location: login.php");
	echo $_SESSION;
}
?>
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
					<!-- <li><a href="./list-users.php">List Users</a></li> -->
					<li>Edit employes</li>
				</ul>
			</div>
			<div class="left_sidebr">
				<ul>
					<li><a href="" class="dashboard">Dashboard</a></li>
					<li><a href="" class="user">Employees</a>
						<ul class="submenu">
							<li><a href="">Manage Users</a></li>

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
				<h1>Edit Users</h1>
				<div class="list-contet">
					<!-- <div class="error-message-div error-msg"><img
							src="images/unsucess-msg.png"><strong>UnSucess!</strong> Your Message hasn't been Send
					</div> -->

					<form class="form-edit" action="<?= htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
						<div class="form-row">
							<div class="form-label">
								<label>First Name : <span></span></label>
							</div>
							<div class="input-field">
								<input type="text" class="search-box" name="fname" id="fname"
									placeholder="Enter your first name" value="<?= $fname; ?>">

								<small class="text-danger">
									<?= $fname_err; ?>
								</small>
							</div>
						</div>
						<div class="form-row">
							<div class="form-label">
								<label>Last Name : <span>*</span></label>
							</div>
							<div class="input-field">
								<input type="text" class="search-box" name="lname" id="lname"
									placeholder="Enter your first name" value="<?= $lname; ?>">
								<small class="text-danger">
									<?= $lname_err; ?>
								</small>
							</div>
						</div>
						<div class="form-row">
							<div class="form-label">
								<label>Email : <span>*</span></label>
							</div>
							<div class="input-field">
								<input type="text" class="search-box" name="email" id="email"
									placeholder="Enter your first name" value="<?= $email; ?>">
								<small class="text-danger">
									<?= $email_err; ?>
								</small>
							</div>
						</div>
						<div class="form-row">
							<div class="form-label">
								<label>Age: <span>*</span></label>
							</div>
							<div class="input-field">
								<input type="text" class="search-box" name="age" id="age"
									placeholder="Enter your first name" value="<?= $age; ?>">
								<small class="text-danger">
									<?= $age_err; ?>
								</small>
							</div>
						</div>
						<div class="form-row">
							<div class="form-label">
								<label>Gender: <span>*</span></label>

							</div>
							<div class="input-field">
								<div class="select">
									<select name="gender" id="gender">
										<option selected disabled>Select Gender</option>
										<option value="Male" <?= (isset($gender) && $gender == "Male") ? "selected" : ""; ?>>Male</option>
										<option value="Female" <?= (isset($gender) && $gender == "Female") ? "selected" : ""; ?>>Female</option>
										<option value="Others" <?= (isset($gender) && $gender == "Others") ? "selected" : ""; ?>>Others</option>

									</select>
									<small class="text-danger">
										<?= $gender_err; ?>
									</small>
								</div>
							</div>
						</div>
						<div class="form-row">
							<div class="form-label">
								<label>joining_date: <span>*</span></label>
							</div>
							<div class="input-field">
								<input type="date" class="search-box" name="date" id="date" value="<?= $date; ?>" />
								<small class="text-danger">
									<?= $date_err; ?>
								</small>
							</div>
						</div>

						<div class="form-row">
							<div class="form-label">
								<label>Designation: <span></span> </label>
							</div>
							<div class="input-field">
								<div class="select">
									<select name="designation" id="designation" >
										<option selected disabled>Select Designation</option>
										<option value="UI Designer" <?= (isset($designation) && $designation == "Backend developer") ? "selected" : ""; ?>>
											Backend developer
										</option>
										<option value="Frontend Developer" <?= (isset($designation) && $designation == "Frontend Developer") ? "selected" : ""; ?>>
											Frontend Developer
										</option>
										<option value="PHP Developer" <?= (isset($designation) && $designation == "PHP Developer") ? "selected" : ""; ?>>
											PHP Developer
										</option>
										<option value="Android Developer" <?= (isset($designation) && $designation == "Full stack Developer") ? "selected" : ""; ?>>
											Full stack Developer
										</option>

									</select>
									<small class="text-danger">
										<?= $designation_err; ?>
									</small>
								</div>
							</div>
						</div>
						<div class="form-row">
							<div class="form-label">
								<label><span></span> </label>
							</div>
							<div class="input-field">
								<input type="submit" class="submit-btn" value="Save">
							</div>
						</div>



					</form>
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