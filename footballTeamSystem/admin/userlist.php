<?php

include "../connection.php";
include "../session.php";

$sqlClubs = "SELECT * FROM club";
$resultClubs = mysqli_query($connection, $sqlClubs);

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

    <div class="container p-2">
    
    <?php 
    $allClubs = [];
    $sqlClubs = "SELECT * FROM club";
    $resultAllClubs = mysqli_query($connection, $sqlClubs);
    while ($club = mysqli_fetch_assoc($resultAllClubs)) {
        $allClubs[] = $club;
    }

    $sqlNotTransfered = "SELECT * FROM users WHERE clubid IS NULL AND role != 'admin'";
    $resultNotTransfered = mysqli_query($connection, $sqlNotTransfered);
    if (mysqli_num_rows($resultNotTransfered) > 0) {
        echo "<div class=\"\">
            <h2 class=\"text-center\">Not Transfered  Yet</h2>
            <div class=\"row p-3 row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-3\">";

        while ($row = mysqli_fetch_assoc($resultNotTransfered)) {
            echo "<div class=\"col\">
                <div class=\"card h-100 bg-success bg-opacity-25\">
                    <div class=\"card-body\">
                        <h4 class=\"card-title\">{$row['username']}</h4>
                        <p class=\"card-text\">
                            {$row['role']}
                        </p>
                    </div>
                    <div class=\"card-footer\">
                        <button type=\"button\" class=\"btn btn-secondary\" 
                            data-bs-toggle=\"modal\" 
                            data-bs-target=\"#exampleModal\" 
                            data-userid=\"{$row['userid']}\">Transfer</button>
                        <a href=\"edituser.php?userid={$row['userid']}\" class=\"btn btn-warning m-1\">Edit</a>
                        <a href=\"deleteuser.php?userid={$row['userid']}\" class=\"btn btn-danger m-1\">Delete</a>
                    </div>
                </div>
            </div>";
        }

        echo "</div></div>";
    }

    while ($rowClub = mysqli_fetch_assoc($resultClubs)) {
        echo "<div class=\"\">
            <h2 class=\"text-center\">{$rowClub['clubname']}</h2>
            <div class=\"row p-3 row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-3\">";

        $clubid = $rowClub['clubid'];
        $sql = "SELECT * FROM users WHERE clubid = '$clubid'";
        $result = mysqli_query($connection, $sql);

        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<div class=\"col\">
                    <div class=\"card h-100 bg-success bg-opacity-25\">
                        <div class=\"card-body\">
                            <h4 class=\"card-title\">{$row['username']}</h4>
                            <p class=\"card-text\">{$row['role']}</p>
                        </div>
                        <div class=\"card-footer\">
                            <button type=\"button\" class=\"btn btn-secondary\" 
                                data-bs-toggle=\"modal\" 
                                data-bs-target=\"#exampleModal\" 
                                data-userid=\"{$row['userid']}\" 
                                data-clubid=\"{$row['clubid']}\">Transfer</button>
                            <a href=\"edituser.php?userid={$row['userid']}\" class=\"btn btn-warning m-1\">Edit</a>
                            <a href=\"deleteuser.php?userid={$row['userid']}\" class=\"btn btn-danger m-1\">Delete</a>
                        </div>
                    </div>
                </div>";
            }
        } else {
            echo "<p class=\"text-muted\">No users found for this club.</p>";
        }

        echo "</div></div>";
    }
    ?>
</div>


<div class='modal fade' id='exampleModal' tabindex='-1' aria-labelledby='exampleModalLabel' aria-hidden='true'>
    <div class='modal-dialog'>
        <div class='modal-content'>
            <div class='modal-header'>
                <h1 class='modal-title fs-5 text-dark' id='exampleModalLabel'>Transfer Player</h1>
                <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
            </div>
            <div class='modal-body'>
                <form id="transferForm" method="POST" action="transferuser.php">
                    <input type="hidden" name="userid" id="modalUserId">
                    <div class='mb-3'>
                        <select class="form-select" name="newclubid" id="clubSelect">
                            <option value="">Select Club</option>
                            <?php
                            foreach ($allClubs as $club) {
                                echo "<option value='{$club['clubid']}'>{$club['clubname']}</option>";
                            }
                            ?>
                        </select>
                    </div>
                </form>
            </div>
            <div class='modal-footer'>
                <button type='button' class='btn btn-secondary' data-bs-dismiss='modal'>Close</button>
                <button type='submit' name="transfer" form="transferForm" class='btn btn-primary'>Transfer</button>
            </div>
        </div>
    </div>
</div>


    <script>
        const exampleModal = document.getElementById('exampleModal');
        exampleModal.addEventListener('show.bs.modal', event => {
            const button = event.relatedTarget; 
            const userId = button.getAttribute('data-userid');
            const currentClubId = button.getAttribute('data-clubid');
            
            document.getElementById('modalUserId').value = userId;

            const clubSelect = document.getElementById('clubSelect');
            Array.from(clubSelect.options).forEach(option => {
                option.style.display = option.value === currentClubId ? 'none' : 'block';
            });
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>
  </body>
</html>