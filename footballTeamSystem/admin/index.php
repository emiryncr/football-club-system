<?php

include "../connection.php";
include "../session.php";

$sql = "SELECT * FROM club";
$result = mysqli_query($connection, $sql);

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
    <hr>

    <div class="container p-2">
      <h3>Clubs</h3>
        <div class="row p-3 row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-3">
        <?php 
            while ($row = mysqli_fetch_assoc($result)) {
                $imageData = $row['img'];
                $base64Image = base64_encode($imageData);
            echo "<div class=\"col\">
                <div class=\"card h-100 bg-success bg-opacity-25\">
                    <div class=\"d-flex justify-content-center align-items-center\">
                        <img class=\" p-2\" src=\"data:image/jpeg;base64," . $base64Image . "\" alt=\"Club Image\" style=\"max-height: 200px; max-width: 200px; \">
                    </div>
                    <div class=\"card-body\">
                        <h4 class=\"card-title\">{$row['clubname']}</h4>
                    </div>
                    <div class=\"card-footer d-flex justify-content-between \">
                    <a href=\"clubdetails.php?id={$row['clubid']}\" class=\"btn btn-warning\">View </a>
                    <a href=\"editclub.php?id={$row['clubid']}\" class=\"btn btn-success\">Edit </a>
                    <a href=\"deleteclub.php?id={$row['clubid']}\" class=\"btn btn-danger\">Delete </a>
                  </div>
                </div>
                </div>";
            }
        ?>
        </div>
    </div>



    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>
  </body>
</html>