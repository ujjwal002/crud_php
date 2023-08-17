<?php
require_once "./config.php";

$name_err = $email_err = $password_err = $phone_err = $image_err = $error_signup="";
$name = $email = $password = $phone = $image = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    echo "hii";
    // die();

    echo $_FILES["file"]["name"];

    if (empty($_POST["name"])) {
        $name_err = "Name is required*";
    } else {
        $name = ucfirst(trim($_POST["name"]));
        $last_name = $_POST["name"];

    }
    if (empty($_POST["email"])) {
        $email_err = "Email is required*";
    } else {
        $email = ucfirst(trim($_POST["email"]));
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $emailErr = "Invalid email format";
        }
        $last_email = $_POST["email"];
    }
    if (empty($_POST["phone"])) {
        $phone_err = "Phone is required*";
    } else {
        $phone = ucfirst(trim($_POST["phone"]));
        if (!ctype_digit($phone)) {
            $phone_err = "Phone is not valid";
        }
        $last_phone = $_POST["phone"];
    }
    if (empty($_POST["password"])) {
        $password_err = "Password is required";
    } else {
        $password = ucfirst(trim($_POST["password"]));
        if (!ctype_alnum($password)) {
            $password_err = "Password is not valid";
        }
        $last_password = $_POST["password"];
    }
    if (!empty($_FILES["image"]["name"])) {
        $target_dir = "uploads/";
        $target_file = $target_dir . basename($_FILES["image"]["name"]);
        // echo $target_file;
        // echo $_FILES["image"]["name"];
        if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
            $image = $target_file;
            // echo $image;
        } else {
            $image_err = "Failed to upload image.";
        }
        $last_image = $image;
    }
    else{
        $image_err = "Please upload image.";
    }
    // echo $image;
    // echo "hiii";
    // echo $name_err;
    // echo $email_err;
    // echo $password_err;
    // echo $phone_err;
    // echo $image_err;
    // echo $image;
    // echo "hiii";
    // die();
    if (empty($name_err) && empty($email_err) && empty($password_err) && empty($phone_err) && empty($image_err)) {

        $sql = "INSERT INTO register (name, email, phone, Password, image) VALUES ('$name', '$email', '$phone', '$password', '$image');";
        // echo $sql;


        if ($link->query($sql) === TRUE) {
            echo '<script type="text/javascript">toastr.success("Registered succesfully")</script>';
            header("location: login.php");
        } else {
            $error_signup="please choose another email address";
        }



    }
    mysqli_close($link);

}

?>
<!DOCTYPE html>
<html>

<head>
    <title>Crud with php</title>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.4.1/css/all.css"
        integrity="sha384-5sAR7xN1Nv6T6+dT2mhtzEpVJvfS3NScPQTrOxhwjIuvcA67KV2R5Jz6kr4abQsz" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700" rel="stylesheet">
    <link href="css/dashboard.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


</head>
<!-- <style>
    .box {
        background: none repeat scroll 0 0 #ffffff;
        border-radius: 5px;
        box-shadow: 0 0 7px rgba(0, 0, 0, 0.06);
        height: 345px;
        margin: 0 auto;
        position: relative;
        width: 345px;
    }
    .login_section{
        display: flex;

    }
</style> -->

<body>

    <div class="login_section">
        <div class="wrapper relative">
            <div style="display:none" class="meassage_successful_login">You have Successfull Edit </div>
            <div class="heading-top">
                <div class="logo-cebter"><a href="#"><img src="images/at your service_banner.png"></a></div>
            </div>
            <div class="box" style="width:400px ">
                <div class="outer_div" style=" background-color:white;" >

                    <h2>Admin <span>SignUp</span></h2>
                    <!-- <div class="error-message-div error-msg"><img
                            src="images/unsucess-msg.png"><strong>Invalid!</strong> username
                        or password </div> -->
                    <?php
                    if ($error_signup) {
                        echo '<div class="error-message-div error-msg"><img
                        src="images/unsucess-msg.png"><strong>Email already!</strong> present</div>';
                    }
                    ?>

                    <form action="<?= htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post"
                        enctype="multipart/form-data" class="margin_bottom">
                        <div class="info">
                            <div class="form-group" style="width:331px">
                                <label for="name">Full Name<span style="color:red;">*</span></label>
                                <input type="text" name="name" class="form-control <?php if (!empty($name_err))
                                    echo ' is-invalid'; ?>" value="<?= $last_name; ?>"  id="name_val" >
                                <small class="text-danger">
                                    <?= $name_err; ?>
                                </small>
                            </div>
                            <div class="form-group" style="width:331px">
                                <label for="name">Email<span style="color:red;">*</span></label>
                                <input type="text" name="email" placeholder="" class="form-control <?php if (!empty($email_err))
                                    echo ' is-invalid'; ?>" value="<?= $last_email; ?>" id="email_val" >
                                <small class="text-danger">
                                    <?= $email_err; ?>
                                </small>
                            </div>
                            <div class="form-group" style="width:331px">
                                <label for="name">Phone number<span style="color:red;">*</span></label>
                                <input type="text" name="phone" placeholder="" class="form-control <?php if (!empty($phone_err))
                                    echo ' is-invalid'; ?>" value="<?= $last_phone; ?>" id="phone_val" >
                                <small class="text-danger">
                                    <?= $phone_err; ?>
                                </small>
                            </div>
                            <div class="form-group" style="width:331px">
                                <label for="name">Password<span style="color:red;">*</span></label>
                                <input type="password" name="password" placeholder="" class="form-control <?php if (!empty($password_err))
                                    echo ' is-invalid'; ?>" value="<?= $last_password; ?>" id="password_val">
                                <small class="text-danger">
                                    <?= $password_err; ?>
                                </small>
                            </div>
                            <div class="form-group" style="width:331px">
                                <label for="name">Upload image<span style="color:red;">*</span></label>
                                <input type="file" name="image" value="Upload File" class="form-control <?php if (!empty($image_err))
                                    echo ' is-invalid'; ?>" value="<?= $last_image; ?>" id="image_val" >
                                <small class="text-danger">
                                    <?= $image_err; ?>
                                </small>

                            </div>
                        </div>
                        <div class="checkbox" style="font-size: 14px; margin-bottom: 5px;">
                            <span>Have an account ? <a href="./login.php">Login.</a></span>
                        </div>
                        <button type="submit" class="btn_login login-button">SignUp</button>
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
        function isValidPhone(phone){
            if(phone.length ==10){
                return true;
            }
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
          var emailValid = isValidEmail($("#email_val").val());
          var passwordValid = !!$("#password_val").val();
          var nameValid = !!$("#name_val").val();
          var phoneValid = isValidPhone($("#phone_val").val());
        //   var imageValid = !!$("#image_val").val();
          var isButtonDisabled = !(emailValid && passwordValid&& nameValid && phoneValid);
          var loginButton = $(".btn_login");
          loginButton.prop("disabled", isButtonDisabled);
          if (isButtonDisabled) {
            loginButton.addClass("disabled");
          } else {
            loginButton.removeClass("disabled");
          }
        }

        $("#email_val").on("input", function () {
          var email = $(this).val();
          if (!email) {
            showErrorMessage($(this), "Email is required");
          } else if (!isValidEmail(email)) {
            showErrorMessage($(this), "Invalid email format");
          } else {
            clearErrorMessage($(this));
          }
        });

        $("#password_val").on("input", function () {
          var password = $(this).val();
          if (!password) {
            showErrorMessage($(this), "Password is required");
          } else {
            clearErrorMessage($(this));
          }
        });

        $("#phone_val").on("input", function () {
          var phone = $(this).val();
          if (!phone) {
            showErrorMessage($(this), "Phone number required");
          }else if(!isValidPhone(phone)){
            showErrorMessage($(this), "Phone number must be of 10 digit*");

          }
           else {
            clearErrorMessage($(this));
          }
        });

        updateLoginButtonStatus();

        $(".btn_login").click(function (event) {
        //   event.preventDefault();
          if (isValidEmail($("#email").val()) && $("#password").val()) {
            $("form").submit();
          } else {
            $error_signup = "Please fix the errors in the form.";
            $(".error-message-div").html('<img src="images/unsucess-msg.png"><strong>Invalid!</strong> ' + $login_err);
          }
        });
      });

    </script>

</body>

</html>