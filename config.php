<?php
mysqli_report(MYSQLI_REPORT_OFF);

define("DB_SERVER", "localhost");
define("DB_USERNAME", "root");
define("DB_PASSWORD", "root");
define("DB_NAME", "admin");


$link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);


if (!$link) {
  echo "Connection error: " . mysqli_connect_error();
}

?>