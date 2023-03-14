<?php

session_start(); // Start a PHP session



// Check if the user is logged in and is an admin
if (
    !isset($_SESSION['user_id']) ||
    !isset($_SESSION['is_admin']) ||
    !$_SESSION['is_admin']
) {
    // User is not logged in or is not an admin, redirect to the login page
    header('Location: mithrandir-portal.php');
    exit();
}
require_once 'sql/get.php';
// User is logged in and is an admin, display the admin panel
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" crossorigin="anonymous" />
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
        <link rel="stylesheet" href="style/style.css">
        <title>Admin Managment</title>
    </head>
    <body>
        <?php include 'navbar.php'; ?>

        <?php include 'sidebar.php' ; ?>


        <div class="container">
            <div class="row d-flex justify-content-between">  
                <div class="col-3 managmentBox shadow">
                    <h1 class="boxTitle"> <?php $nbrKanji = countKanjis();
                                                echo 'Nombre de kanjis : '. $nbrKanji ; ;?></h1>
                </div>
            </div>
        </div>
        <a href='logout.php'>Logout</a> 
    </body>
</html>