<?php

include "../connection.php";
include "../session.php";

if(isset($_POST['transfer'])) {
    $userid = $_POST['userid'];
    $clubid = $_POST['newclubid'];

    $sql = "UPDATE users SET clubid = '$clubid' WHERE userid = '$userid'";
    $result = mysqli_query($connection, $sql);

    if($result) {
        header("Location: userlist.php");
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($connection);
    }
}







?>