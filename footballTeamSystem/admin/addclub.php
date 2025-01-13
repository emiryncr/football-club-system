<?php

include "../connection.php";
include "../session.php";

if(isset($_POST['submit'])){
    $clubname = $_POST['clubname'];
    $img = addslashes(file_get_contents($_FILES['img']['tmp_name']));

    $sql = "INSERT INTO club (clubname,img) VALUES ('$clubname','$img')";
    $result = mysqli_query($connection, $sql);

    if($result){
        echo "<script>alert('Club added successfully')</script>";
    } else {
        echo "<script>alert('Failed to add club')</script>";
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

    <h3 class="m-2">Hello, <?php echo $_SESSION['username'] ?></h3>


    <div class="d-flex justify-content-center align-items-center">
    <form class="text-white m-3" action="addclub.php" method="post" style="max-width: 400px; width: 100%;" enctype="multipart/form-data">
    <h1>Add Club</h1>    
    <div class="mb-3 text-white">
              <label for="clubname" class="form-label">Club Name</label>
              <input type="text" name="clubname" class="form-control text-dark" id="clubname" required>
         </div>
         <div class="mb-3 text-white">
              <label for="img" class="form-label">Club Image</label>
              <input type="file" name="img" class="form-control text-dark" id="img" required accept=".jpg, .jpeg, .png">
         </div>
         <div class="mb-3">
              <button type="submit" name="submit" class="btn btn-warning w-100 ">Add </button>
         </div>
    </form>
</div>



    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>
  </body>
</html>