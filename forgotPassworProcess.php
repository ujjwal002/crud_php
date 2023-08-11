<?php
require_once "./config.php";
$email_err = $password_err = $confirm_err = $confirm_password_err = "";
$confirm_password = $password = "";
session_start();
$fname = $_SESSION['email'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST["password"])) {
        $password_err = "password is required*";
    } else {
        $password = $_POST["password"];
    }
    if (empty($_POST["confirm_password"])) {
        $confirm_password_err = "please confirm your password thus si";
    } else {
        $confirm_password = $_POST["confirm_password"];
    }
    if ($password != $confirm_password) {
        $confirm_err = "password not match";
    } else {
        $sql = "UPDATE register SET password='$password' WHERE email='$fname'";
        if ($link->query($sql) === TRUE) {
            echo '<script type="text/javascript">toastr.success("Registered succesfully")</script>';
            header("location: login.php");
        } else {

        }
    }




    // $sql = "SELECT email from register WHERE email = '" . $email . "'";

    // $result = mysqli_query($link, $sql);
    // $rows = mysqli_fetch_all($result, MYSQLI_ASSOC);
    // $finalMail = $rows[0]['email'];
    // $token = "ujjwal kumar";

    // if($result){
    //     header("location: ./forgotPassworProcess.php");
    // }
    // else{
    //     echo "Password not changed";
    // }
    // mysqli_close($link);


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

</head>

<body>

    <div class="login_section">
        <div class="wrapper relative">
            <div style="display:none" class="meassage_successful_login">You have Successfull Edit </div>
            <div class="heading-top">
                <div class="logo-cebter"><a href="#"><img src="images/at your service_banner.png"></a></div>
            </div>
            <div class="box" style=" width:400px" >
                <div class="outer_div" >
                    

                    <h2>Forgot <span>Password</span></h2>
                    <?php
                    if ($confirm_err) {
                        echo '<div class="error-message-div error-msg"><img src="images/unsucess-msg.png"><strong>Password dont match!</strong></div>';
                    }
                    ?>
                    <form action="<?= htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post"
                        enctype="multipart/form-data" class="margin_bottom" style="width:300px" >
                        <div class="info" >

                            <div class="form-group">
                                <label for="name">Password</label>
                                <input type="password" name="password" placeholder="Password" class="form-control">
                                <small class="text-danger">
                                    <?= $password_err; ?>
                                </small>
                            </div>
                            <div class="form-group">
                                <label for="name">confirm Password</label>
                                <input type="password" name="confirm_password" placeholder="Password"
                                    class="form-control">
                                <small class="text-danger">
                                    <?= $confirm_password_err; ?>
                                </small>
                            </div>

                        </div>
                        <div class="checkbox">
                            <span>Have an account ? <a href="./login.php">Login.</a></span>
                        </div>
                        <button type="submit" class="btn_login">Submit</button>
                    </form>
                </div>
            </div>
        </div>

</body>

</html>