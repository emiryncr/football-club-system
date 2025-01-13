<?php

include "../connection.php";

if(isset($_POST['submit'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $role = $_POST['role'];

    $sql = "SELECT * FROM users WHERE username =  '$username'";
    $result = mysqli_query($connection, $sql);

    if(mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        if($row['password'] == $password && $row['role'] == $role) {
            session_start();
            $_SESSION['id'] = $row['userid'];
            $_SESSION['username'] = $username;
            $_SESSION['role'] = $role;
            $_SESSION['clubid'] = $row['clubid'];
            $_SESSION['loggedin'] = true;

            if($role == 'admin') {
                header("Location: ../admin/index.php");
            } else if($role == 'manager') {
                header("Location: ../manager/index.php");
            } else if($role == 'footballer') {
                header("Location: ../footballer/index.php");
            }
        } else {
            echo "Invalid password";
        }
    } else {
        echo "Invalid username";
    }
}


?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
  </head>
  <body class="bg-success text-white bg-opacity-75">


  <div class="d-flex justify-content-center align-items-center vh-100">
    <form class="text-white m-3" action="login.php" method="post" style="max-width: 400px; width: 100%;">
    <h1>Login to start journey..</h1>    
    <div class="mb-3 text-white">
              <label for="username" class="form-label">Username</label>
              <input type="text" name="username" class="form-control text-dark" id="username" required>
         </div>
         <div class="mb-3 text-white">
              <label for="password" class="form-label">Password</label>
              <input type="password" name="password" class="form-control text-dark" id="password" required>
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
              <p>Signup? <a href="signup.php" class="text-warning">Click here</a></p>
         </div>
         <div class="mb-3">
              <button type="submit" name="submit" class="btn btn-primary w-100 ">Login</button>
         </div>
    </form>
</div>


    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>
  </body>
</html>