<?php

require_once 'auth.php';
require_once 'sql/get.php';
require_once 'sql/edit.php';

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
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.css" />
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="style/js/kanji.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.js"></script>
    <script>
        // Event listener for edit category link
        $(document).on('click', '.edit-kanji', function() {
            var row = $(this).closest('tr')[0];
            makeRowEditable(row);
        });



        // Event listener for delete category link
        $(document).on('click', '.delete-kanji', function(e) {
            e.preventDefault();
            var categoryId = $(this).data('kanji-id');
            // Call a function to handle deleting the category with this ID
        });

        $(document).ready(function() {
            updateKanjisTable();
            // Submit form data using AJAX when the form is submitted
            $('#addKanjiForm').submit(function(e) {
                e.preventDefault();
                var kanji_character = $('#kanji_character').val();
                var kanji_meaning = $('#kanji_meaning').val();
                var kanji_kunyomi = $('#kanji_kunyomi').val();
                var kanji_onyomi = $('#kanji_onyomi').val();
                var kanji_romaji_writing = $('#kanji_romaji_writing').val();
                var category_id = $('#category_id').val();

                $.ajax({
                    url: 'sql/insert.php',
                    method: 'POST',
                    data: {
                        function_name: 'addKanji',
                        kanji_character: kanji_character,
                        kanji_meaning: kanji_meaning,
                        kanji_kunyomi: kanji_kunyomi,
                        kanji_onyomi: kanji_onyomi,
                        kanji_romaji_writing: kanji_romaji_writing,
                        category_id: category_id
                    },

                    success: function(response) {
                        if (response.trim() === 'Category added successfully') {
                            // Clear the form
                            $('#kanji_character').val('');
                            $('#kanji_meaning').val('');
                            $('#kanji_kunyomi').val('');
                            $('#kanji_onyomi').val('');
                            $('#kanji_romaji_writing').val('');
                            $('#category_id').val('');

                            // Retrieve the updated categories data from the server using AJAX
                            updateKanjisTable();

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
            <h1 class='title'>Kanji</h1>
            <button class="btnAddCategory" onclick="showAddKanjiForm()">Ajouter un kanji</button>
            <div id="addKanjiForm" style="display:none;">
                <form id="addKanjiForm" method="POST">
                    <input class="inputFormCategory" type="text" id="kanji_character" name="kanji_character" placeholder="Kanji" required>
                    <input class="inputFormCategory" type="text" id="kanji_meaning" name="kanji_meaning" placeholder="Définition" required>
                    <input class="inputFormCategory" type="text" id="kanji_kunyomi" name="kanji_kunyomi" placeholder="Kunyomi*" required>
                    <input class="inputFormCategory" type="text" id="kanji_onyomi" name="kanji_onyomi" placeholder="Onyomi" required>
                    <input class="inputFormCategory" type="text" id="kanji_romaji_writing" name="kanji_romaji_writing" placeholder="Romaji" required>
                    <select id="category_id" name="category_id" class="inputFormCategory" required>
                        <?php
                        $categories = json_decode(getCategories(), true);

                        foreach ($categories as $category) {
                            echo '<option value="' . $category['categories_id'] . '">' . $category['categories_name'] . '</option>';
                        }

                        ?>
                    </select>

                    <input class="btnAddCategory" type="submit" value="Ajouter">
                </form>
            </div>
            <table class='table mt-3'>
                <thead>
                    <tr>
                        <th>Kanji</th>
                        <th>Définition</th>
                        <th>Kunyomi</th>
                        <th>Onyomi</th>
                        <th>Romaji</th>
                        <th>Catégorie</th>
                        <th>Editer</th>
                        <th>Supprimer</th>
                    </tr>
                </thead>

                <tbody id="kanjiTable">

                </tbody>
            </table>
        </div>
    </div>


</body>

</html>