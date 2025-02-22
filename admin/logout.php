<?php
session_start();
session_destroy();
setcookie("0ffac8ca", "", time() - 3600, '/');
header("Location:login.php");
exit();
?>
