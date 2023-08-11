<?php
require_once "./config.php";

$name_err = $email_err = $password_err = $phone_err = $image_err = "";
$name = $email = $password = $phone = $image = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    echo $_FILES["file"]["name"];

    if (empty($_POST["name"])) {
        $name_err = "Name is required*";
    } else {
        $name = ucfirst(trim($_POST["name"]));

    }
    if (empty($_POST["email"])) {
        $email_err = "email is required*";
    } else {
        $email = ucfirst(trim($_POST["email"]));
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $emailErr = "Invalid email format";
        }
    }
    if (empty($_POST["phone"])) {
        $phone_err = "Phone is required*";
    } else {
        $phone = ucfirst(trim($_POST["phone"]));
        if (!ctype_alpha($phone)) {
            $phone_err = "Phone is not valid*";
        }
    }
    if (empty($_POST["password"])) {
        $password_err = "Password is required*";
    } else {
        $password = ucfirst(trim($_POST["password"]));
        if (!ctype_alnum($password)) {
            $password_err = "Password is not valid*";
        }
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
        echo $sql;


        if ($link->query($sql) === TRUE) {
            echo '<script type="text/javascript">toastr.success("Registered succesfully")</script>';
            header("location: list-users.php");
        } else {
            echo "Error: " . $sql . "<br>";
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

</head>

<body>

    <div class="login_section">
        <div class="wrapper relative">
            <div style="display:none" class="meassage_successful_login">You have Successfull Edit </div>
            <div class="heading-top">
                <div class="logo-cebter"><a href="#"><img src="images/at your service_banner.png"></a></div>
            </div>
            <div class="box" style="width:400px ">
                <div class="outer_div">

                    <h2>Admin <span>SignUp</span></h2>
                    <!-- <div class="error-message-div error-msg"><img
                            src="images/unsucess-msg.png"><strong>Invalid!</strong> username
                        or password </div> -->
                    <?php
                    if ($login_err) {
                        echo '<div class="error-message-div error-msg"><img
                        src="images/unsucess-msg.png"><strong>Invalid!</strong> username
                    or password </div>';
                    }
                    ?>

                    <form action="<?= htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post"
                        enctype="multipart/form-data" class="margin_bottom">
                        <div class="info">
                            <div class="form-group" style="width:331px">
                                <label for="name">Full Name</label>
                                <input type="text" name="name" class="form-control" placeholder="Full name">
                                <small class="text-danger">
                                    <?= $name_err; ?>
                                </small>
                            </div>
                            <div class="form-group" style="width:331px">
                                <label for="name">Email</label>
                                <input type="text" name="email" placeholder="Email" class="form-control">
                                <small class="text-danger">
                                    <?= $email_err; ?>
                                </small>
                            </div>
                            <div class="form-group" style="width:331px">
                                <label for="name">Phone number</label>
                                <input type="text" name="phone" placeholder="Phone number" class="form-control">
                                <small class="text-danger">
                                    <?= $phone_err; ?>
                                </small>
                            </div>
                            <div class="form-group" style="width:331px">
                                <label for="name">Password</label>
                                <input type="password" name="password" placeholder="Password" class="form-control">
                                <small class="text-danger">
                                    <?= $password_err; ?>
                                </small>
                            </div>
                            <div class="form-group" style="width:331px">
                                <label for="name">Password</label>
                                <input type="file" name="image" value="Upload File" class="form-control">
                                <small class="text-danger">
                                    <?= $password_err; ?>
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