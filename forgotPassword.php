<?php
require_once "./config.php";


$email_err = $password_err = $confirm_err = "";
$email = $password = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (empty($_POST["email"])) {
        $email_err = "email is required*";
    } else {
        $email = $_POST["email"];
    }

    
    $sql = "SELECT email from register WHERE email = '" . $email . "'";

    $result = mysqli_query($link, $sql);
    $rows = mysqli_fetch_all($result, MYSQLI_ASSOC);
    $finalMail = $rows[0]['email'];
    $token = "ujjwal kumar";
   
    // die();
    if($finalMail){
        header("location: ./forgotPassworProcess.php");
        session_start();
        $_SESSION["email"] = $email;
    }
    else{
        $confirm_err = "Please enter a valid email";
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

</head>

<body>

<div class="login_section">
        <div class="wrapper relative">
            <div style="display:none" class="meassage_successful_login">You have Successfull Edit </div>
            <div class="heading-top">
                <div class="logo-cebter"><a href="#"><img src="images/at your service_banner.png"></a></div>
            </div>
            <div class="box" style="height:331px">
                <div class="outer_div">

                    <h2>Forgot <span>Password</span></h2>
                    <form action="<?= htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post"
                        enctype="multipart/form-data" class="margin_bottom">
                        <div class="info">
                            <div class="form-group">
                                <label for="name">Email</label>
                                <input type="text" name="email" placeholder="Email" class="form-control">
                                <small class="text-danger">
                                    <?= $email_err; ?>
                                </small>
                            </div>
                            <!-- <div class="form-group">
                                <label for="name">Password</label>
                                <input type="password" name="password" placeholder="Password" class="form-control">
                                <small class="text-danger">
                                    <?= $password_err; ?>
                                </small>
                            </div> -->
                           
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