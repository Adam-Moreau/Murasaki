<?php

if (isset($_POST['function_name']) && !empty($_POST['function_name'])) {
    $function_name = $_POST['function_name'];
    if ($function_name == 'addCategory') {
        addCategory($_POST['category']);
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
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            echo 'Category added successfully';
        }
    } else {
        echo 'Invalid request';
    }
}
