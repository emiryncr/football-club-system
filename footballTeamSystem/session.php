<?php
session_start();
if ($_SESSION["loggedin"] !== true) {
    header("Location: ../auth/login.php");
    exit();
}
?>