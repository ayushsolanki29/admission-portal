<?php

$user = "root";
$pass = "";
$host = "localhost";
$db_name = "admission_portal";
$domain = "http://localhost/collegenew.com";

$con = mysqli_connect($host, $user, $pass, $db_name);
if (!$con) {
    echo "db connection faild";
}

if (!isset($_COOKIE['collegenew-viewed'])) {
    // Update database and set cookie
    $sql = "UPDATE settings SET `data1` = `data1` + 1 WHERE id = 1";
    $con->query($sql);

    setcookie('collegenew-viewed', true, time() + (7 * 24 * 60 * 60));
}
