<?php

include "../connection.php";

if(isset($_POST['submit'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $role = $_POST['role'];
    $clubid = $_POST['club'];

    
    if($clubid == "NULL") {
     $sql = "INSERT INTO users (username, password, role) VALUES ('$username', '$password', '$role')";
    }else{
     $sql = "INSERT INTO users (username, password, role, clubid) VALUES ('$username', '$password', '$role', '$clubid')";
    }

    $result = mysqli_query($connection, $sql);

    if($result) {
        header("Location: login.php");
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($connection);
    }
}

$sql = "SELECT * FROM club";
$result = mysqli_query($connection, $sql);

?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sign-up</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
  </head>
  <body class="bg-success text-white bg-opacity-75">

    

  <div class="d-flex justify-content-center align-items-center vh-100">
    <form class="text-white m-3" action="signup.php" method="post" style="max-width: 400px; width: 100%;">
    <h1>Signup to start journey..</h1>    
    <div class="mb-3 text-white">
              <label for="username" class="form-label">Username</label>
              <input type="text" name="username" class="form-control text-dark" id="username" required>
         </div>
         <div class="mb-3 text-white">
              <label for="password" class="form-label">Password</label>
              <input type="password" name="password" class="form-control text-dark" id="password" required>
         </div>
          <div class="mb-3 text-white">
               <label for="club" class="form-label">Club</label>
                 <select name="club" class="form-select" id="club">
                    <option value="NULL">Select Club</option>
                    <?php
                    while ($row = mysqli_fetch_assoc($result)) {
                         echo "<option value=\"{$row['clubid']}\">{$row['clubname']}</option>";
                    }
                    ?>
               </select>
          </div>
         <div class="mb-3 text-white">
              <label for="role" class="form-label">Role</label>
              <select name="role" class="form-select" id="role">
                    <option value="admin">Admin</option>
                    <option value="manager">Manager</option>
                    <option value="footballer" selected>Footballer</option>
              </select>
         </div>
         <div class="mb-3">
              <p>Login? <a href="login.php" class="text-warning">Click here</a></p>
         </div>
         <div class="mb-3">
              <button type="submit" name="submit" class="btn btn-primary w-100 ">Signup</button>
         </div>
    </form>
</div>


    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>
  </body>
</html>