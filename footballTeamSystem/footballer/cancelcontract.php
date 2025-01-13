<?php

include "../connection.php";
include "../session.php";

$playerid = $_GET['playerid'];

$sql = "UPDATE users SET clubid = NULL WHERE userid = '$playerid'";

if(mysqli_query($connection, $sql)){
    $_SESSION['clubid'] = null;
    header("Location: index.php");
}

?>