<?php
require_once 'sql/get.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Murasaki</title>

    <!-- Move CSS imports to the bottom of the head section -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">


    <link rel="stylesheet" href="style/style.css">
</head>

<body>

    <?php include 'navbar.php'; ?>

    <table class='table mt-3'>
        <thead class="text">
            <tr>
                <th>Kanji</th>
                <th>Définition</th>
                <th>Kunyomi</th>
                <th>Onyomi</th>
                <th>Romaji</th>
                <th>Catégorie</th>
            </tr>
        </thead>
        <tbody class="text">
            <?php
            $kanjis = json_decode(getKanjis(), true);
            foreach ($kanjis as $kanji) {
                echo "<tr>";
                echo "<td>" . $kanji['kanji_character'] . "</td>";
                echo "<td>" . $kanji['kanji_meaning'] . "</td>";
                echo "<td>" . $kanji['kanji_kunyomi'] . "</td>";
                echo "<td>" . $kanji['kanji_onyomi'] . "</td>";
                echo "<td>" . $kanji['kanji_romaji_writing'] . "</td>";
                echo "<td>" . $kanji['category_name'] . "</td>";
                echo "</tr>";
            }
            ?>
        </tbody>


    </table>
</body>

</html>