<?php

include "../connection.php";
include "../session.php";

$clubid = $_GET['clubid'];

$sql = "UPDATE users SET clubid = '$clubid' WHERE userid = '{$_SESSION['id']}'";

if(mysqli_query($connection, $sql)){
    $_SESSION['clubid'] = $clubid;
    header("Location: index.php");
}

?>