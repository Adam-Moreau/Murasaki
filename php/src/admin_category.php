<?php

require_once 'auth.php';
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
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="style/js/category.js"></script>
        <script>
            // Event listener for edit category link
            $(document).on("click", ".edit-category", function() {
                makeEditable($(this).data("category-id"));
            });


            // Event listener for delete category link
            $(document).on('click', '.delete-category', function(e) {
                e.preventDefault();
                var categoryId = $(this).data('category-id');
                // Call a function to handle deleting the category with this ID
            });

            $(document).ready(function() {
                updateCategoriesTable() ;
                // Submit form data using AJAX when the form is submitted
                $('#addCategoryForm').submit(function(e) {
                    e.preventDefault();
                    var kanji = $('#kanji').val();
                    var category = $('#category').val();
                    $.ajax({
                        url: 'sql/insert.php',
                        method: 'POST',
                        data: {
                            function_name: 'addCategory',
                            kanji: kanji,
                            category: category
                        },
                        success: function(response) {
                            if (response.trim() === 'Category added successfully') {
                                // Clear the form
                                $('#kanji').val('');
                                $('#category').val('');

                                // Retrieve the updated categories data from the server using AJAX
                                updateCategoriesTable() ;

                            } else {
                                console.log(response);
                            }
                        }
                    });
                });
            });

        </script>

        <title>Admin Managment</title>
    </head>
    <body>
        <?php include 'navbar.php'; ?>

        <?php include 'sidebar.php'; ?>


        <div class="container d-flex justify-content-center">
            <div class='category align-items-center mx-auto'>
                <h1 class='title'>Categories</h1>
                <button class="btnAddCategory" onclick="showAddCategoryForm()">Ajouter une catégorie</button>
                <div id="addCategoryForm" style="display:none;">
                    <form method="POST">
                        
                        <input type="text" id="kanji" name="kanji" placeholder="Kanji">
                        
                        
                        <input class="inputForm" type="text" id="category" name="category" placeholder="Catégorie">
                        
                        <input class="btnAddCategory" type="submit" value="Ajouter">
                    </form>
                </div>
                <table class='table'>
                    <thead>
                        <tr>
                            <th>Kanji</th>
                            <th>Nom</th>
                            <th>Editer</th>
                            <th>Supprimer</th>
                        </tr>
                    </thead>

                    <tbody id="categoryTable">
                   
                    </tbody>
                </table>
            </div>
        </div>


    </body>
</html>