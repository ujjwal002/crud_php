<?php
require_once "./config.php";
$email_err = $password_err = $login_err = "";
$email = $password = $last_email = $last_password = "";


if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (empty($_POST["email"])) {
    $email_err = "Email is required*";
  } else {
    $email = ucfirst(trim($_POST["email"]));
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $email_err = "Invalid email format";
    }
    $last_email = $_POST["email"];
  }
  if (empty($_POST["password"])) {
    $password_err = "Password is required*";
  } else {
    $last_password = $_POST["password"];
  }




  if (empty($email_err) && empty($password_err)) {
    $email = $_POST["email"];
    $password = $_POST["password"];

    $exitUser = "select * from register where email = '$email'";

    $result = mysqli_query($link, $exitUser);

    $numRows = mysqli_num_rows($result);


    $sql = "SELECT * FROM register WHERE email = ? AND password = ?";

    $stmt = mysqli_prepare($link, $sql);

    if ($stmt) {
      mysqli_stmt_bind_param($stmt, "ss", $email, $password);
      mysqli_stmt_execute($stmt);

      $result = mysqli_stmt_get_result($stmt);

      if (mysqli_num_rows($result) == 1) {
        session_start();
        $_SESSION["loggedin"] = true;
        $row = mysqli_fetch_assoc($result);

        $_SESSION["admin_name"] = $row["name"];
        //  echo $_SESSION["admin_name"];
        //   // echo
        //   die();
        //   // echo $_SESSION["admin_name"];
        //   // die();

        header("location: list-users.php");

      } else {
        $login_err = "Email and Password didn't match";
      }
    } else {
      echo "hii";
      echo "Error in prepared statement: " . mysqli_error($link);
    }
    session_start();

    mysqli_stmt_close($stmt);
  }
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
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

  <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body>
  <div class="login_section">
    <div class="wrapper relative">
      <div style="display:none" class="meassage_successful_login">You have Successfull Edit </div>
      <div class="heading-top">
        <div class="logo-cebter"><a href="#"><img src="images/at your service_banner.png"></a></div>
      </div>
      <div class="box" style=" width:400px">
        <div class="outer_div" style="height:250px;">
          <h2>Admin <span>Login</span></h2>
          <!-- <div class="error-message-div error-msg"> -->
          <?php
          if ($login_err) {
            echo '<div class="error-message-div error-msg"><img src="images/unsucess-msg.png"><strong>Incorrect !</strong> username or password</div>';
          }
          ?>


          <!-- <img src="images/unsucess-msg.png"><strong>Invalid!</strong> username
            or password  -->

          <form action="<?= htmlspecialchars(basename($_SERVER["REQUEST_URI"])); ?>" class="margin_bottom" method="post"
            style=" width:350px">
            <div class="form-group" style="width:331px">
              <label for="exampleInputEmail1">Email<span style="color:red;">*</span></label>
              <input type="text" class="form-control<?php if (!empty($email_err))
                echo ' is-invalid'; ?>" name="email" value="<?= $last_email; ?>" id="email" />
              <?php if (!empty($email_err)): ?>
                <small class="text-danger size error-message">
                  <?= $email_err; ?>
                </small>
              <?php endif; ?>
            </div>
            <div class="form-group" style="width:331px">
              <label for="exampleInputPassword1">Password<span style="color:red;">*</span></label>
              <input type="password" class="form-control<?php if (!empty($password_err))
                echo ' is-invalid'; ?>" name="password" value="<?= $last_password; ?>" id="password" />
              <?php if (!empty($password_err)): ?>
                <small class="text-danger size error-message">
                  <?= $password_err; ?>
                </small>
              <?php endif; ?>
              <!-- <input type="password" class="form-control" name="password" value="<?php echo $last_password; ?>" />
              <small class="text-danger size">
                <?= $password_err; ?>
              </small> -->
            </div>
            <div class="form-group" style="width:331px">
              <div style="display: flex; justify-content: space-between">
                <a href="./signUp.php" style="font-size: 14px;">Sign Up?</a>
                <a href="./forgotPassword.php" style="font-size: 14px;">Forgot Password ?</a>
              </div>
            </div>
            <button type="submit" class="btn_login login-button">Login</button>
          </form>
        </div>
      </div>
    </div>
    <script>
      $(document).ready(function () {
        function isValidEmail(email) {
          var emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
          return emailPattern.test(email);
        }

        function showErrorMessage(input, message) {
          input.addClass("is-invalid");
          input.next(".error-message").remove();
          $("<small class='text-danger size error-message'>" + message + "</small>").insertAfter(input);
          updateLoginButtonStatus();
        }

        function clearErrorMessage(input) {
          input.removeClass("is-invalid");
          input.next(".error-message").remove();
          updateLoginButtonStatus();
        }
        function showErrorStyling(input) {
          input.addClass("is-invalid");
        }

        // Function to clear error styling for an input field
        function clearErrorStyling(input) {
          input.removeClass("is-invalid");
        }

        function updateLoginButtonStatus() {
          var emailValid = isValidEmail($("#email").val());
          var passwordValid = !!$("#password").val();
          var isButtonDisabled = !(emailValid && passwordValid);
          var loginButton = $(".btn_login");
          loginButton.prop("disabled", isButtonDisabled);
          if (isButtonDisabled) {
            loginButton.addClass("disabled");
          } else {
            loginButton.removeClass("disabled");
          }
        }

        $("#email").on("input", function () {
          var email = $(this).val();
          if (!email) {
            showErrorMessage($(this), "Email is required*");
          } else if (!isValidEmail(email)) {
            showErrorMessage($(this), "Invalid email format");
          } else {
            clearErrorMessage($(this));
          }
        });

        $("#password").on("input", function () {
          var password = $(this).val();
          if (!password) {
            showErrorMessage($(this), "Password is required*");
          } else {
            clearErrorMessage($(this));
          }
        });

        updateLoginButtonStatus();

        $(".btn_login").click(function (event) {
          event.preventDefault();
          if (isValidEmail($("#email").val()) && $("#password").val()) {
            $("form").submit();
          } else {
            $login_err = "Please fix the errors in the form.";
            $(".error-message-div").html('<img src="images/unsucess-msg.png"><strong>Invalid!</strong> ' + $login_err);
          }
        });
      });

    </script>
</body>





</html>