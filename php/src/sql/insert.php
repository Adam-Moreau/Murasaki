<?php

if (isset($_POST['function_name']) && !empty($_POST['function_name'])) {
    $function_name = $_POST['function_name'];
    if ($function_name == 'addCategory') {
        addCategory($_POST['category']);
    }
    if ($function_name == 'addKanji'){
        $kanji_character = $_POST['kanji_character'];
        $kanji_meaning = $_POST['kanji_meaning'];
        $kanji_kunyomi = $_POST['kanji_kunyomi'];
        $kanji_onyomi = $_POST['kanji_onyomi'];
        $kanji_romaji_writing = $_POST['kanji_romaji_writing'];
        $category_id = $_POST['category_id'];
        addKanji($kanji_character, $kanji_meaning, $kanji_kunyomi, $kanji_onyomi, $kanji_romaji_writing, $category_id) ;
    }
}

function addCategory($category)
{
    require_once 'connexion.php';

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $category = $_POST['category'];

        $pdo = connect();

        // Check if category already exists
        $stmt = $pdo->prepare(
            'SELECT COUNT(*) FROM categories WHERE categories_name = :name'
        );
        $stmt->bindParam(':name', $category);
        $stmt->execute();
        $count = $stmt->fetchColumn();

        if ($count > 0) {
            // Category already exists, do not insert
            echo 'Category already exists';
        } else {
            // Category does not exist, insert
            $stmt = $pdo->prepare(
                'INSERT INTO categories(categories_name) VALUES(:name);'
            );
            $stmt->bindParam(':name', $category);
            $stmt->execute();

            echo 'Category added successfully';
        }
    } else {
        echo 'Invalid request';
    }
}

function addKanji($kanji_character, $kanji_meaning, $kanji_kunyomi, $kanji_onyomi, $kanji_romaji_writing, $category_id)
{
    require_once 'connexion.php';

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        


        $pdo = connect();

        // Category does not exist, insert
        $stmt = $pdo->prepare(
            'INSERT INTO kanji (kanji_character, kanji_meaning, kanji_kunyomi, kanji_onyomi, kanji_romaji_writing, category_id) VALUES(:kanji_character, :kanji_meaning, :kanji_kunyomi, :kanji_onyomi, :kanji_romaji_writing, :category_id);'
        );
        $stmt->bindParam(':kanji_character', $kanji_character);
        $stmt->bindParam(':kanji_meaning', $kanji_meaning);
        $stmt->bindParam(':kanji_kunyomi', $kanji_kunyomi);
        $stmt->bindParam(':kanji_onyomi', $kanji_onyomi);
        $stmt->bindParam(':kanji_romaji_writing', $kanji_romaji_writing);
        $stmt->bindParam(':category_id', $category_id);

        $stmt->execute();

        echo 'Category added successfully';
    } else {
        echo 'Invalid request';
    }
}
