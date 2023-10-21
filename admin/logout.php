<?php
session_start();

unset($_SESSION['admin']);
unset($_SESSION['adminlogin']);
unset($_SESSION['status']);
header('location: ../index.php');
die();
?>