<?php

include "../connection.php";
include "../session.php";

if(isset($_GET['userid'])){
    $id = $_GET['userid'];
    $sql = "DELETE FROM users WHERE userid = '$id'";
    $result = mysqli_query($connection, $sql);
    if($result){
        header("Location: userlist.php");
    }
}

?>