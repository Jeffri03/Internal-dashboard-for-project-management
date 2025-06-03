<?php
session_start();
session_unset();
session_destroy();
header("Location: login.php"); // Redirect to the admin login page
exit();
?>
