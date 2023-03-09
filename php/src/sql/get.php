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

