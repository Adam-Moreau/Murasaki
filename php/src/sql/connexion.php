<?php
function connect() {
    $host = 'db';
    $dbname = 'murasaki_database';
    $username = 'MYSQL_USER';
    $password = 'MYSQL_PASSWORD';

    try {
        $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $pdo;
    } catch(PDOException $e) {
        die("Connection failed: " . $e->getMessage());
    }
}