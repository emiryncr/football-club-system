<?php

include "../connection.php";
include "../session.php";

$userid = $_GET['userid'] ?? 0;

$sql = "SELECT * FROM users WHERE userid = '$userid'";
$result = mysqli_query($connection, $sql);
$row = mysqli_fetch_assoc($result);

if(isset($_POST['submit'])){
    $up_username = $_POST['username'];
    $up_userid = $_POST['id'];
    $up_role = $_POST['role'];

    $sql = "UPDATE users SET username = '$up_username', role = '$up_role' WHERE userid = '$up_userid'";

    $result = mysqli_query($connection, $sql);

    if($result){
        echo "<script>alert('User updated successfully')</script>";
        header("Location: userlist.php");
    } else {
        echo "<script>alert('Failed to updated user')</script>";
    }
}

?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Football Club System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
  </head>
  <body class="bg-success text-white bg-opacity-75">

    <?php include "nav.php"; ?>

    <div class="d-flex justify-content-center align-items-center">
    <form class="text-white m-3" action="edituser.php" method="post" style="max-width: 400px; width: 100%;" enctype="multipart/form-data">
    
    <div class="d-flex flex align-items-center gap-2">
        <a href="userlist.php" class="btn btn-danger">Back</a>
        <h1>Edit Player</h1>  
    </div>
    
        <div class="mb-3 text-white">
              <label for="username" class="form-label">Club Name</label>
              <input type="text" name="username" class="form-control text-dark" id="username" required value="<?php echo $row['username'] ?>">
         </div>
         <div class="mb-3 text-white">
              <label for="role" class="form-label">Role</label>
              <select class="form-select" name="role" id="">
                    <option value="<?php echo $row['role'] ?>">Update role</option>
                    <option value="footballer">Footballer</option>
                    <option value="manager">Manager</option>
              </select>
         </div>
         <div class="mb-3">
              <button type="submit" name="submit" class="btn btn-warning w-100 ">Update</button>
         </div>
         <input type="hidden" name="id" value="<?php echo $userid; ?>">
    </form>
</div>



    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>
  </body>
</html>