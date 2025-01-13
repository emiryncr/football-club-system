<?php

include "../connection.php";
include "../session.php";

$playerid = $_GET['playerid'];

$sql = "UPDATE users SET clubid = NULL WHERE userid = '$playerid'";

if(mysqli_query($connection, $sql)){
    header("Location: index.php");
}


?>