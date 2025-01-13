<?php

include "../connection.php";
include "../session.php";

$clubid = $_GET['id'] ?? 0;

$sql = "SELECT * FROM club WHERE clubid = '$clubid'";
$result = mysqli_query($connection, $sql);
$row = mysqli_fetch_assoc($result);

if(isset($_POST['submit'])){
    $up_clubname = $_POST['clubname'];
    $up_clubid = $_POST['id'];

    if(!empty($_FILES['img']['tmp_name'])) {
        $up_img = addslashes(file_get_contents($_FILES['img']['tmp_name']));
        $sql = "UPDATE club SET clubname = '$up_clubname', img = '$up_img' WHERE clubid = '$up_clubid'";
    } else {
        $sql = "UPDATE club SET clubname = '$up_clubname' WHERE clubid = '$up_clubid'";
    }
    
    $result = mysqli_query($connection, $sql);

    if($result){
        echo "<script>alert('Club updated successfully')</script>";
        header("Location: index.php");
    } else {
        echo "<script>alert('Failed to updated club')</script>";
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
    <form class="text-white m-3" action="editclub.php" method="post" style="max-width: 400px; width: 100%;" enctype="multipart/form-data">
    <div class="d-flex flex align-items-center gap-2">
        <a href="index.php" class="btn btn-danger">Back</a>
        <h1>Edit Club</h1>  
    </div>   
    <div class="mb-3 text-white">
              <label for="clubname" class="form-label">Club Name</label>
              <input type="text" name="clubname" class="form-control text-dark" id="clubname" required value="<?php echo $row['clubname'] ?>">
         </div>
         <div class="mb-3 text-white">
              <label for="img" class="form-label">Club Image</label>
              <input type="file" name="img" class="form-control text-dark" id="img" accept=".jpg, .jpeg, .png">
         </div>
         <div class="mb-3">
              <button type="submit" name="submit" class="btn btn-warning w-100 ">Update</button>
         </div>
         <input type="hidden" name="id" value="<?php echo $clubid; ?>">
    </form>
</div>



    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>
  </body>
</html>