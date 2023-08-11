<?php
// echo $_SESSION['loggedin'];
// die();
if (isset($_GET["id"]) && !empty(trim($_GET["id"]))) {

    require_once "./config.php";


    $id = trim($_GET["id"]);


    $sql = "DELETE FROM employees WHERE id = ?";

    if ($stmt = mysqli_prepare($link, $sql)) {
        mysqli_stmt_bind_param($stmt, "i", $param_id);

        $param_id = $id;

        if (mysqli_stmt_execute($stmt)) {
            echo "<script>" . "window.location.href='./list-users.php'" . "</script>";
            exit;
        } else {
            echo "Oops ! Something went wrong. Please try again later.";
        }
    }

    mysqli_stmt_close($stmt);

    mysqli_close($link);
} else {
    echo "<script>" . "window.location.href='./list-users.php'" . "</script>";
    exit;
}