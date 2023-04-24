<?php

function getDailyKanji()
{
    require_once 'sql/connexion.php';

    $pdo = connect();

    $stmt = $pdo->prepare('SELECT * FROM kanji ORDER BY RAND() LIMIT 1');
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
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
