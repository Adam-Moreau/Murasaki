<?php

require_once 'auth.php' ;

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

        <?php include 'sidebar.php'; ?>

        <?php $categories[] = getCategories() ; ?>


        <div class="container d-flex justify-content-center">
            <div class='category align-items-center mx-auto'>
                <h1 class='title'>Categories</h1>
                <table class='table'>
                    <thead>
                        <tr>
                            <th>Image</th>
                            <th>Nom</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        foreach( $categories as $category) {

                            echo '<tr>' ;
                            echo '<td>'. $category['image'] . '</td>' ;
                            echo '<td>'. $category['name'] . '</td>' ;
                            echo '</tr>' ;
                        }

                        ?>
                    </tbody>
                </table>
            </div>
        </div>

        <a href='logout.php'>Logout</a> 
    </body>
</html>