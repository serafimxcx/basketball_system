<?php
// Start the session
include("connect.php");
session_start();

session_unset();
session_destroy();

// Redirect to the login page
header('Location: index.php');
exit();
?>