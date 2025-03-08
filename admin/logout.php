<?php
session_start();
session_destroy();
setcookie("6oxM5UA2E65", "", time() - 3600, '/');
header("Location:login.php");
exit();
?>
