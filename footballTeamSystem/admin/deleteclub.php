<?php

include "../connection.php";
include "../session.php";

$clubid = $_GET['id'] ?? 0;

$sql = "DELETE FROM club WHERE clubid = '$clubid'";

if(mysqli_query($connection, $sql)){
    header("Location: index.php");
}  

?>