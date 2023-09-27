<?php

function getDailyKanji()
{
    require_once 'sql/connexion.php';

    $pdo = connect();

    $stmt = $pdo->prepare('SELECT * FROM kanji WHERE kanji_is_daily = 0 ORDER BY RAND() LIMIT 1');
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$result) {
        // No kanji found with kanji_is_daily = 0, update all kanjis
        $updateAllStmt = $pdo->prepare('UPDATE kanji SET kanji_is_daily = 0');
        $updateAllStmt->execute();

        // Call the function recursively to get a new kanji
        return getDailyKanji();
    }

    // Update the selected kanji's kanji_is_daily to 1
    $updateSelectedStmt = $pdo->prepare('UPDATE kanji SET kanji_is_daily = 1 WHERE kanji_id = :kanji_id');
    $updateSelectedStmt->bindParam(':kanji_id', $result['kanji_id']);
    $updateSelectedStmt->execute();

    return $result;
}



function getUsername($username)
{
    require_once 'sql/connexion.php';

    $pdo = connect();

    $stmt = $pdo->prepare('SELECT * FROM users WHERE username = :username');
    $stmt->bindParam(':username', $username);
    $stmt->execute();

    // Fetch the user from the result set
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    return $user;
}

function passwordVerify($password, $hashed_password)
{
    // Use the PHP password_verify function to check if the password matches the hash
    return password_verify($password, $hashed_password);
}

function countKanjis()
{
    require_once 'sql/connexion.php';

    $pdo = connect();

    $stmt = $pdo->prepare('SELECT COUNT( kanji_id ) FROM kanji');
    $stmt->execute();
    $result = $stmt->fetchColumn();
    return $result;
}


function getCategories()
{
    require_once 'sql/connexion.php';
    $pdo = connect();
    $stmt = $pdo->prepare('SELECT categories_id, categories_name FROM categories');
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return json_encode($result);
}


function getKanjis()
{
    require_once 'sql/connexion.php';
    $pdo = connect();
    $stmt = $pdo->prepare('SELECT kanji_id, kanji_character, kanji_meaning, kanji_kunyomi, kanji_onyomi, kanji_romaji_writing, kanji_is_daily, category_id  FROM kanji');
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Fetch category names for corresponding category IDs
    $categoryIds = array_column($result, 'category_id');
    $categoryNames = getCategoryNames($categoryIds);

    // Add category names to the result array
    foreach ($result as &$row) {
        $categoryId = $row['category_id'];
        $row['categories_name'] = $categoryNames[$categoryId];
    }

    return json_encode($result);
}

function getCategoryNames($categoryIds)
{
    require_once 'sql/connexion.php';
    $pdo = connect();
    $categoryIdsPlaceholders = implode(',', array_fill(0, count($categoryIds), '?'));

    $stmt = $pdo->prepare("SELECT categories_id, categories_name FROM categories WHERE categories_id IN ($categoryIdsPlaceholders)");
    $stmt->execute($categoryIds);
    $categories = $stmt->fetchAll(PDO::FETCH_KEY_PAIR);

    return $categories;
}
