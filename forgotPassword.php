<?php
require_once "./config.php";


$email_err = $password_err = $confirm_err = "";
$email = $password = "";
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
    if (empty($email_err)) {
        $sql = "SELECT email from register WHERE email = '" . $email . "'";

        $result = mysqli_query($link, $sql);
        $rows = mysqli_fetch_all($result, MYSQLI_ASSOC);
        $finalMail = $rows[0]['email'];
        $token = "ujjwal kumar";

        // die();
        if ($finalMail) {
            header("location: ./forgotPassworProcess.php");
            session_start();
            $_SESSION["email"] = $email;
        } else {
            $confirm_err = "Please enter a valid email";
        }
        mysqli_close($link);
    }
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

<body>

    <div class="login_section">
        <div class="wrapper relative">
            <!-- <div style="display:none" class="meassage_successful_login">You have Successfull Edit </div> -->
            <div class="heading-top">
                <div class="logo-cebter"><a href="#"><img src="images/at your service_banner.png"></a></div>
            </div>
            <div class="box" style=" width:400px; height:300px;">
                <div class="outer_div">

                    <h2>Forgot <span>Password</span></h2>
                    <div style="display:block; height:40px">
                        <?php
                        if ($confirm_err) {
                            echo '<div class="error-message-div error-msg display:block"><img
                        src="images/unsucess-msg.png"><strong>Email !</strong> not found
                     </div>';
                        }
                        ?>
                    </div>
                    <form action="<?= htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post"
                        enctype="multipart/form-data" class="margin_bottom">
                        <div class="info">
                            <div class="form-group" style=" width:331px">
                                <label for="name">Email</label>
                                <input type="text" name="email" placeholder="" class="form-control<?php if (!empty($email_err))
                                    echo ' is-invalid'; ?>" id="email" value="<?= $last_email; ?>">
                                <small class="text-danger">
                                    <?= $email_err; ?>
                                </small>
                            </div>

                        </div>
                        <div class="checkbox" style="font-size: 14px; margin-bottom: 10px;">
                            <span>Have an account ? <a href="./login.php">Login.</a></span>
                        </div>
                        <button type="submit" class="btn_login">Submit</button>
                    </form>
                </div>
            </div>
        </div>

</body>

</html>