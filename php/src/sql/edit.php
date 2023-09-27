<?php 

//CATEGORY

function updateCategory($category_id, $new_value){

    require_once 'sql/connexion.php';
    
    $pdo = connect();

    // Prepare the SQL query to update the category with the given ID
    $stmt = $pdo->prepare('UPDATE categories SET categories_name = :name WHERE categories_id = :id');
    $stmt->bindParam(':id', $category_id);
    $stmt->bindParam(':name', $new_value);
    

    // Execute the query
    $result = $stmt->execute();

    if ($result) {
        return true; // Return true if the update was successful
    } else {
        return false; // Return false if the update failed
    }
}
function deleteCategory($category_id){

    require_once 'sql/connexion.php';
    
    $pdo = connect();

    // Prepare the SQL query to update the category with the given ID
    $stmt = $pdo->prepare('DELETE FROM categories WHERE categories_id = :id');
    $stmt->bindParam(':id', $category_id);
    
    // Execute the query
    $result = $stmt->execute();

    if ($result) {
        return true; // Return true if the update was successful
    } else {
        return false; // Return false if the update failed
    }

}

//KANJI

function updateKanji($kanji_id, $new_values)
{
    require_once 'sql/connexion.php';
    $pdo = connect();

    // Prepare the SQL query to update the kanji with the given ID
    $stmt = $pdo->prepare('UPDATE kanji SET kanji_character = :character, kanji_meaning = :meaning, kanji_kunyomi = :kunyomi, kanji_onyomi = :onyomi, kanji_romaji_writing = :romaji, category_id = :category WHERE kanji_id = :id');
    
    // Bind the values to the prepared statement
    $stmt->bindParam(':id', $kanji_id);
    $stmt->bindParam(':character', $new_values[0][0]);
    $stmt->bindParam(':meaning', $new_values[0][1]);
    $stmt->bindParam(':kunyomi', $new_values[0][2]);
    $stmt->bindParam(':onyomi', $new_values[0][3]);
    $stmt->bindParam(':romaji', $new_values[0][4]);
    $stmt->bindParam(':category', $new_values[0][5]);


    // Execute the query
    $result = $stmt->execute();

    if ($result) {
        return true; // Return true if the update was successful
    } else {
        return false; // Return false if the update failed
    }
}

function deleteKanji($kanji_id){

    require_once 'sql/connexion.php';
    
    $pdo = connect();

    // Prepare the SQL query to update the category with the given ID
    $stmt = $pdo->prepare('DELETE FROM kanji WHERE kanji_id = :id');
    $stmt->bindParam(':id', $kanji_id);
    
    // Execute the query
    $result = $stmt->execute();

    if ($result) {
        return true; // Return true if the update was successful
    } else {
        return false; // Return false if the update failed
    }

}
